@extends('layouts.layout')


@section('page-header', 'Поставщики')
@section('page-header-desc', 'Управление поставщиками оборудования')
@section('page-header-buttons')
    <a href="{{route('suppliers.index')}}" class="btn btn-white btn-border btn-round mr-2">Назад</a>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Редактирование типа оборудования "{{$supplier->title}}"</div>
                    <form action="{{route('suppliers.update', ['supplier' => $supplier->id])}}" class="mt-3" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">Наименование типа оборудования:</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Введите наименование..."
                            value="{{$supplier->title}}">
                            @if($errors->has('title'))
                                <small id="titleError" class="form-text text-danger">
                                    @foreach($errors->get('title') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group @error('address') has-error @enderror">
                            <label for="address">Юридический адрес поставщика:</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Введите юридический адрес..." value="{{$supplier->address}}">
                            @if($errors->has('address'))
                                <small id="addressError" class="form-text text-danger">
                                    @foreach($errors->get('address') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group @error('inn') has-error @enderror">
                            <label for="inn">ИНН поставщика:</label>
                            <input type="text" class="form-control" name="inn" id="inn" placeholder="Введите ИНН..." value="{{$supplier->inn}}">
                            @if($errors->has('inn'))
                                <small id="innError" class="form-text text-danger">
                                    @foreach($errors->get('inn') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group @error('ogrnip') has-error @enderror">
                            <label for="ogrnip">ОГРН/ОГРНИП поставщика:</label>
                            <input type="text" class="form-control" name="ogrnip" id="ogrnip" placeholder="Введите ОГРНИП..." value="{{$supplier->ogrnip}}">
                            @if($errors->has('ogrnip'))
                                <small id="ogrnipError" class="form-text text-danger">
                                    @foreach($errors->get('ogrnip') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group @error('rs') has-error @enderror">
                            <label for="rs">Расчетный счет поставщика:</label>
                            <input type="text" class="form-control" name="rs" id="rs" placeholder="Введите расчетный счет..." value="{{$supplier->rs}}">
                            @if($errors->has('rs'))
                                <small id="rsError" class="form-text text-danger">
                                    @foreach($errors->get('rs') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group @error('rs_name') has-error @enderror">
                            <label for="rs_name">Наименование банка:</label>
                            <input type="text" class="form-control" name="rs_name" id="rs_name" placeholder="Введите наименование банка..." value="{{$supplier->rs_name}}">
                            @if($errors->has('rs_name'))
                                <small id="rs_nameError" class="form-text text-danger">
                                    @foreach($errors->get('rs_name') as $message)
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

