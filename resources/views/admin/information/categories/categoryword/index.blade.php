@extends('adminlte::page')

@section('title', 'Reglas palabras nivel uno')

@section('content_header')
    <h1>Gestión de reglas ortográficas de palabras nivel uno</h1>
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
            <a href="{{route('admin.categories.categoryword.create')}}">
                <button class="btn btn-success m-3">Crear nueva regla ortográfica de palabras nivel uno</button>
            </a>
        </div>
    </div>

    <!-- CON EL IF SE CUENTRA SI HAY 1 REGISTRO O MAS PARA MOSTRAR -->
    @if ($categories->count())
        <!-- MOSTRAR EL LISTADO DE REGLAS ORTOGRAFICAS DE PALABRAS NIVEL 1 (CATEGORIES) -->
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        {{--<th>Subclasificación</th>--}}
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categoryword)
                        <tr>
                            <td>{{$categoryword->id}}</td>
                            <td>{{$categoryword->name}}</td>
                            <td>{{$categoryword->type}}</td>
                            {{--<td>{{$categoryword->clasification}}</td>--}}
                            <td>
                                <a href="{{route('admin.categories.categoryword.show', $categoryword)}}">
                                    <button class="btn btn-primary">Ver regla</button>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('admin.categories.categoryword.edit', $categoryword)}}">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{route('admin.categories.categoryword.destroy', $categoryword)}}" method="POST">
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
                {{$categories->links()}}
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