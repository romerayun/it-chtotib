@extends('layouts.unloggedlayout')


@section('page-header', 'Создание заявки')
@section('page-header-desc', 'В данном разделе имеется возможность оставить заявку в IT центр (покупка нового оборудования, установка оборудования, ремонт и т.д.)')


@section('content')
    <div class="row">
        <div class="col-md-12">

            <form method="POST" action="{{route('newrequest.create-request')}}">
                @csrf
                <div class="card">

                    <div class="card-body">
                        <div class="card-title fw-mediumbold">Создание новой заявки</div>

                        <div class="form-group @error('fio') has-error @enderror mt-3">
                            <label for="fio">Ваше ФИО:</label>
                            <input type="text" class="form-control" name="fio" id="fio"
                                   placeholder="Введите ФИО..." value="{{old('fio')}}">
                            @if($errors->has('fio'))
                                <small id="fioError" class="form-text text-danger">
                                    @foreach($errors->get('fio') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Ваша электронная почта:</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="Введите E-mail..." value="{{old('email')}}">
                            @if($errors->has('email'))
                                <small id="emailError" class="form-text text-danger">
                                    @foreach($errors->get('email') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('location') has-error @enderror">
                            <label for="title">Местоположение:</label>
                            <input type="text" class="form-control" name="location" id="location"
                                   placeholder="Введите местоположение..."
                                   value="{{old('location')}}">
                            @if($errors->has('location'))
                                <small id="locationError" class="form-text text-danger">
                                    @foreach($errors->get('location') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description">Описание заявки:</label>
                            <textarea class="form-control" rows="4" name="description" id="description" placeholder="Описание заявки...">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                                <small id="descriptionError" class="form-text text-danger">
                                    @foreach($errors->get('description') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection

