
@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
    </ol>
    {{-- <h1>Empresas <a href="{{ route('tenants.create') }}" class="btn btn-dark">
        <i class="far fa-plus-square"></i></a></h1> --}}
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-header">
            <form action="{{ route('tenants.search') }}" method="POST" class="form form-inline">
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
                        <th style="max-width: 90px; ">Logo</th>
                        <th style="text-align: center">Nome</th>
                        <th style="text-align: center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td>
                               <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{$tenant->name}}" width="80" height="60">
                            </td>
                            <td style="text-align: center">
                                {{ $tenant->name }}
                            </td>
                            <td style="text-align: center">
                                {{-- <a href="{{ route('tenants.categories', $tenant->id) }}" class="btn btn-warning"><i class="fas fa-layer-group" aria-hidden="true"></i></a> --}}
                                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info"><i class="far fa-edit"> Editar</i></a>
                                <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"> Ver</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $tenants->appends($filters)->links() }}
            @else
                {{ $tenants->links() }}
            @endif
        </div>
    </div>
@stop
