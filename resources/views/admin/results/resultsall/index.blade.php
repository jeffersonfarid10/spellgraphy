@extends('adminlte::page')

@section('title', 'Resultados Usuario')

@section('content_header')
    <h1>Resultados de usuarios</h1>
@stop

@section('content')

<div class="card">
    <!--MENSAJE DE SESION-->
    @if (Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{Session::get('message')}}
    </div>
    @endif

    <div class="card-body">
        @isset($users)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Id</td>
                        <th>Nombre usuario</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                                <a href="{{route('admin.results.assignedevaluations', $user)}}">
                                    <button class="btn btn-primary">Ver resultados</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- PAGINACION CON BOOSTRAP -->
            <div class="d-flex justify-content-end">
                {{$users->links()}}
            </div> 
        @else
            <strong>No hay usuarios disponibles</strong>
        @endisset
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop