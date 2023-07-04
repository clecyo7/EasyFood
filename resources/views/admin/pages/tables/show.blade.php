@extends('adminlte::page')

@section('title', "Detalhes da Categoria {$table->identify}")

@section('content_header')
    <h1>Detalhes da Mesa <b>{{$table->identify}}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <ul>
                <li>
                    <strong>Identificador da mesa:</strong> {{$table->identify}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$table->description}}
                </li>
                <li>
                    <strong>Empresa:</strong> {{$table->tenant_id}}
                </li>
            </ul>

            <form action="{{route('tables.destroy', $table->id)}}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar a Mesa {{$table->identify}}</button>
            </form>

        </div>
    </div>
@stop
