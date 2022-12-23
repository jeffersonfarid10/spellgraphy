@extends('adminlte::page')

@section('title', 'Reglas ortográficas')

@section('content_header')
    <h1 class="text-white bg-dark font-bold rounded pl-3">Gestión de reglas ortográficas</h1>
@stop

@section('content')
   
<div class="m-4">
    <div class="row">
        <div class="col">
            <div class="card m-5">
                <div class="card-header text-white bg-gray-dark">
                    Reglas ortográficas nivel 1
                </div>
                <div class="card-body">
                    <br>
                    <p class="card-text">Seccion para crear, editar y eliminar las reglas ortográficas de nivel 1.</p>
                    <a href="{{route('admin.rules.categories')}}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div class="card m-5">
                <div class="card-header text-white bg-gray-dark">
                    Reglas ortográficas nivel 2
                </div>
                <div class="card-body">
                    <br>
                    <p class="card-text">Seccion para crear, editar y eliminar las reglas ortográficas de nivel 2.</p>
                    <a href="{{route('admin.rules.sections')}}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card m-5">
                <div class="card-header text-white bg-gray-dark">
                    Reglas ortográficas nivel 3
                </div>
                <div class="card-body">
                    <br>
                    <p class="card-text">Seccion para crear, editar y eliminar las reglas ortográficas de nivel 3.</p>
                    <a href="{{route('admin.rules.posts')}}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div class="card m-5">
                <div class="card-header text-white bg-gray-dark">
                    Reglas ortográficas nivel 4
                </div>
                <div class="card-body">
                    <br>
                    <p class="card-text">Seccion para crear, editar y eliminar las reglas ortográficas de nivel 4.</p>
                    <a href="{{route('admin.rules.rules')}}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div class="card m-5">
                <div class="card-header text-white bg-gray-dark">
                    Reglas ortográficas nivel 5
                </div>
                <div class="card-body">
                    <br>
                    <p class="card-text">Seccion para crear, editar y eliminar las reglas ortográficas de nivel 5.</p>
                    <a href="{{route('admin.rules.notes')}}" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop