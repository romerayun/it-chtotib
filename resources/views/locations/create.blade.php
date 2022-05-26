@extends('layouts.layout')


@section('page-header', 'Места хранения')
@section('page-header-desc', 'Управление местами хранения')
@section('page-header-buttons')
    <a href="{{route('locations.index')}}" class="btn btn-white btn-border btn-round mr-2">Назад</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Добавление места хранения</div>

                    <form action="{{route('locations.store')}}" class="mt-3" method="POST">
                        @csrf
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">Наименование места хранения:</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Введите наименование...">
                            @if($errors->has('title'))
                                <small id="titleError" class="form-text text-danger">
                                    @foreach($errors->get('title') as $message)
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

