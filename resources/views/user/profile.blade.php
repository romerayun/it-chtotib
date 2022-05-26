@extends('layouts.layout')


@section('page-header', 'Настройки аккаунта')
@section('page-header-desc', 'Управление аккаунтом (смена имени, загрузка фото профиля)')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Редактирование аккаунта</div>
                    <form action="{{route('profile.store')}}" class="mt-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Имя пользователя (Фамилия, имя):</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя пользователя..." value="{{ auth()->user()->name }}">
                            @if($errors->has('name'))
                                <small id="nameError" class="form-text text-danger">
                                    @foreach($errors->get('name') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>


                        <div class="form-group @error('photo') has-error @enderror">

                            <label for="photo" class="form-label">Выберите фото профиля</label><br>
                            <div class="avatar avatar-xxl mb-3">
                                @if(isset(auth()->user()->photo) && !empty(auth()->user()->photo))
                                    <img class="avatar-img rounded" src="{{asset("/uploads")."/".auth()->user()->photo}}" alt="Фото профиля">
                                @else
                                    <p>Фото не загружено 🥺</p>
                                @endif
                            </div>
                            <input class="form-control" type="file" id="photo" name="photo">
                            @if($errors->has('photo'))
                                <small id="photoError" class="form-text text-danger">
                                    @foreach($errors->get('photo') as $message)
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

