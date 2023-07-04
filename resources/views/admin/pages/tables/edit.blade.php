@extends('adminlte::page')

@section('title', "Editar a Mesa {$table->identity}")

@section('content_header')
    <h1>Editar a Mesa - {{ $table->identity }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="POST">
                @method('PUT')
                @csrf
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop
