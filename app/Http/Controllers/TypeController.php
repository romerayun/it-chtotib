<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreType;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::paginate(10);
        return view('types.index', compact('types'));
    }


    public function create()
    {
        return view('types.create');
    }


    public function store(StoreType $request)
    {
        Type::create($request->all());
        $request->session()->flash('success', 'Данные успешно добавлены 👍');
        return back();
    }


    public function edit($slug)
    {
        $type = Type::firstWhere('slug', $slug);
        if ($this->authorize('update', $type)) {
            return view('types.edit', compact('type'));
        }

    }


    public function update(StoreType $request, $slug)
    {
        $type = Type::firstWhere('slug', $slug);
        if ($this->authorize('update', $type)) {
            $type->slug = null; // update new slug
            $type->update($request->all());
            $request->session()->flash('success', 'Данные успешно обновлены 👍');
            return redirect()->route('types.index');
        }
    }


    public function destroy($slug)
    {
        $type = Type::firstWhere('slug', $slug);
        if ($this->authorize('delete', $type)){
            $type->delete();
            return redirect()->route('types.index')->with('success', 'Данные успешно удалены 👍');
        }
    }
}
