<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatus;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function index()
    {
        $statuses = Status::paginate(10);

        return view('statuses.index', compact('statuses'));
    }


    public function create()
    {
        return view('statuses.create');
    }


    public function store(StoreStatus $request)
    {
        Status::create($request->all());
        $request->session()->flash('success', 'Данные успешно добавлены 👍');
        return back();
    }


    public function edit($id)
    {
        $status = Status::find($id);
        if ($this->authorize('update', $status)) {
            return view('statuses.edit', compact('status'));
        }

    }


    public function update(StoreStatus $request, $id)
    {
        $Status = Status::find($id);
        if ($this->authorize('update', $Status)) {
            $Status->update($request->all());
            $request->session()->flash('success', 'Данные успешно обновлены 👍');
            return redirect()->route('statuses.index');
        }
    }


    public function destroy($id)
    {
        $Status = Status::find($id);
        if ($this->authorize('update', $Status)) {
            $Status->delete();
            return redirect()->route('statuses.index')->with('success', 'Данные успешно удалены 👍');
        }
    }
}
