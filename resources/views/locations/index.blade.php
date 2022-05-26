@extends('layouts.layout')


@section('page-header', 'Места хранения')
@section('page-header-desc', 'Управление местами хранения')
@section('page-header-buttons')
    <a href="{{route('locations.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Перечень мест хранения</div>
                    @if(!$locations->isEmpty())
                        <table class="table table-striped mt-3">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Дата создания</th>
                                <th scope="col">Дата обновления</th>
                                @canany(['update', 'delete'], $locations->first())
                                    <th scope="col">Редактирование</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($locations as $location)
                                <tr>
                                    <td>{{$location->id}}</td>
                                    <td>{{$location->title}}</td>
                                    <td>{{$location->created_at}}</td>
                                    <td>{{$location->updated_at}}</td>
                                    @canany(['update', 'delete'], $location)
                                        <td class="d-flex align-items-center">
                                            <a href="{{route('locations.edit', ['location' => $location->id])}}" class="btn btn-icon btn-round btn-info d-flex align-items-center justify-content-center">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <form action="{{ route('locations.destroy', ['location' => $location->id])}}" method="POST">
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

                        {{$locations->links()}}

                    @else
                        <p class="text-danger mb-0 mt-2">К сожалению, ничего не нашлось 😢</p>
                    @endif
                </div>
            </div>
        </div></div>
@endsection

