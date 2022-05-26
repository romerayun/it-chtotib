@extends('layouts.layout')


@section('page-header', 'Движение оборудования')
@section('page-header-desc', 'История движения материальных средств')
@section('page-header-buttons')
    <a href="{{route('objects.index')}}" class="btn btn-white btn-border btn-round mr-2">Назад</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Движение оборудования - {{ $object->title }}</div>
                    @if(!$histories->isEmpty())

                        <ol class="activity-feed mt-3">

                            @foreach($histories as $history)
                                <li class="feed-item feed-item-{{$history->status->color}}">
                                    <time class="date" datetime="9-25">{{$history->getDate()}}</time>
                                    <time class="date" datetime="9-25">{{$history->getTime()}}</time>

                                    <p class="fw-bold mb-1 op-7 text-{{$history->status->color}}">Статус: {{$history->status->name}}</p>
                                    <p class="mb-1 op-7">Местоположение: {{ $history->location->title }}</p>
                                    @if($history->status->name === 'Установлено')
                                        <p class="mb-1 fw-bold">Установлено:</p>
{{--                                            <p class="mb-1 op-7">Инв.номер: {{ $history->locObj->inv_number }}</p>--}}
                                            <p class=op-7">Наименование: {{ $history->locObj->title }}</p>
                                        </p>
                                    @endif
                                    <p class="mb-2 op-7">Ответственный: {{ $history->user->name }}</p>

                                    @if(!empty($history->comment))
                                        <span class="text">Комментарий:</span>
                                        <span class="text d-block mb-3">{{$history->comment}}</span>
                                    @endif
                                </li>
                            @endforeach

                        </ol>
                    @else
                        <p class="text-danger mb-0 mt-2">К сожалению, истории движения не найдено 😢</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Перемещение</div>
                    @if(!$histories->isEmpty())
                        @if($histories->first()->status->name == 'Списано')
                            <p class="text-danger mb-0 mt-2">Оборудование списано, движение невозможно 😢</p>
                        @else

                    <form action="{{route('history.storeH', ['slug' => $object->slug])}}" method="POST" class="mt-3">

                        @csrf
                        <div class="form-group @error('status_id') has-error @enderror">
                            <label for="status_id">Основание перемещения:</label>
                            <select class="js-example-basic-single form-control" name="status_id" id="status_id">
                                <option>Не выбрано</option>
                                @foreach($statuses as $k => $v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status_id'))
                                <small id="status_idError" class="form-text text-danger">
                                    @foreach($errors->get('status_id') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('location_id') has-error @enderror">
                            <label for="location_id">Местоположение оборудования:</label>
                            <select class="js-example-basic-single form-control" name="location_id" id="location_id">
                                <option>Не выбрано</option>
                                @foreach($locations as $k => $v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location_id'))
                                <small id="location_idError" class="form-text text-danger">
                                    @foreach($errors->get('location_id') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="location_object form-group @error('location_object') has-error @enderror">
                            <label for="location_object">Куда установлено:</label>
                            <select class="form-control" name="location_object" id="location_object">
                                <option value="0">Не выбрано</option>
                            </select>
                            @if($errors->has('location_object'))
                                <small id="location_objectError" class="form-text text-danger">
                                    @foreach($errors->get('location_object') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group @error('comment') has-error @enderror">
                            <label for="comment">Комменатрий:</label>
                            <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Введите комментарий...">{{old('location')}}</textarea>
                            @if($errors->has('comment'))
                                <small id="commentError" class="form-text text-danger">
                                    @foreach($errors->get('comment') as $message)
                                        {{$message}}<br>
                                    @endforeach
                                </small>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Добавить историю</button>
                        </div>
                    </form>

                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Информация об оборудовании</div>
                    <div class="mt-3"></div>
                    <ul class="list-unstyled">
                        <li class="mt-3"><b class="text-info">Общая информация:</b></li>
                        <li><b>Наименование: </b> {{$object->title}}</li>
                        @if($object->abbreviation !== null)
                            <li><b>Сокращенное имя: </b> {{$object->abbreviation->abbr}}</li>
                        @endif
                        <li><b>Тип оборудования: </b> {{$object->type->name}}</li>
                        <li><b>Инвентарный номер: </b> {{$object->inv_number}}</li>
                        <li><b>Дата покупки: </b> {{$object->getDateBuy($object->date_buy)}} г.</li>
                        <li><b>Цена: </b> {{$object->price}} руб.</li>
                        @if(count($object->invoices) !== 0)
                            <li class="mt-3"><b class="text-info">Данные о счете:</b>
                                <ul class="list-unstyled">
                                    <li><b>Поставщик: </b> {{$object->invoices[0]->supplier->title}}</li>
                                    <li><b>№ счета: </b> {{$object->invoices[0]->number_invoice}}</li>
                                </ul>
                            </li>
                        @endif

                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection

