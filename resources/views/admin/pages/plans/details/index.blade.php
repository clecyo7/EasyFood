@extends('adminlte::page')

@section('title', "Detalhes doPlanos, $plan->name")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url ) }}" class="active">Detalhes</a></li>
    </ol>
    <h1>Detalhes do Plano - {{ $plan->name}} <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark">
        <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>
                                {{ $detail->name }}
                            </td>
                            <td>
                                <a href="{{ route('details.plan.edit', [$plan->url, $detail->id ]) }}" class="btn btn-info"><i class="far fa-edit"> Editar</i></a>
                                <a href="{{ route('details.plan.show', [$plan->url, $detail->id ]) }}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"> Ver</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $details->appends($filters)->links() }}
            @else
                {{ $details->links() }}
            @endif
        </div>
    </div>
@stop
