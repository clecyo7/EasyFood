@extends('adminlte::page')

@section('title', "Permissões do Perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>
    <h1>Permissões disponíveis Perfil <strong>{{ $profile->name }}</strong>
    @stop

    @section('content')
        <div class="card">
            @include('admin.incluides.alerts')
            <div class="card-header">
                <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST" class="form form-inline">
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
                        <form action="{{ route('profiles.permissions.attch', $profile->id)}}" method="POST">
                            @csrf
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="permissions[]"
                                            value="{{ $permission->id }}">
                                    </td>
                                    <td>
                                        {{ $permission->name }}
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
                    {{ $permissions->appends($filters)->links() }}
                @else
                    {{ $permissions->links() }}
                @endif
            </div>
        </div>
    @stop
