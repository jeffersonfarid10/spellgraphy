@extends('adminlte::page')

@section('title', 'Reglas de puntuación nivel cinco')

@section('content_header')
    <h1>Gestión de reglas ortográficas de puntuación nivel cinco</h1>
@stop

@section('content')

<div class="card"> 
    <div class="card-header">
        <!--MENSAJE DE SESION-->
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
    

        <div class="card-header">
            <a href="{{route('admin.notes.notepunctuation.create')}}">
                <button class="btn btn-success m-3">Crear nueva regla ortográfica de puntuación nivel cinco</button>
            </a>
        </div>
    </div>

    <!-- CON EL IF SE CUENTRA SI HAY 1 REGISTRO O MAS PARA MOSTRAR -->
    @if ($notes->count())
        <!-- MOSTRAR EL LISTADO DE REGLAS ORTOGRAFICAS DE PALABRAS NIVEL 1 (CATEGORIES) -->
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Subclasificación</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes as $notepunctuation)
                        <tr>
                            <td>{{$notepunctuation->id}}</td>
                            <td>{{$notepunctuation->name}}</td>
                            <td>{{$notepunctuation->type}}</td>
                            <td>{{$notepunctuation->clasification}}</td>
                            <td>
                                <a href="{{route('admin.notes.notepunctuation.show', $notepunctuation)}}">
                                    <button class="btn btn-primary">Ver regla</button>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('admin.notes.notepunctuation.edit', $notepunctuation)}}">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{route('admin.notes.notepunctuation.destroy', $notepunctuation)}}" method="POST">
                                    @csrf 
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- PAGINACION CON BOOSTRAP -->
            <div class="d-flex justify-content-end">
                {{$notes->links()}}
            </div> 
        </div>
    @else
        <div class="card-body">
            <strong class="text-red">No hay registros.</strong>
        </div>
    @endif
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop