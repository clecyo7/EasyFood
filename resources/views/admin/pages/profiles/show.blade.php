@extends('adminlte::page')

@section('title', "Detalhes do Perfil {$profile->name}")

@section('content_header')
    <h1>Detalhes do Perfil <b>{{$profile->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{$profile->name}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$profile->description}}
                </li>
            </ul>

            <form action="{{route('profiles.destroy', $profile->id)}}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar o perfil {{$profile->name}}</button>
            </form>

        </div>
    </div>
@stop
