@extends('layouts.layout')


@section('page-header', 'Поставщики')
@section('page-header-desc', 'Управление поставщиками оборудования')
@section('page-header-buttons')
    <a href="{{route('suppliers.create')}}" class="btn btn-white btn-border btn-round mr-2">Добавить</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Перечень поставщиков</div>
                    @if(!$suppliers->isEmpty())
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Юр.адрес</th>
                            <th scope="col">ИНН</th>
                            <th scope="col">ОГРНИП</th>
                            <th scope="col">р/с</th>
                            <th scope="col">Банк</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Дата обновления</th>
                            @canany(['update', 'delete'], $suppliers->first())
                                <th scope="col">Редактирование</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{$supplier->id}}</td>
                                <td>{{$supplier->title}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>{{$supplier->inn}}</td>
                                <td>{{$supplier->ogrnip}}</td>
                                <td>{{$supplier->rs}}</td>
                                <td>{{$supplier->rs_name}}</td>
                                <td>{{$supplier->created_at}}</td>
                                <td>{{$supplier->updated_at}}</td>
                                @canany(['update', 'delete'], $supplier)
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('suppliers.edit', ['supplier' => $supplier->id])}}" class="btn btn-icon btn-round btn-info d-flex align-items-center justify-content-center">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('suppliers.destroy', ['supplier' => $supplier->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-round btn-danger d-flex align-items-center justify-content-center ml-2 delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endcanany
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$suppliers->links()}}

                    @else
                        <p class="text-danger mb-0 mt-2">К сожалению, ничего не нашлось 😢</p>
                    @endif
                </div>
            </div>
        </div></div>
@endsection

