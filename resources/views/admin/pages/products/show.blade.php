@extends('adminlte::page')

@section('title', "Detalhes do Produto {$product->title}")

@section('content_header')
    <h1>Detalhes do Produto <b>{{ $product->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" width="150" height="150">
           <br><br>
            <ul>
                <li>
                    <strong>Título:</strong> {{ $product->title }}
                </li>
                <li>
                    <strong>Flag:</strong> {{ $product->flag }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $product->description }}
                </li>
            </ul>

            <form action="{{ route('products.destroy', $product->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar o
                    produto {{ $product->title }}</button>
            </form>

        </div>
    </div>
@stop
