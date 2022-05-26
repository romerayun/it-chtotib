@extends('layouts.layout')

@section('page-header', 'Статус оборудования')
@section('page-header-desc', 'Управление статусом оборудования')
@section('page-header-buttons')
    <a href="{{route('statuses.index')}}" class="btn btn-white btn-border btn-round mr-2">Назад</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Редактирование статуса оборудования "{{$status->name}}"</div>
                    <form action="{{route('statuses.update', ['status' => $status->id])}}" class="mt-3" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Наименование статуса оборудования:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Введите наименование..."
                            value="{{$status->name}}">
                            @if($errors->has('name'))
                                <small id="nameError" class="form-text text-danger">
                                    @foreach($errors->get('name') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Выберите цвет для отображения статуса</label>
                            <div class="row gutters-xs mt-2">
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="primary" class="colorinput-input"
                                               @if($status->color == 'primary') checked @endif>
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="secondary" class="colorinput-input"
                                               @if($status->color == 'secondary') checked @endif>
                                        <span class="colorinput-color bg-secondary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="info" class="colorinput-input"
                                               @if($status->color == 'info') checked @endif>
                                        <span class="colorinput-color bg-info"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="success" class="colorinput-input" @if($status->color == 'success') checked @endif>
                                        <span class="colorinput-color bg-success"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="danger" class="colorinput-input" @if($status->color == 'danger') checked @endif>
                                        <span class="colorinput-color bg-danger"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="warning" class="colorinput-input" @if($status->color == 'warning') checked @endif>
                                        <span class="colorinput-color bg-warning"></span>
                                    </label>
                                </div>
                            </div>
                            @if($errors->has('color'))
                                <small id="colorError" class="form-text text-danger">
                                    @foreach($errors->get('color') as $message)
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

