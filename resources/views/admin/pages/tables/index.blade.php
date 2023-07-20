@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>
    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark">
        <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}"
                    class="form-control">
                <button type="submit" class="btn btn-dark" placeholder="Nome">Filtrar <i class="fa fa-filter" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Identify</th>
                        <th>Descrição</th>
                        <th >Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td>
                                {{ $table->identify }}
                            </td>
                            <td>
                                {{ $table->description }}
                            </td>
                            <td>
                                <a href="{{ route('tables.qrcode', $table->identify) }}" class="btn btn-default" target="_blank">
                                    <i class="fas fa-qrcode"></i>
                                </a>
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info"><i class="far fa-edit"> Editar</i></a>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"> Ver</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $tables->appends($filters)->links() }}
            @else
                {{ $tables->links() }}
            @endif
        </div>
    </div>
@stop
