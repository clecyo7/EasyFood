@extends('adminlte::page')

@section('title', "Perfis disponíveis para o Plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.profiles', $plan->id) }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles.available', $plan->id) }}">Disponíveis</a></li>
    </ol>
    <h1>Perfis disponíveis para o Plano  <strong>{{ $plan->name }}</strong>
    @stop

    @section('content')
        <div class="card">
            @include('admin.incluides.alerts')
            <div class="card-header">
                <form action="{{ route('plans.profiles.available', $plan->id) }}" method="POST" class="form form-inline">
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
                        <form action="{{ route('plans.profiles.attch', $plan->id)}}" method="POST">
                            @csrf
                            @foreach ($profiles as $profile)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="profiles[]"
                                            value="{{ $profile->id }}">
                                    </td>
                                    <td>
                                        {{ $profile->name }}
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
                    {{ $profiles->appends($filters)->links() }}
                @else
                    {{ $profiles->links() }}
                @endif
            </div>
        </div>
    @stop
