@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>
    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark">
        <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-header">
            <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}"
                    class="form-control">
                <button type="submit" class="btn btn-dark" placeholder="Nome">Filtrar <i class="fa fa-filter" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th style="max-width: 90px; ">Imagem</th>
                        <th style="text-align: center">Título</th>
                        <th style="text-align: center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                               <img src="{{ url("storage/{$product->image}") }}" alt="{{$product->title}}" width="130" height="100">
                            </td>
                            <td style="text-align: center">
                                {{ $product->title }}
                            </td>
                            <td style="text-align: center">
                                <a href="{{ route('products.categories', $product->id) }}" class="btn btn-warning"><i class="fas fa-layer-group" aria-hidden="true"> Categorias</i></a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info"><i class="far fa-edit"> Editar</i></a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"> Ver</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $products->appends($filters)->links() }}
            @else
                {{ $products->links() }}
            @endif
        </div>
    </div>
@stop
