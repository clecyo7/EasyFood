@extends('adminlte::page')

@section('title', "Detalhes do Cargo {$role->name}")

@section('content_header')
    <h1>Detalhes do Cargo <b>{{$role->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{$role->name}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$role->description}}
                </li>
            </ul>

            <form action="{{route('roles.destroy', $role->id)}}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar o Cargo {{$role->name}}</button>
            </form>

        </div>
    </div>
@stop
