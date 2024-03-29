@extends('adminlte::page')

@section('title', 'Categorias do Produto {$product->name}')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories', $product->id) }}">Categorias</a></li>
    </ol>
    <h1>Categorias do Produto<strong> {{$product->title}}</strong>
        <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark">
        <i class="far fa-plus-square"></i>  ADD NOVA CATEGORIA</a></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td  width="50">
                                <a href="{{ route('products.category.detach', [$product->id, $category->id]) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $categories->appends($filters)->links() }}
            @else
                {{ $categories->links() }}
            @endif
        </div>
    </div>
@stop
