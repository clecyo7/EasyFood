@extends('adminlte::page')

@section('title', "Detalhes da Categoria {$category->name}")

@section('content_header')
    <h1>Detalhes da Categoria <b>{{$category->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{$category->name}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$category->description}}
                </li>
                <li>
                    <strong>Empresa:</strong> {{$category->tenant_id}}
                </li>
            </ul>

            <form action="{{route('categories.destroy', $category->id)}}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar o Usuário {{$category->name}}</button>
            </form>

        </div>
    </div>
@stop
