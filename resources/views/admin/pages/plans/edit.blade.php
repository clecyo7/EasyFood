@extends('adminlte::page')

@section('title', "Editar o plano {$plan->name}")

@section('content_header')
    <h1>Editar o plano <i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $plan->name }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">
                @method('PUT')
                @csrf
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop
