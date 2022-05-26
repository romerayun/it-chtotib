@extends('layouts.layout')


@section('page-header', 'Статус оборудования')
@section('page-header-desc', 'Управление статусом оборудования')
@section('page-header-buttons')
    <a href="{{route('statuses.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Перечень статусов оборудования</div>
                    @if(!$statuses->isEmpty())
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Цвет отображения</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Дата обновления</th>
                            @canany(['update', 'delete'], $statuses->first())
                            <th scope="col">Редактирование</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <td>{{$status->id}}</td>
                                <td>{{$status->name}}</td>
                                <td>
                                    <span class="colorinput-color bg-{{$status->color}}"></span>
                                </td>
                                <td>{{$status->created_at}}</td>
                                <td>{{$status->updated_at}}</td>
                                @canany(['update', 'delete'], $status)
                                <td class="d-flex align-items-center">
                                    <a href="{{route('statuses.edit', ['status' => $status->id])}}" class="btn btn-icon btn-round btn-info d-flex align-items-center justify-content-center">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('statuses.destroy', ['status' => $status->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-round btn-danger d-flex align-items-center justify-content-center ml-2 delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @endcanany
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$statuses->links()}}

                    @else
                        <p class="text-danger mb-0 mt-2">К сожалению, ничего не нашлось 😢</p>
                    @endif
                </div>
            </div>
        </div></div>
@endsection

