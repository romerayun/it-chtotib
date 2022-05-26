@extends('layouts.layout')


@section('page-header', 'Материальные запасы')
@section('page-header-desc', 'Перечень материальных запасов')
@section('page-header-buttons')
    <a href="{{route('objects.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>
@endsection

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <div class="row mb-3">
        <div class="col-12">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <a class="swiper-slide " href="{{route('objects.index')}}">
                        Все типы
                    </a>
                    @foreach($types as $typee)
                        <a class="swiper-slide" href="{{route('objects.type', ['slug'=>$typee->slug])}}">
                            {{$typee->name}}
                        </a>
                    @endforeach


                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>


    </div>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 6,
            spaceBetween: 30,
            freeMode: true,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Перечень материальных запасов по типу "{{ $type->name }}"</h4>
                </div>

                <div class="card-body">

                    <form  method="GET">
                        <div class="row mb-3">
                            <div class="col-sm-9 col-md-10">
                                <div class="input-icon">
                                    <input type="text" class="form-control" name="search" placeholder="Поиск..."
                                           value="{{old('search')}}">
                                    <span class="input-icon-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2 text-right">
                                <button type="submit" class="btn btn-info w-100">Поиск</button>
                            </div>
                        </div>
                    </form>

                    @if(!$objects->isEmpty())
                        @foreach($objects as $object)
                            @if($loop->index % 3 === 0)
                                <div class="row">
                                    @endif
                                    <div class="col-md-4 mt-3">
                                        <div class="card card-secondary bg-{{$object->status->color}}-gradient">
                                            <div class="card-body skew-shadow">
                                                <h3 class="fw-bold">{{$object->title}}</h3>
                                                <h6 class="op-8">Инв.номер: {{$object->inv_number}}</h6>
                                                <p class="op-8 mb-0 mt-3">Тип оборудования: {{$object->type->name}}</p>
                                                <p class="op-8 mb-0">Текущее местоположение: {{$object->location->title}}</p>
                                                <p class="op-8 mb-0">Статус: {{$object->status->name}}</p>

                                                <p class="op-8 mb-0">Цена: {{$object->price}} <i class="fas fa-ruble-sign" style="font-size: 10px"></i></p>

                                                <div class="link-qr-code">
                                                    {!! QrCode::size(60)
                                                          ->color(255, 255, 255)
                                                          ->backgroundColor(255,255,255,0)
                                                          ->generate(route('history.show', ['history' => $object->slug]));!!}
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-12 d-flex align-items-center">
                                                        <a href="{{route('history.show', ['history' => $object->slug])}}" class="btn btn-icon btn-white btn-border btn-round d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-history"></i>
                                                        </a>
                                                        <a href="{{route('objects.edit', ['object' => $object->slug])}}" class="btn btn-icon btn-white btn-border btn-round d-flex align-items-center justify-content-center ml-2">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <form action="{{ route('objects.destroy', ['object' => $object->slug])}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-icon btn-white btn-border btn-round d-flex align-items-center justify-content-center ml-2 delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="pull-right">
                                                    <h5 class="op-8 fw-bold">{{$object->getDateBuy($object->date_buy)}} г.</h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @if($loop->index % 3 === 2)
                                </div>
                            @elseif($loop->last && $loop->index % 3 !== 2)
                </div>
                @endif
                @endforeach
                @else
                    <p class="text-danger mb-0 ">К сожалению, ничего не нашлось 😢</p>
                @endif
                {{$objects->links()}}
            </div>
        </div>
    </div></div>
@endsection


