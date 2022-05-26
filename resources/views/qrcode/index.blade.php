@extends('layouts.layout')


@section('page-header', 'Генерация QR-кодов')
@section('page-header-desc', 'В данном разделе вы можете сгнерировать QR-коды для печати')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Выберите необоходимые параметры для фильтрации</div>

                    <form class="mt-3" id="filterForm">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="type_id">Тип оборудования:</label>
                                    <select class="js-example-basic-single form-control" name="type_id" id="type_id">
                                        <option selected>Не выбрано</option>
                                        @foreach($types as $k => $v)
                                            <option {{ old('type_id') == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="location_id">Местоположение оборудования:</label>
                                    <select class="js-example-basic-single form-control" name="location_id" id="location_id">
                                        <option selected>Не выбрано</option>
                                        @foreach($locations as $k => $v)
                                            <option {{ old('location_id') == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="invoice_id">По счету:</label>
                                    <select class="js-example-basic-single form-control" name="invoice_id" id="invoice_id">
                                        <option selected>Не выбрано</option>
                                        @foreach($invoices as $k => $v)
                                            <option {{ old('invoice_id') == $k ? 'selected' : '' }} value="{{$k}}">{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3 col-sm-12 text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" id="filterQR">Отфильтровать</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Выберите оборудование для создания QR-кодов</div>


                    <div class="form-check mt-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                            <span class="form-check-sign">Выбрать все</span>
                        </label>
                    </div>

                    <form action="{{route('qrcode.create')}}" method="POST" target="_blank">
                        @csrf
                        <div class="form-group">
                            <div class="selectgroup selectgroup-pills" id="pills-container">

                                @foreach($objects as $object)
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="objects[]" value="{{$object->id}}" class="selectgroup-input" >
                                    <span class="selectgroup-button">
                                        {{$object->inv_number}} - {{$object->title}}
                                    </span>
                                </label>
                                @endforeach

                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Создать QR-коды</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

