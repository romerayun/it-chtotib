@extends('layouts.layout')


@section('page-header', 'Главная страница')
@section('page-header-desc', 'Статистика IT-отдела')
{{--@section('page-header-buttons')--}}
{{--    <a href="{{route('objects.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>--}}
{{--@endsection--}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="visible-print text-center">
{{--                    {!! QrCode::size(100)->generate(Request::url()); !!}--}}

                    {!! QrCode::generate('Lorem ipsum!'); !!}
                    <p>Scan me to return to the original page.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

