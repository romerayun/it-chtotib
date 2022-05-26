@extends('layouts.layout')


@section('page-header', 'Списание ОС')
@section('page-header-desc', 'В данном разделе имеется возможность создать технические заключения для списания основных средств')
{{--@section('page-header-buttons')--}}
{{--    <a href="{{route('objects.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>--}}
{{--@endsection--}}

@section('content')
    <div class="row">
        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Выберите необоходимые параметры для фильтрации</div>

                            <form class="mt-3" id="filterForm">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="type_id">Тип оборудования:</label>
                                            <select class="js-example-basic-single form-control" name="type_id"
                                                    id="type_id">
                                                <option selected>Не выбрано</option>
                                                @foreach($types as $k => $v)
                                                    <option
                                                        {{ old('type_id') == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="location_id">Местоположение оборудования:</label>
                                            <select class="js-example-basic-single form-control" name="location_id"
                                                    id="location_id">
                                                <option selected>Не выбрано</option>
                                                @foreach($locations as $k => $v)
                                                    <option
                                                        {{ old('location_id') == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-3  col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="invoice_id">По счету:</label>
                                            <select class="js-example-basic-single form-control" name="invoice_id"
                                                    id="invoice_id">
                                                <option selected>Не выбрано</option>
                                                @foreach($invoices as $k => $v)
                                                    <option
                                                        {{ old('invoice_id') == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-xl-3  col-md-6 col-sm-12 text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" id="filterWriteOff">
                                                Отфильтровать
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Выберите оборудование для создания тех. заключений
                            </div>


                            <div class="form-check mt-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <span class="form-check-sign">Выбрать все</span>
                                </label>
                            </div>

                            <form action="{{route('word.create')}}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group @error('supplier_id') has-error @enderror">
                                            <label for="supplier_id">Выберите поставщика для списания:
                                                <span class="op-6 font-weight-normal">(Реквизиты постащика будут подставлены в шаблон документа)</span></label>
                                            <select class="js-example-basic-single form-control" name="supplier_id"
                                                    id="supplier_id">
                                                <option selected>Не выбрано</option>
                                                @foreach($suppliers as $k => $v)
                                                    <option
                                                        {{ old('supplier_id') == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
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
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <div class="selectgroup selectgroup-pills" id="pills-container">

                                        @foreach($objects as $object)
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="objects[]" value="{{$object->id}}"
                                                       class="selectgroup-input">
                                                <span class="selectgroup-button">
                                        {{$object->inv_number}} - {{$object->title}}
                                    </span>
                                            </label>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Создать технические заключения
                                    </button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 col-sm-12">
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="card-title fw-mediumbold">Список сформированных заключений</div>--}}

{{--                    <div class="mt-4"></div>--}}
                    @foreach($files as $file)

                        <div class="row">
                            <div class="col-12">
                                <a href="{{$file}}" target="_blank" class="text-decoration-none">
                                    <div class="card p-3 mb-3">
                                        <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-primary-gradient mr-3">
                                                    <i class="fa fa-file-word"></i>
                                                </span>
                                            <div>
                                                <h5 class="mb-1">
                                                    <b>Имя файла: {{pathinfo($file, PATHINFO_FILENAME)}}</b>
                                                </h5>
                                                <small class="text-muted">
                                                    Дата создания: {{date ("d.m.Y H:i:s", filemtime($file))}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>
                    @endforeach

{{--                </div>--}}
{{--            </div>--}}
        </div>
@endsection

