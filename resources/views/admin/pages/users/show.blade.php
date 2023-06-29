@extends('adminlte::page')

@section('title', "Detalhes do Usuário {$user->name}")

@section('content_header')
    <h1>Detalhes do Usuário <b>{{$user->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{$user->name}}
                </li>
                <li>
                    <strong>E-mail:</strong> {{$user->email}}
                </li>
                <li>
                    <strong>Empresa:</strong> {{$user->tenant->name}}
                </li>
            </ul>

            <form action="{{route('users.destroy', $user->id)}}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar o Usuário {{$user->name}}</button>
            </form>

        </div>
    </div>
@stop
