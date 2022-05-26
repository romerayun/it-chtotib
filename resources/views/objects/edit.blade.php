@extends('layouts.layout')


@section('page-header', 'Материальные запасы')
@section('page-header-desc', 'Управление материальными запасами')
@section('page-header-buttons')
    <a href="{{route('objects.index')}}" class="btn btn-white btn-border btn-round mr-2">Назад</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('objects.update', ['object' => $material->slug])}}" class="mt-3" method="POST">
                @csrf
                @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Редактирование "{{ $material->title }}"</div>

                        <div class="mt-3 form-group @error('inv_number') has-error @enderror">
                            <label for="inv_number">Инвентарный номер оборудования:</label>
                            <input type="text" class="form-control" name="inv_number" id="name" placeholder="Введите инвентарный номер..." value="{{ $material->inv_number }}">
                            @if($errors->has('inv_number'))
                                <small id="inv_numberError" class="form-text text-danger">
                                    @foreach($errors->get('inv_number') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">Наименование оборудования:</label>
                            <input type="text" class="form-control" name="title" id="name" placeholder="Введите наименование..."
                                   value="{{ $material->title }}">
                            @if($errors->has('title'))
                                <small id="titleError" class="form-text text-danger">
                                    @foreach($errors->get('title') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('date_buy') has-error @enderror">
                            <label for="date_buy">Дата покупки оборудования:</label>
                            <input type="date" class="form-control" name="date_buy" id="name" placeholder="Введите дату покупки ..."
                                   value="{{ $material->date_buy }}">
                            @if($errors->has('date_buy'))
                                <small id="date_buyError" class="form-text text-danger">
                                    @foreach($errors->get('date_buy') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('price') has-error @enderror">
                            <label for="price">Цена оборудования:</label>
                            <input type="number" step="0.1" class="form-control" name="price" id="name" placeholder="Введите цену ..."
                                   value="{{ $material->price }}">
                            @if($errors->has('price'))
                                <small id="priceError" class="form-text text-danger">
                                    @foreach($errors->get('price') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('type_id') has-error @enderror">
                            <label for="type_id">Тип оборудования:</label>
                            <select class="form-control" name="type_id" id="type_id">
                                <option selected>Не выбрано</option>
                                @foreach($types as $k => $v)
                                    <option {{ $material->type_id == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type_id'))
                                <small id="type_idError" class="form-text text-danger">
                                    @foreach($errors->get('type_id') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                </div>
            </div>


                <div class="card">
                    <div class="card-body">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="isAbbr" name="isAbbr"
                                       @if(old('isAbbr') !== null && old('isAbbr') === 'on') checked @endif
                                       @if ($material->abbreviation) checked @endif>
                                <span class="form-check-sign">Имеет сокращенное название?</span>
                            </label>
                        </div>

                        <div class="form-group @error('abbr') has-error @enderror
                        @if(old('isAbbr') !== null && old('isAbbr') !== 'on') d-none @endif
                        @if (!$material->abbreviation) d-none @endif
                            ">
                            <label for="abbr">Сокращенное название(55_103):</label>
                            <input type="text" class="form-control" name="abbr" id="abbr" placeholder="Введите инвентарный номер..." value="@if ($material->abbreviation) {{$material->abbreviation->abbr}} @endif">
                            @if($errors->has('abbr'))
                                <small id="abbrError" class="form-text text-danger">
                                    @foreach($errors->get('abbr') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-body">

                        <div class="form-check ">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="isInvoice" name="isInvoice"
                                       @if(old('isInvoice') !== null && old('isInvoice') === 'on') checked
                                       @elseif($material->invoices->count() !== 0) checked @endif>
                                <span class="form-check-sign ">Привзять к счету?</span>
                            </label>
                        </div>

                        <div class="form-group @error('invoice_id') has-error @enderror
                            @if(old('isInvoice') !== null && old('isInvoice') !== 'on') checked
                            @elseif($material->invoices->count() === 0) d-none @endif">
                            <label for="invoice_id">Выберите счет:</label>
                            <select class="form-control" name="invoice_id" id="invoice_id">
                                <option>Не выбрано</option>
                                @foreach($invoices as $k => $v)
                                    <option
                                        @if(old('isInvoice') !== null && old('invoice_id') === $k) selected @endif
                                        @if($material->invoices->count() !== 0)
                                            @if($material->invoices[0]->pivot->invoice_id == $k)
                                                selected
                                            @endif
                                        @endif
                                            value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('invoice_id'))
                                <small id="invoice_idError" class="form-text text-danger">
                                    @foreach($errors->get('invoice_id') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div></div>
@endsection

