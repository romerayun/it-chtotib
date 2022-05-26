<?php

namespace App\Http\Controllers;

use App\Filters\WriteOffFilter;
use App\Http\Requests\CreateWord;
use App\Invoice;
use App\Location;
use App\Material;
use App\Supplier;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class WordDocsController extends Controller
{
    public function index(Request $request) {


//        $phpWord = new PhpWord();
        $types = Type::pluck('name','id');
        $locations = Location::pluck('title','id');
        $invoices = Invoice::pluck('number_invoice','id');
        $objects = Material::where('status_id', '=', 3)->get();
        $suppliers = Supplier::pluck('title', 'id');

        $files = array();

        foreach (Storage::disk('public2')->files('results') as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) == 'docx') {
                if (pathinfo($file, PATHINFO_FILENAME) == 'tech') continue;
                $files[] = $file;
            }
        }

        return view('writeoff.index', compact('objects', 'types', 'locations', 'invoices', 'suppliers', 'files'));

    }


    public function filter(WriteOffFilter $request) {

        $objects = Material::filter($request)->get();

        $res = '';

        if ($objects->isEmpty()) {
            $res .= '<p class="text-danger mb-0 ">По заданным фильтрам ничего не нашлось 😢</p>';
        } else {

            foreach ($objects as $object) {
                $res .= '<label class="selectgroup-item">
                         <input type="checkbox" name="objects[]" value="' . $object->id . '" class="selectgroup-input" >
                         <span class="selectgroup-button">'
                    . $object->inv_number . '-' . $object->title .
                    '</span>
                     </label>';
            }
        }

        echo $res;
    }

    public function create(CreateWord $request) {

        $supplier_id = $request->supplier_id;
        $supplier = Supplier::find($supplier_id);

        if (!isset($request->objects)) {
            $request->session()->flash('error', 'Выберите оборудование для создания технического заключения 😩');
            return back();
        } else {
            $objects = Material::whereIn('id', $request->objects)->get();
        }

        $templateProcessor = new TemplateProcessor(public_path('results/tech.docx'));

        $templateArray = array();

        foreach ($objects as $object) {
            $templateArray[] = array(
                'suppliers' => $supplier->title,
                'title_object' => $object->title,
                'inv_number' => $object->inv_number,
                'conclusion' => $object->histories->last()->comment,
                'suppliers_address' => $supplier->address,
                'suppliers_inn' => $supplier->inn,
                'suppliers_ogrnip' => $supplier->ogrnip,
                'suppliers_rs' => $supplier->rs,
                'suppliers_rs_name' => $supplier->rs_name,
            );
        }

        $templateProcessor->cloneBlock('block', count($templateArray), true, false, $templateArray);

        $templateProcessor->saveAs(public_path('results/'.date('Y-m-d-H-i-s').'.docx'));

        $request->session()->flash('success', 'Техническое заключение было успешно сформировано 👍');
        return back();

    }
}
