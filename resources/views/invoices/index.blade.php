@extends('layouts.layout')


@section('page-header', 'Счета')
@section('page-header-desc', 'Управление счетами')
@section('page-header-buttons')
    <a href="{{route('invoices.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Список счетов</div>
                    @if(!$invoices->isEmpty())
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Номер счета</th>
                            <th scope="col">Поставщик</th>
                            <th scope="col">Стоимость счета</th>
                            <th scope="col">Дата выставления счета</th>
                            @canany(['update', 'delete'], $invoices->first())
                                <th scope="col">Редактирование</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{$invoice->number_invoice}}</td>
                                <td>{{$invoice->supplier->title}}</td>
                                <td>{{$invoice->price}} <i class="fas fa-ruble-sign" style="font-size: 11px"></i></td>
                                <td>{{$invoice->getDateInvoice()}} г.</td>
                                @canany(['update', 'delete'], $invoice)
                                <td class="d-flex align-items-center">
                                        <a href="{{route('invoices.edit', ['invoice' => $invoice->id])}}" class="btn btn-icon btn-round btn-info d-flex align-items-center justify-content-center">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('invoices.destroy', ['invoice' => $invoice->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-round btn-danger d-flex align-items-center justify-content-center ml-2 delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                </td>
                                @endcanany
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$invoices->links()}}

                    @else
                        <p class="text-danger mb-0 mt-2">К сожалению, ничего не нашлось 😢</p>
                    @endif
                </div>
            </div>
        </div></div>
@endsection

