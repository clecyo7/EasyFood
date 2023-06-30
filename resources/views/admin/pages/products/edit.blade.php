@extends('adminlte::page')

@section('title', "Editar o Produto {$product->title}")

@section('content_header')
    <h1>Editar o Produto - {{ $product->title }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@stop
