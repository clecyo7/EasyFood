@extends('adminlte::page')

@section('title', "Detalhes do Perfil {$permission->name}")

@section('content_header')
    <h1>Detalhes da Permissão <b>{{$permission->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{$permission->name}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$permission->description}}
                </li>
            </ul>

            <form action="{{route('permissions.destroy', $permission->id)}}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar o perfil {{$permission->name}}</button>
            </form>

        </div>
    </div>
@stop
