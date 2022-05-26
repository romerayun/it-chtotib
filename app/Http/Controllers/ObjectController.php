<?php

namespace App\Http\Controllers;

use App\Abbreviation;
use App\History;
use App\Http\Requests\StoreAbbreviation;
use App\Http\Requests\StoreObject;
use App\Http\Requests\StoreType;
use App\Invoice;
use App\Material;
use App\Type;
use App\Status;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class ObjectController extends Controller
{



    public function index()
    {

        if (isset($_GET['search'])) {

            $search_txt = $_GET['search'];
            $objects = Material::where('inv_number', 'LIKE', '%'.$search_txt.'%')
                ->orWhere('title', 'LIKE', '%'.$search_txt.'%')
                ->orderBy('date_buy', 'desc')
                ->paginate(18);
            $objects->appends(['search' => $search_txt]);
//            $objects = Material::orderBy('date_buy', 'desc')->paginate(18);

        } else {
            $objects = Material::orderBy('date_buy', 'desc')->paginate(18);
        }


        $types = Type::all();

        return view('objects.index', compact('objects', 'types'));
    }


    public function create()
    {
        $types = Type::pluck('name', 'id')->all();
        $statuses = Status::pluck('name', 'id')->all();
        $invoices = Invoice::pluck('number_invoice', 'id')->all();
        return view('objects.create', compact('types', 'statuses', 'invoices'));
    }


    public function store(StoreObject $request)
    {
        $validatedData = $request->validate(
            [
                'abbr' => 'nullable|unique:App\Abbreviation,abbr',
            ],
            [
                'abbr.unique' => 'Сокращенное имя уже используется'
            ]
        );

        $location = Location::firstWhere('title','Склад');
        $status = Status::firstWhere('name','Хранение');
        $idObject = Material::create([
            'inv_number' => $request->inv_number,
            'title' => $request->title,
            'location_id' => $location->id,
            'date_buy' => $request->date_buy,
            'type_id' => $request->type_id,
            'status_id' => $status->id,
            'price' => $request->price,
        ])->id;

        if ($request->has('isAbbr')) {
            Abbreviation::create([
                'object_id' => $idObject,
                'abbr' => $request->abbr
            ]);
        }

        if ($request->has('isInvoice')) {
            DB::table('invoice_object')->insert([
                'invoice_id' => $request->invoice_id,
                'object_id' => $idObject,
            ]);
        }


        $user = Auth::user();
        $status = Status::firstWhere('name','Оприходование');
        History::create([
            'user_id' => $user->id,
            'object_id' => $idObject,
            'status_id' => $status->id,
            'comment' => '',
            'location_id' => $location->id
        ]);
        $status = Status::firstWhere('name','Хранение');
        History::create([
            'user_id' => $user->id,
            'object_id' => $idObject,
            'status_id' => $status->id,
            'comment' => '',
            'location_id' => $location->id
        ]);
        $request->session()->flash('success', 'Данные успешно добавлены 👍');
        return back();
    }


    public function edit($slug)
    {
        $material = Material::firstWhere('slug', $slug);
        $types = Type::pluck('name', 'id')->all();
        $statuses = Status::pluck('name', 'id')->all();
        $invoices = Invoice::pluck('number_invoice', 'id')->all();
        return view('objects.edit', compact('material', 'types', 'statuses', 'invoices'));

    }


    public function update(StoreObject $request, $slug)
    {

        $material = Material::firstWhere('slug', $slug);
        $invoice = DB::table('invoice_object')->where('object_id', '=' ,$material->id)->first();
        $abbr = Abbreviation::firstWhere('object_id', $material->id);
        if ($abbr !== null) {
            $validatedData = $request->validate(
                [
                    'abbr' => 'nullable|unique:App\Abbreviation,abbr,' . $abbr->id,
                ],
                [
                    'abbr.unique' => 'Сокращенное имя уже используется'
                ]
            );
        }


        $material->slug = null; // update new slug
        $material->update($request->all());


        if ($request->has('isAbbr')) {
            if ($abbr === null) {
                Abbreviation::create([
                    'object_id' => $material->id,
                    'abbr' => $request->abbr
                ]);
            } else {
                if ($abbr->abbr != $request->abbr) {
                    $abbr->abbr = $request->abbr;
                    $abbr->save();
                }
            }
        } else {
            if ($abbr !== null) {
                $abbr->delete();
            }
        }

        if ($request->has('isInvoice')) {
            if ($invoice === null) {
                DB::table('invoice_object')->insert([
                    'invoice_id' => $request->invoice_id,
                    'object_id' =>$material->id,
                ]);
            } else {
                if ($invoice->invoice_id != $request->invoice_id) {
                    DB::table('invoice_object')->where('object_id', '=' ,$material->id)->update(['invoice_id' => $request->invoice_id]);
                }
            }
        } else {
            if ($invoice !== null) {
                DB::table('invoice_object')->where('object_id', '=' ,$material->id)->delete();
            }
        }


        $request->session()->flash('success', 'Данные успешно обновлены 👍');
        return redirect()->route('objects.index');
    }


    public function destroy($slug)
    {
        $material = Material::firstWhere('slug', $slug);
        $material->delete();
        return redirect()->route('objects.index')->with('success', 'Данные успешно удалены 👍');
    }

    public function showType($slug) {
        $type = Type::firstWhere('slug', $slug);

        if (isset($_GET['search'])) {

            $search_txt = $_GET['search'];
            $objects = Material::where('type_id', '=', $type->id)
                ->where('inv_number', 'LIKE', '%'.$search_txt.'%')
                ->orWhere([
                    ['type_id', '=', $type->id],
                    ['title', 'LIKE', '%'.$search_txt.'%']
                ])
                ->orderBy('date_buy', 'desc')
                ->paginate(18);
            $objects->appends(['search' => $search_txt]);
        } else {
//            $objects = Material::orderBy('date_buy', 'desc')->paginate(18);
            $objects = Material::where('type_id', '=', $type->id)
                ->orderBy('date_buy', 'desc')
                ->paginate(18);
        }



        $types = Type::all();

        return view('objects.showtypes', compact('type', 'objects', 'types'));

    }

    public function objectsByLocation(Request $request) {

        if ($request->value > 0) {

            $objects = Material::where('location_id', '=', $request->value)->get();
            $htmlRes = '<option value="0">Не выбрано</option>';
            if (!$objects->isEmpty()) {
                foreach ($objects as $object) {
                    $htmlRes .= "<option value='$object->id'>$object->title</option>";
                }
            }
            echo $htmlRes;

        }
    }

//
//    public function search() {
//        $searchTxt = $_GET['search'];
//        dump($searchTxt);
//    }

}
