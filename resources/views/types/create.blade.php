@extends('layouts.layout')


@section('page-header', 'Тип оборудования')
@section('page-header-desc', 'Управление типом оборудования')
@section('page-header-buttons')
    <a href="{{route('types.index')}}" class="btn btn-white btn-border btn-round mr-2">Назад</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Добавление типа оборудования</div>
                    <form action="{{route('types.store')}}" class="mt-3" method="POST">
                        @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Наименование типа оборудования:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Введите наименование...">
                            @if($errors->has('name'))
                                <small id="nameError" class="form-text text-danger">
                                    @foreach($errors->get('name') as $message)
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
