@extends('layouts.layout')


@section('page-header', 'Счета')
@section('page-header-desc', 'Управление счетами')
@section('page-header-buttons')
    <a href="{{route('invoices.index')}}" class="btn btn-white btn-border btn-round mr-2">Назад</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Добавление счета</div>
                    <form action="{{route('invoices.store')}}" class="mt-3" method="POST">
                        @csrf
                        <div class="form-group @error('supplier_id') has-error @enderror">
                            <label for="supplier_id">Выберите поставщика оборудования:</label>
                            <select class="js-example-basic-single form-control" name="supplier_id" id="supplier_id">
                                <option>Не выбрано</option>
                                @foreach($suppliers as $k => $v)
                                    <option {{ old('supplier_id') == $k ? 'selected' : '' }}
                                    value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier_id'))
                                <small id="supplier_idError" class="form-text text-danger">
                                    @foreach($errors->get('supplier_id') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('number_invoice') has-error @enderror">
                            <label for="number_invoice">Номер счета:</label>
                            <input type="text" class="form-control" name="number_invoice" id="number_invoice" placeholder="Введите номер счета..." value="{{old('number_invoice')}}">
                            @if($errors->has('number_invoice'))
                                <small id="number_invoiceError" class="form-text text-danger">
                                    @foreach($errors->get('number_invoice') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('date_invoice') has-error @enderror">
                            <label for="date_invoice">Дата выставления счета:</label>
                            <input type="date" class="form-control" name="date_invoice" id="date_invoice" placeholder="Выберите дату выставления счета ..."
                                   value="{{old('date_invoice')}}">
                            @if($errors->has('date_invoice'))
                                <small id="date_invoiceError" class="form-text text-danger">
                                    @foreach($errors->get('date_invoice') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('price') has-error @enderror">
                            <label for="price">Общая стоимость счета:</label>
                            <input type="number" step="0.1" class="form-control" name="price" id="name" placeholder="Введите общую стоимость счета..."
                                   value="{{old('price')}}">
                            @if($errors->has('price'))
                                <small id="priceError" class="form-text text-danger">
                                    @foreach($errors->get('price') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div></div>
@endsection
