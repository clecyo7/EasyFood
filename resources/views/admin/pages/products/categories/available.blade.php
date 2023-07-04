@extends('adminlte::page')

@section('title', "Categorias disponíveis para o Produto {$product->title}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories', $product->id) }}">Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories.available', $product->id) }}">Disponíveis</a></li>
    </ol>
    <h1>Categorias disponíveis para o Produto  <strong>{{ $product->title }}</strong>
    @stop

    @section('content')
        <div class="card">
            @include('admin.incluides.alerts')
            <div class="card-header">
                <form action="{{ route('products.categories.available', $product->id) }}" method="POST" class="form form-inline">
                    @csrf
                    <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}"
                        class="form-control">
                    <button type="submit" class="btn btn-dark" placeholder="Nome"> Filtrar <i class="fa fa-filter"
                            aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('products.categories.attch', $product->id)}}" method="POST">
                            @csrf
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="categories[]"
                                            value="{{ $category->id }}">
                                    </td>
                                    <td>
                                        {{ $category->name }}
                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="500">
                                    <button type="submit" class="btn btn-success">Vincular</button>
                                </td>
                            </tr>
                        </form>
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
