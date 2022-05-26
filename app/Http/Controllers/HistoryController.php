<?php

namespace App\Http\Controllers;

use App\History;
use App\Http\Requests\StoreHistory;
use App\Location;
use App\Material;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return __METHOD__;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $statuses = Status::pluck('name', 'id')->all();
        $locations = Location::pluck('title', 'id')->all();
        $object = Material::firstWhere('slug', $slug);
        $objects = Material::pluck('title', 'id')->all();
        $histories = History::where('object_id', '=', $object->id)->orderBy('id', 'desc')->get();
        return view('history.show', compact('object', 'histories', 'statuses', 'locations', 'objects'));
    }

    public function storeHistory(StoreHistory $request, $slug)
    {
        $object = Material::firstWhere('slug', $slug);
        $user = Auth::user();

        History::create([
            'object_id' => $object->id,
            'user_id' => $user->id,
            'status_id' => $request->status_id,
            'location_id' => $request->location_id,
            'comment' => $request->comment,
            'location_object' => $request->location_object,
        ]);

        $object->status_id = $request->status_id;
        $object->location_id = $request->location_id;
        $object->save();

        $request->session()->flash('success', 'Данные успешно добавлены 👍');
        return back();

//        $histories = History::where('object_id', '=', $object->id)->orderBy('id', 'desc')->get();
//        return view('history.show', compact('object', 'histories', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
