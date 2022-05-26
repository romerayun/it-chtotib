<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoice;
use App\Invoice;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate(10);
        if ($this->authorize('view', Invoice::class)) {
            return view('invoices.index', compact('invoices'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::pluck('title', 'id');
        if ($this->authorize('create', Invoice::class)) {
            return view('invoices.create', compact('suppliers'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoice $request)
    {
        if ($this->authorize('create', Invoice::class)) {
            Invoice::create($request->all());
            $request->session()->flash('success', 'Данные успешно добавлены 👍');
            return back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = Supplier::pluck('title', 'id');
        $invoice = Invoice::find($id);
        if ($this->authorize('update', $invoice)) {
            return view('invoices.edit', compact('suppliers', 'invoice'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInvoice $request, $id)
    {
        $invoice = Invoice::find($id);
        if ($this->authorize('update', $invoice)) {
            $invoice->update($request->all());
            $request->session()->flash('success', 'Данные успешно обновлены 👍');
            return redirect()->route('invoices.index');
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
        $invoice = Invoice::find($id);
        if ($this->authorize('delete', $invoice)){
            $invoice->delete();
            return redirect()->route('invoices.index')->with('success', 'Данные успешно удалены 👍');
        }
    }
}
