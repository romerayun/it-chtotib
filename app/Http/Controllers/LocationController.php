<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocation;
use App\Location;
use App\Type;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::paginate(10);

        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocation $request)
    {
        Location::create($request->all());
        $request->session()->flash('success', 'Данные успешно добавлены 👍');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        if ($this->authorize('update', $location)) {
            return view('locations.edit', compact('location'));
        }
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
        $location = Location::find($id);
        if ($this->authorize('update', $location)) {
            $location->update($request->all());
            $request->session()->flash('success', 'Данные успешно обновлены 👍');
            return redirect()->route('locations.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        if ($this->authorize('delete', $location)){
            $location->delete();
            return redirect()->route('locations.index')->with('success', 'Данные успешно удалены 👍');
        }
    }
}
