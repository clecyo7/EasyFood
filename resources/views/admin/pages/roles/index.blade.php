@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    </ol>
    <h1>Cargos <a href="{{ route('roles.create') }}" class="btn btn-dark">
        <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-header">
            <form action="{{ route('roles.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}"
                    class="form-control">
                <button type="submit" class="btn btn-dark" placeholder="Nome"> Filtrar <i class="fa fa-filter" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th >Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                {{ $role->name }}
                            </td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info"><i class="far fa-edit"> Editar</i></a>
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"> Ver</i></a>
                                <a href="{{ route('roles.permissions', $role->id) }}" class="btn btn-warning"><i class="fas fa-lock" aria-hidden="true"> Permissões </i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $roles->appends($filters)->links() }}
            @else
                {{ $roles->links() }}
            @endif
        </div>
    </div>
@stop
