@extends('adminlte::page')

@section('title', "Detalhes da Empresa {$tenant->name}")

@section('content_header')
    <h1>Detalhes da Empresa <b>{{ $tenant->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.incluides.alerts')
        <div class="card-body">
            <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" width="150" height="150">
           <br><br>
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $tenant->name }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $tenant->url }}
                </li>
                <li>
                    <strong>E-mail:</strong> {{ $tenant->email }}
                </li>
                <li>
                    <strong>CNPJ:</strong> {{ $tenant->cnpj }}
                </li>
                <li>
                    <strong>Ativo:</strong> {{ $tenant->active == 'Y' ? 'SIM' : 'NÃO' }}
                </li>
            </ul>

            <h3>Assinatura </h3>
            <ul>
                <li>
                    <strong>Data da Assinatura: </strong> {{ $tenant->subscription }}
                </li>
                <li>
                    <strong>Data Expiração: </strong> {{ $tenant->expires_at }}
                </li>
                <li>
                    <strong>Identificador: </strong> {{ $tenant->subscription_id }}
                </li>
                <li>
                    <strong>Ativo?: </strong> {{ $tenant->subscription_active ? 'SIM' : 'NÃO' }}
                </li>
                <li>
                    <strong>Cancelou? :</strong> {{ $tenant->subscription_suspended ? 'SIM' : 'NÃO'  }}
                </li>

            </ul>

            <form action="{{ route('tenants.destroy', $tenant->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar a Empresa
                     {{ $tenant->name }}</button>
            </form>

        </div>
    </div>
@stop
