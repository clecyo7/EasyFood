@extends('adminlte::page')

@section('title', "Cargos disponíveis cargo {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="active">Usuários</a></li>
    </ol>

    <h1>Cargos disponíveis cargo <strong>{{ $user->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-header">
            <form action="{{ route('users.roles.available', $user->id) }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" value="{{ $filters['filter'] ?? '' }}"
                    class="form-control">
                <button type="submit" class="btn btn-dark" placeholder="Nome"> Filtrar <i class="fa fa-filter"
                        aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('users.roles.attch', $user->id) }}" method="POST">
                        @csrf
                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <input type="checkbox" class="checkbox" name="roles[]" value="{{ $role->id }}">
                                </td>
                                <td>
                                    {{ $role->name }}
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
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
