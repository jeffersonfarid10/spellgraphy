@extends('adminlte::page')

@section('title', 'Ver regla')

@section('content_header')
    <h1>Información de la regla</h1>
@stop

@section('content')

<div>
    <div class="bg-dark text-white font-bold rounded">
        <a href="{{route('admin.rules.rulepunctuation.index')}}">
            <button class="btn btn-info m-3">Volver al menú principal</button>
        </a>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <strong>Título:</strong>
            <br>
            <h1 class="card-title">{{$rulepunctuation->name}}</h1>
            <br>
            <strong>Regla principal a la que pertenece:</strong>
            <br>
            <h1 class="card-title">{{$rulepunctuation->post->name}}</h1>
            <br>
        </div>
        <br>
        <div class="card-body">
            <!-- COMPROBAR SI EL CAMPO IMAGE TIENE CONTENIDO, SI TIENE CONTENIDO SE MUESTRA EL DIV, PERO SI EL CAMPO IMAGE ES NULL QUE NO SE MUESTRE LA SECCION -->
            @isset($rulepunctuation->image)
                <li class="list-group-item">
                    <strong>Imagen:</strong>
                    <br>
                    <img id="image" name="image" src="/storage/{{$rulepunctuation->image}}" alt="" height="400px" width="700px">
                </li>
            @endisset

            <!-- COMPROBAR SI EL CAMPO DESCRIPTION TIENE CONTENIDO, SI TIENE CONTENIDO SE MUESTRA EL CONTENIDO, PERO SI EL CAMPO ES NULL QUE NO SE MUESTRE LA SECCION -->
            @isset($rulepunctuation->description)
                <div>
                    <strong>Descripción:</strong>
                    <br>
                    <p class="card-text">{!!$rulepunctuation->description!!}</p>
                </div>
            @endisset


            <!-- CAMPO BODY -->
            <div>
                <strong>Contenido:</strong>
                <br>
                <p class="card-text">{!!$rulepunctuation->body!!}</p>
            </div>


            <!-- COMPROBAR SI EL CAMPO EXAMPLE TIENE CONTENIDO, SI TIENE CONTENIDO SE MUESTRA EL CONTENIDO, PERO SI EL CAMPO ES NULL QUE NO SE MUESTRE LA SECCION -->
            @isset($rulepunctuation->example)
                <div>
                    <strong>Ejemplos:</strong>
                    <br>
                    <p class="card-text">{!!$rulepunctuation->example!!}</p>
                </div>
            @endisset


            <!-- COMPROBAR SI EL CAMPO EXCEPTION TIENE CONTENIDO, SI TIENE CONTENIDO SE MUESTRA EL CONTENIDO, PERO SI EL CAMPO ES NULL QUE NO SE MUESTRE LA SECCION -->
            @isset($rulepunctuation->exception)
                <div>
                    <strong>Excepciones:</strong>
                    <br>
                    <p class="card-text">{!!$rulepunctuation->exception!!}</p>
                </div>
            @endisset

            <!-- CON EL IF SE CUENTA SI LA RELACION CATEGORIES WORDS TIENE 1 ELEMENTO O MAS 
            ES DECIR, SI EL USUARIO HA SELECCIONADO TERMINOS PARA LA REGLA -->
            @if (count($rulepunctuation->words) > 0)
                <div>
                    <strong>Términos asociados:</strong>
                    <br>
                    @foreach ($rulepunctuation->words as $word)
                        <strong class="text-red">{{$word->name}} :</strong>
                        <br>
                        <p class="card-text">{{$word->meaning}}</p>
                        <br>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="card-footer">
            <!-- INFORMACION DE A DONDE PERTENECE LA REGLA -->
            <strong>Categoria principal</strong>
            <h6>{{$rulepunctuation->type}}</h6>
            <br>
            <strong>Categoría secundaria: </strong>
            <h6>{{$category->name}}</h6>
            <br>
            <strong>Categoría terciaria:</strong>
            <h6>{{$section->name}}</h6>
            <br>
            <strong>Categoría cuatro:</strong>
            <h6>{{$rulepunctuation->post->name}}</h6>
        </div>

        <!-- CON EL IF SE COMPRUEBA SI EXISTE MAS DE UNA REGLA DE NIVEL 4 ASOCIADAS A LA REGLA SECTIONWORD -->
        @if(count($rulepunctuation->notes) > 0)
            <div class="card-footer">
                <!-- REGLAS DE NIVEL 2 ASOCIADAS -->
                <strong>Reglas nivel cinco asociadas:</strong>
                <br>
                @foreach ($rulepunctuation->notes as $note)
                    <h6>{{$note->name}}</h6>
                @endforeach
            </div>
        @endif
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop