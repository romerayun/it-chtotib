@extends('layouts.layout')


@section('page-header', 'Тип оборудования')
@section('page-header-desc', 'Управление типом оборудования')
@section('page-header-buttons')
    <a href="{{route('types.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Перечень типов оборудования</div>
                    @if(!$types->isEmpty())
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">SlugName</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Дата обновления</th>
                            @canany(['update', 'delete'], $types->first())
                                <th scope="col">Редактирование</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr>
                                <td>{{$type->id}}</td>
                                <td>{{$type->name}}</td>
                                <td>{{$type->slug}}</td>
                                <td>{{$type->created_at}}</td>
                                <td>{{$type->updated_at}}</td>
                                @canany(['update', 'delete'], $type)
                                <td class="d-flex align-items-center">
                                        <a href="{{route('types.edit', ['type' => $type->slug])}}" class="btn btn-icon btn-round btn-info d-flex align-items-center justify-content-center">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('types.destroy', ['type' => $type->slug])}}" method="POST">
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

                    {{$types->links()}}

                    @else
                        <p class="text-danger mb-0 mt-2">К сожалению, ничего не нашлось 😢</p>
                    @endif
                </div>
            </div>
        </div></div>
@endsection

