<?php

namespace App\Http\Controllers;

use App\Filters\MaterialFilter;
use App\Invoice;
use App\Location;
use App\Material;
use App\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function index() {

        $types = Type::pluck('name','id');
        $locations = Location::pluck('title','id');
        $invoices = Invoice::pluck('number_invoice','id');
        $objects = Material::all();

        return view('qrcode.index', compact('types', 'locations', 'invoices', 'objects'));
    }


    public function create(Request $request) {


        if (!isset($request->objects)) {
            return back();
        } else {
            $objects = Material::whereIn('id', $request->objects)->get();
        }

//        $res = QrCode::generate('Lorem ipsum!');
//        return view('test', compact('objects'));
        $pdf = PDF::loadView('test', compact('objects'));

//        $data = 'res';
//        $pdf = PDF::loadView('qrcode.index', $data);
        return $pdf->stream();



    }


    public function filterQR(MaterialFilter $request) {

        $objects = Material::filter($request)->get();

//        var_dump($request);
//        $objects = Material::all();
//
//        if (!intval($request->location_id)) {
//            $objects->where('location_id', '=', $request->location_id);
//        }
//            echo $request;
//        $objects = $objects->get();
//
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
//        if (!intval($request->location_id)) {
//            echo "Не число";
//        } else {
//            echo "число";
//        }
    }
}
