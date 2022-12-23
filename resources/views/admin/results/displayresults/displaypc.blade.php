@extends('adminlte::page')

@section('title', 'Resultado pregunta')

@section('content_header')
    <h1>Resultado pregunta</h1>
@stop

@section('content')

<!-- ////////////////////////////////////////////////////////////////////NUEVA VISTA ADMIN RESULTADOS PC//////////////////////////////////////// -->

    <!-- BOTON REGRESAR -->
    <div>
        <a href="/admin/results/{{$userId}}/{{$evaluationId}}">
            <button class="btn btn-info">Regresar</button>
        </a>
    </div> 

    <div class="container-fluid card p-5">

        <div class="card-header">
            <!-- TITULO -->
            <h2 class="m-2 text-center"><strong class="text-red">{{$questionType->title}}</strong></h2>
            <!-- INDICACIONES DE LA PREGUNTA -->
            <div class="m-2">
                <strong class="text-red">Indicaciones de la pregunta:</strong>
                @foreach ($questionType->indications as $indication)
                    <li class="ml-4">{{$indication->indication}}</li>
                @endforeach
            </div>
        </div>
    
        <br>
        <!-- DIV RESULTADOS DE LA RESPUESTA -->
        <div class="card p-4 m-5 border border-danger">
            <div class="card-header">
                <h3 class="text-center"><strong class="text-red">Resultado de la pregunta</strong></h3>
                
            </div>
            <h4 class="text-red pt-2"><strong>Puntaje:</strong></h4>
            <h4 class="text-center"><strong>{{$sumaresultados}}</strong></h4>
        </div>


        <!-- DIV QUE CONTIENE EL ANALISIS GENERAL DE LAS RESPUESTAS DEL USUARIO -->
        <div class="container border border-dark rounded mb-5" >
            <header class="px-5 py-4 border-bottom">
                <h2 class="text-red text-center"><strong>Revisión general de tus respuestas:</strong></h2>
            </header>
            <!-- GRID CON DOS COLUMNAS QUE CONTIENE LAS PALABRAS CORRECTAS Y PALABRAS INCORRECTAS DEL USUARIO -->
            <div class="row">
                <!-- RESPUESTA USUARIO -->
                <div class="col-12 col-md-6 border">
                    <h5 class="text-red mt-4 ml-4 mb-5"><strong>Tus respuestas correctas:</strong></h5>
                    <div class="container-fluid mx-auto p-5">
                        <!-- RECORRER LAS RESPUESTAS CORRECTAS DEL USUARIO -->
                        @foreach ($palabrasAcertadas as $correcta)
                            <h4 class="text-center m-4 border border-bottom"><strong>{{$correcta}}</strong></h4>
                        @endforeach

                    </div>
                </div>
                <!-- RESPUESTA CORRECTA -->
                <div class="col-12 col-md-6 border">
                    <h5 class="text-red mt-4 ml-4 mb-5"><strong>Tus respuestas incorrectas:</strong></h5>
                    <div class="container-fluid mx-auto p-5">
                        <!-- RECORRER LAS RESPUESTAS INCORRECTAS DEL USUARIO -->
                        @foreach ($palabrasIncorrectas as $incorrecta)
                            <h4 class="text-center m-4 border-bottom"><strong>{{$incorrecta}}</strong></h4>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>


        <!-- DIV QUE CONTIENE LAS PALABRAS VISIBLES Y PALABRAS CORRECTAS -->
        <div class="container border border-dark rounded mb-5" >
            <header class="px-5 py-4 border-bottom">
                <h2 class="text-red text-center"><strong>Palabras que se analizaron:</strong></h2>
            </header>
            <!-- GRID CON DOS COLUMNAS QUE CONTIENE LAS PALABRAS CORRECTAS Y PALABRAS INCORRECTAS DEL USUARIO -->
            <div class="row">
                <!-- RESPUESTA USUARIO -->
                <div class="col-12 col-md-6 border">
                    <h5 class="text-red mt-4 ml-4 mb-5"><strong>Palabras que se mostraron en la actividad:</strong></h5>
                    <div class="container-fluid mx-auto p-5">

                        <!-- MOSTRAR LAS PALABRAS VISIBLES -->
                        @foreach ($questionType->answers as $answer)
                            <h4 class="text-center m-4 border-bottom"><strong>{{$answer->visible_answer}}</strong></h4>
                        @endforeach
                    </div>
                </div>
                <!-- RESPUESTA CORRECTA -->
                <div class="col-12 col-md-6 border">
                    <h5 class="text-red mt-4 ml-4 mb-5"><strong>Palabras correctas:</strong></h5>
                    <div class="container-fluid mx-auto p-5">

                        <!-- MOSTRAR LAS PALABRAS CORRECTAS -->
                        @foreach ($questionType->answers as $answer)
                            <h4 class="text-center m-4 border-bottom"><strong>{{$answer->answer}}</strong></h4>
                        @endforeach
                        

                    </div>
                </div>
            </div>
        </div>


        <!-- DIV QUE CONTIENE EL TITULO DE ANALISIS DE CADA RESPUESTA Y UNA DESCRIPCION -->
        <div class="p-5">
            <h1 class="text-start text-red m-5 pb-5"><strong>Revisión de cada respuesta:</strong></h1>
            <p class="h2 mb-5 text-justify">A continuación puedes ver en detalle la revisión de cada una de tus respuestas.</p>
        </div>


        <!--////////////////////////////////REVISIONES DETALLADAS DE CADA RESPUESTA DEL USUARIO -->

            <!--///////////////////////////////////PALABRA UNO -->
            <div class="container border border-dark rounded mb-5">
                
                <!-- TITULO -->
                <header class="px-5 py-4 border-bottom">
                    <h2 class="text-red text-center"><strong>Revisión respuesta uno:</strong></h2>
                </header>

                <!-- OBSERVACION -->
                <div class="px-5 py-4 border-top border-bottom m-2">
                    <h4 class="text-red mt-2 ml-4 mb-2"><strong>Observación:</strong></h4>
                    <h4 class="text-center m-4">{{$respuestaCasoUno}}</h4>
                </div>

                <!-- GRID CON DOS COLUMNAS UNA MUESTRA LA RESPUESTA DEL USUARIO Y OTRA LA RESPUESTA CORRECTA -->
                <div class="row">
                    <!-- RESPUESTA USUARIO -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Tu respuesta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraUsuarioUno}}</strong></h4>
                    </div>
                    <!-- RESPUESTA CORRECTA -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Respuesta correcta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraCorrectaUno}}</strong></h4>
                    </div>
                </div>
                
                <!-- SE CUENTA SI LA VARIABLE RESULTADOLETRASBIENCOLOCADASUNO TIENE ELEMENTOS SI ES ASI SE MUESTRA, CASO CONTRARIO NO -->
                {{--@if (!empty($resultadoLetrasBienColocadasUno))
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="gri grid-cols-1 border-2">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Letras correctas de tu respuesta:</h5>
                        <h4 class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl">{{$resultadoLetrasBienColocadasUno}}</h4>
                    </div>
                @endif--}}

                <!-- SE REVISAR SI LA VARIABLE STRING $resultadoPalabraLetrasCorrectasUno NO ESTA VACIA, SI ES ASI SE MUESTRA -->
                @if (!empty($resultadoPalabraLetrasCorrectasUno) )
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Posicionamiento correcto de las letras que ingresaste:</strong></h5>
                        <h4 class="text-center mt-4"><strong>{{$resultadoPalabraLetrasCorrectasUno}}</strong></h4>
                    </div>
                @endif

                @if (count($resultadoLetrasMalColocadasUno) > 0)
                    <!-- GRID QUE MUESTRA LAS LETRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE SON INCORRECTOS -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Elementos incorrectos de tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY PARA MOSTRAR LAS LETRAS O ELEMENTOS INCORRECTOS DE LA RESPUESTA DEL USUARIO  -->
                        <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @foreach ($resultadoLetrasMalColocadasUno as $letra)
                            <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @endforeach
                    </div>
                    
                @endif


                <!-- ACTUALIZACION AQUI SE MUESTRA EL ARRAY CON LAS LETRAS DE LA PALABRA CORRECTA QUE EL USUARIO NO COLOCO EN SU RESPUESTA -->
                @if (count($resultadoSeccionesQueLeFaltaronALaPalabraUno))
                    <!-- GRID QUE MUESTRA LAS LETRAS QUE EL USUARIO OLVIDO AGREGAR A SU RESPUESTA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Letras que no se encontraron en tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY DE LETRAS QUE EL USUARIO NO AGREGO A SU RESPUESTA -->
                        <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @foreach ($resultadoSeccionesQueLeFaltaronALaPalabraUno as $letra)
                            <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @endforeach

                    </div>

                @endif
            </div>


            
            <!--///////////////////////////////////PALABRA DOS -->
            <div class="container border border-dark rounded mb-5">
                
                <!-- TITULO -->
                <header class="px-5 py-4 border-bottom">
                    <h2 class="text-red text-center"><strong>Revisión respuesta dos:</strong></h2>
                </header>

                <!-- OBSERVACION -->
                <div class="px-5 py-4 border-top border-bottom m-2">
                    <h4 class="text-red mt-2 ml-4 mb-2"><strong>Observación: </strong></h4>
                    <h4 class="text-center m-4">{{$respuestaCasoDos}}</h4>
                </div>

                <!-- GRID CON DOS COLUMNAS UNA MUESTRA LA RESPUESTA DEL USUARIO Y OTRA LA RESPUESTA CORRECTA -->
                <div class="row">
                    <!-- RESPUESTA USUARIO -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Tu respuesta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraUsuarioDos}}</strong></h4>
                    </div>
                    <!-- RESPUESTA CORRECTA -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Respuesta correcta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraCorrectaDos}}</strong></h4>
                    </div>
                </div>
                
                <!-- SE CUENTA SI LA VARIABLE RESULTADOLETRASBIENCOLOCADASUNO TIENE ELEMENTOS SI ES ASI SE MUESTRA, CASO CONTRARIO NO -->
                {{--@if (!empty($resultadoLetrasBienColocadasUno))
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="gri grid-cols-1 border-2">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Letras correctas de tu respuesta:</h5>
                        <h4 class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl">{{$resultadoLetrasBienColocadasUno}}</h4>
                    </div>
                @endif--}}

                <!-- SE REVISAR SI LA VARIABLE STRING $resultadoPalabraLetrasCorrectasUno NO ESTA VACIA, SI ES ASI SE MUESTRA -->
                @if (!empty($resultadoPalabraLetrasCorrectasDos) )
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Posicionamiento correcto de las letras que ingresaste:</strong></h5>
                        <h4 class="text-center mt-4"><strong>{{$resultadoPalabraLetrasCorrectasDos}}</strong></h4>
                    </div>
                @endif

                @if (count($resultadoLetrasMalColocadasDos) > 0)
                    <!-- GRID QUE MUESTRA LAS LETRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE SON INCORRECTOS -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Elementos incorrectos de tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY PARA MOSTRAR LAS LETRAS O ELEMENTOS INCORRECTOS DE LA RESPUESTA DEL USUARIO  -->
                        <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @foreach ($resultadoLetrasMalColocadasDos as $letra)
                            <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @endforeach
                    </div>
                    
                @endif


                <!-- ACTUALIZACION AQUI SE MUESTRA EL ARRAY CON LAS LETRAS DE LA PALABRA CORRECTA QUE EL USUARIO NO COLOCO EN SU RESPUESTA -->
                @if (count($resultadoSeccionesQueLeFaltaronALaPalabraDos))
                    <!-- GRID QUE MUESTRA LAS LETRAS QUE EL USUARIO OLVIDO AGREGAR A SU RESPUESTA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Letras que no se encontraron en tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY DE LETRAS QUE EL USUARIO NO AGREGO A SU RESPUESTA -->
                        <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @foreach ($resultadoSeccionesQueLeFaltaronALaPalabraDos as $letra)
                            <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                        @endforeach

                    </div>

                @endif
            </div>



            <!--///////////////////////////////////PALABRA TRES -->
            <div class="container border border-dark rounded mb-5">
                
                <!-- TITULO -->
                <header class="px-5 py-4 border-bottom">
                    <h2 class="text-red text-center"><strong>Revisión respuesta tres:</strong></h2>
                </header>

                <!-- OBSERVACION -->
                <div class="px-5 py-4 border-top border-bottom m-2">
                    <h4 class="text-red mt-2 ml-4 mb-2"><strong>Observación:</strong></h4>
                    <h4 class="text-center m-4">{{$respuestaCasoTres}}</h4>
                </div>

                <!-- GRID CON DOS COLUMNAS UNA MUESTRA LA RESPUESTA DEL USUARIO Y OTRA LA RESPUESTA CORRECTA -->
                <div class="row">
                    <!-- RESPUESTA USUARIO -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Tu respuesta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraUsuarioTres}}</strong></h4>
                    </div>
                    <!-- RESPUESTA CORRECTA -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Respuesta correcta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraCorrectaTres}}</strong></h4>
                    </div>
                </div>
                
                <!-- SE CUENTA SI LA VARIABLE RESULTADOLETRASBIENCOLOCADASUNO TIENE ELEMENTOS SI ES ASI SE MUESTRA, CASO CONTRARIO NO -->
                {{--@if (!empty($resultadoLetrasBienColocadasUno))
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="gri grid-cols-1 border-2">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Letras correctas de tu respuesta:</h5>
                        <h4 class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl">{{$resultadoLetrasBienColocadasUno}}</h4>
                    </div>
                @endif--}}

                <!-- SE REVISAR SI LA VARIABLE STRING $resultadoPalabraLetrasCorrectasUno NO ESTA VACIA, SI ES ASI SE MUESTRA -->
                @if (!empty($resultadoPalabraLetrasCorrectasTres) )
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Posicionamiento correcto de las letras que ingresaste:</strong></h5>
                        <h4 class="text-center mt-4"><strong>{{$resultadoPalabraLetrasCorrectasTres}}</strong></h4>
                    </div>
                @endif

                @if (count($resultadoLetrasMalColocadasTres) > 0)
                    <!-- GRID QUE MUESTRA LAS LETRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE SON INCORRECTOS -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Elementos incorrectos de tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY PARA MOSTRAR LAS LETRAS O ELEMENTOS INCORRECTOS DE LA RESPUESTA DEL USUARIO  -->
                        <div>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @foreach ($resultadoLetrasMalColocadasTres as $letra)
                                <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                                <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @endforeach
                        </div>
                    </div>
                    
                @endif


                <!-- ACTUALIZACION AQUI SE MUESTRA EL ARRAY CON LAS LETRAS DE LA PALABRA CORRECTA QUE EL USUARIO NO COLOCO EN SU RESPUESTA -->
                @if (count($resultadoSeccionesQueLeFaltaronALaPalabraTres))
                    <!-- GRID QUE MUESTRA LAS LETRAS QUE EL USUARIO OLVIDO AGREGAR A SU RESPUESTA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Letras que no se encontraron en tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY DE LETRAS QUE EL USUARIO NO AGREGO A SU RESPUESTA -->
                        <div>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @foreach ($resultadoSeccionesQueLeFaltaronALaPalabraTres as $letra)
                                <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                                <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @endforeach
                        </div>

                    </div>

                @endif
            </div>



            <!--///////////////////////////////////PALABRA CUATRO -->
            <div class="container border border-dark rounded mb-5">
                
                <!-- TITULO -->
                <header class="px-5 py-4 border-bottom">
                    <h2 class="text-red text-center"><strong>Revisión respuesta cuatro:</strong></h2>
                </header>

                <!-- OBSERVACION -->
                <div class="px-5 py-4 border-top border-bottom m-2">
                    <h4 class="text-red mt-2 ml-4 mb-2"><strong>Observación:</strong></h4>
                    <h4 class="text-center m-4">{{$respuestaCasoCuatro}}</h4>
                </div>

                <!-- GRID CON DOS COLUMNAS UNA MUESTRA LA RESPUESTA DEL USUARIO Y OTRA LA RESPUESTA CORRECTA -->
                <div class="row">
                    <!-- RESPUESTA USUARIO -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Tu respuesta</strong>:</h5>
                        <h4 class="text-center m-4"><strong>{{$palabraUsuarioCuatro}}</strong></h4>
                    </div>
                    <!-- RESPUESTA CORRECTA -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Respuesta correcta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraCorrectaCuatro}}</strong></h4>
                    </div>
                </div>
                
                <!-- SE CUENTA SI LA VARIABLE RESULTADOLETRASBIENCOLOCADASUNO TIENE ELEMENTOS SI ES ASI SE MUESTRA, CASO CONTRARIO NO -->
                {{--@if (!empty($resultadoLetrasBienColocadasUno))
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="gri grid-cols-1 border-2">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Letras correctas de tu respuesta:</h5>
                        <h4 class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl">{{$resultadoLetrasBienColocadasUno}}</h4>
                    </div>
                @endif--}}

                <!-- SE REVISAR SI LA VARIABLE STRING $resultadoPalabraLetrasCorrectasUno NO ESTA VACIA, SI ES ASI SE MUESTRA -->
                @if (!empty($resultadoPalabraLetrasCorrectasCuatro) )
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Posicionamiento correcto de las letras que ingresaste:</strong></h5>
                        <h4 class="text-center mt-4"><strong>{{$resultadoPalabraLetrasCorrectasCuatro}}</strong></h4>
                    </div>
                @endif

                @if (count($resultadoLetrasMalColocadasCuatro) > 0)
                    <!-- GRID QUE MUESTRA LAS LETRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE SON INCORRECTOS -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Elementos incorrectos de tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY PARA MOSTRAR LAS LETRAS O ELEMENTOS INCORRECTOS DE LA RESPUESTA DEL USUARIO  -->
                        <div>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @foreach ($resultadoLetrasMalColocadasCuatro as $letra)
                                <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                                <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @endforeach
                        </div>
                    </div>
                    
                @endif


                <!-- ACTUALIZACION AQUI SE MUESTRA EL ARRAY CON LAS LETRAS DE LA PALABRA CORRECTA QUE EL USUARIO NO COLOCO EN SU RESPUESTA -->
                @if (count($resultadoSeccionesQueLeFaltaronALaPalabraCuatro))
                    <!-- GRID QUE MUESTRA LAS LETRAS QUE EL USUARIO OLVIDO AGREGAR A SU RESPUESTA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Letras que no se encontraron en tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY DE LETRAS QUE EL USUARIO NO AGREGO A SU RESPUESTA -->
                        <div>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @foreach ($resultadoSeccionesQueLeFaltaronALaPalabraCuatro as $letra)
                                <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                                <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @endforeach
                        </div>

                    </div>

                @endif
            </div>



            <!--///////////////////////////////////PALABRA CINCO -->
            <div class="container border border-dark rounded mb-5">
                
                <!-- TITULO -->
                <header class="px-5 py-4 border-bottom">
                    <h2 class="text-red text-center"><strong>Revisión respuesta cinco:</strong></h2>
                </header>

                <!-- OBSERVACION -->
                <div class="px-5 py-4 border-top border-bottom m-2">
                    <h4 class="text-red mt-2 ml-4 mb-2"><strong>Observación:</strong></h4>
                    <h4 class="text-center m-4"><strong>{{$respuestaCasoCinco}}</strong></h4>
                </div>

                <!-- GRID CON DOS COLUMNAS UNA MUESTRA LA RESPUESTA DEL USUARIO Y OTRA LA RESPUESTA CORRECTA -->
                <div class="row">
                    <!-- RESPUESTA USUARIO -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Tu respuesta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraUsuarioCinco}}</strong></h4>
                    </div>
                    <!-- RESPUESTA CORRECTA -->
                    <div class="col-12 col-md-6 border">
                        <h5 class="text-red pt-2 m-5"><strong>Respuesta correcta:</strong></h5>
                        <h4 class="text-center m-4"><strong>{{$palabraCorrectaCinco}}</strong></h4>
                    </div>
                </div>
                
                <!-- SE CUENTA SI LA VARIABLE RESULTADOLETRASBIENCOLOCADASUNO TIENE ELEMENTOS SI ES ASI SE MUESTRA, CASO CONTRARIO NO -->
                {{--@if (!empty($resultadoLetrasBienColocadasUno))
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="gri grid-cols-1 border-2">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Letras correctas de tu respuesta:</h5>
                        <h4 class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl">{{$resultadoLetrasBienColocadasUno}}</h4>
                    </div>
                @endif--}}

                <!-- SE REVISAR SI LA VARIABLE STRING $resultadoPalabraLetrasCorrectasUno NO ESTA VACIA, SI ES ASI SE MUESTRA -->
                @if (!empty($resultadoPalabraLetrasCorrectasCinco) )
                    <!-- GRID QUE MUESTRA EL POSICIONAMIENTO CORRECTO DE LAS LETRAS DE LA PALABRA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Posicionamiento correcto de las letras que ingresaste:</strong></h5>
                        <h4 class="text-center mt-4"><strong>{{$resultadoPalabraLetrasCorrectasCinco}}</strong></h4>
                    </div>
                @endif

                @if (count($resultadoLetrasMalColocadasCinco) > 0)
                    <!-- GRID QUE MUESTRA LAS LETRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE SON INCORRECTOS -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Elementos incorrectos de tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY PARA MOSTRAR LAS LETRAS O ELEMENTOS INCORRECTOS DE LA RESPUESTA DEL USUARIO  -->
                        <div>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @foreach ($resultadoLetrasMalColocadasCinco as $letra)
                                <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                                <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @endforeach
                        </div>
                    </div>
                    
                @endif


                <!-- ACTUALIZACION AQUI SE MUESTRA EL ARRAY CON LAS LETRAS DE LA PALABRA CORRECTA QUE EL USUARIO NO COLOCO EN SU RESPUESTA -->
                @if (count($resultadoSeccionesQueLeFaltaronALaPalabraCinco))
                    <!-- GRID QUE MUESTRA LAS LETRAS QUE EL USUARIO OLVIDO AGREGAR A SU RESPUESTA -->
                    <div class="px-5 py-4 border-top border-bottom m-2">
                        <h5 class="text-start text-red pt-2 mt-2 mb-2 ml-2"><strong>Letras que no se encontraron en tu respuesta:</strong></h5>
                        <!-- RECORRER EL ARRAY DE LETRAS QUE EL USUARIO NO AGREGO A SU RESPUESTA -->
                        <div>
                            <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @foreach ($resultadoSeccionesQueLeFaltaronALaPalabraCinco as $letra)
                                <span class="h4 text-center mt-4"><strong>{{$letra}}</strong></span>
                                <span class="h4 text-red pt-2 mt-2 mb-2 ml-2"><strong> | </strong></span>
                            @endforeach
                        </div>

                    </div>

                @endif
            </div>


            <!-- DIV QUE CONTIENE EL TITULO DE REGLAS QUE SE TOMARON EN CUENTA Y UNA DESCRIPCION -->
            <div class="p-5">
                <h1 class="text-start text-red m-5 pb-5"><strong>Reglas ortográficas que se tomaron en cuenta para esta actividad:</strong></h1>
                <li class="h5 mb-5 text-justify">En la siguiente sección se presentan las reglas ortográficas que se emplearon para la realización de esta actividad.</li>
                <li class="h5 mb-5 text-justify">Haz click en la regla ortográfica de tu interés y accede a más información sobre el uso de esa regla ortográfica.</li>
                <li class="h5 mb-5 text-justify">Adicionalmente, tienes algunas aclaraciones sobre la actividad que acabas de realizar.</li>
            </div>
         


            <!-- DIV QUE CONTIENE LAS REGLAS ORTOGRÁFICAS ASOCIADAS Y LAS JUSTIFICACIONES -->
    <div class="container-fluid bg-white border border-dark rounded" >
        {{--<header class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-red-500 font-sora">Reglas ortográficas tomaron en cuenta para esta actividad:</h2>
        </header>--}}

        <!-- TABLA CON DOS COLUMNAS QUE CONTIENE LAS JUSTIFICACIONES Y LA REGLA ASOCIADA -->
        <div class="p-3">
            <div class="overflow-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            {{--<th>
                                <div class="text-center">Regla ortográfica</div>
                            </th>--}}
                            <th>
                                <div class="text-center text-red">Explicación a la respuesta:</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- RECORRER LAS JUSTIFICACIONES DE RESPUESTA -->
                        @foreach ($questionType->justifications as $justification)
                            <tr>
                                {{--<td>
                                    <div class="text-center text-red"><strong>{{$justification->rule}}</strong></div>
                                </td>--}}
                                <td>
                                    <p class="text-justify">{{$justification->reason}}</p>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>



        <!-- SECCION QUE CONTIENE LAS REGLAS PARA IR A CADA UNA DE ELLAS -->
        <!-- ESTE DIV CONTIENE A LOS 3 TIPOS DE REGLAS ORTOGRAFICAS -->
        <div class="container-fluid">
            <h5 class="text-start text-red mt-4 ml-4 mb-5"><strong>Haz click en la regla ortográfica de tu interés a continuación para acceder a más información:</strong></h5>

            <!-- REGLAS ORTOGRAFICAS DE PALABRAS -->
            <!-- CON EL IF SE PREGUNTA MEDIANTE LAS VARIABLES HAYPALABRAS SI ALGUNA DE ELLAS ES TRUE, LO QUE SIGNIFICA QUE HAY REGLAS ORTOGRAFICAS DE ESE NIVEL -->
            @if (($haypalabrasencategories === true) || ($haypalabrasensections === true) || ($haypalabrasenposts === true) || ($haypalabrasenrules === true) || ($haypalabrasennotes === true))
                <div class="row row-cols-1">
                    <h5 class="text-red mt-4 ml-2"><strong>Reglas ortográficas de palabras:</strong></h5>
                    <div class="p-2">

                        <!-- SI HAY REGLAS ORTOGRAFICAS DE PALABRAS DE CUALQUIER NIVEL, AHORA PREGUNTAR INDIVIDUALMENTE PARA IR MOSTRANDO LAS REGLAS ORTOGRAFICAS -->
                        @if ($haypalabrasencategories === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL UNO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION CATEGORIES -->
                            @foreach ($questionType->categories as $categoryrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES PALABRAS -->
                                @if ($categoryrule->type === "Reglas ortográficas de palabras")
                                    {{--<a href="/estudiante/letters/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$categoryrule->name}}
                                    </a>--}}
                                    <a href="/estudiante/letters/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$categoryrule->name}}</strong>
                                    </a>
                                @endif
                                
                            @endforeach
                        @endif

                        @if ($haypalabrasensections === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL DOS ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION SECTIONS -->
                            @foreach ($questionType->sections as $sectionrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PALABRAS -->
                                @if ($sectionrule->type === "Reglas ortográficas de palabras")
                                    {{--<a href="/estudiante/letters/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$sectionrule->name}}   
                                    </a>--}}
                                    <a href="/estudiante/letters/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block" >
                                        <strong>{{$sectionrule->name}}  </strong>
                                    </a>
                                @endif
                                
                            @endforeach
                        @endif

                        @if ($haypalabrasenposts === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL TRES ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION POSTS -->
                            @foreach ($questionType->posts as $postrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PALABRAS -->
                                @if ($postrule->type === "Reglas ortográficas de palabras")
                                    @php 
                                        //CATEGORY_ID PARA BUSCAR LA CATEGORIA NIVEL 1 QUE CONTIENE A LA REGLA DE NIVEL 3
                                        $category_idpalabras = $postrule->section->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 3 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categorypalabras = DB::table('categories')->find($category_idpalabras);
                                    @endphp

                                    <!-- CON EL OBJETO CATEGORY MEDIANTE SU CAMPO SLUG, SE REFERENCIA A LA CATEGORIA NIVEL 1 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    {{--<a href="/estudiante/letters/{{$categorypalabras->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$postrule->name}}
                                    </a>--}}
                                    <a href="/estudiante/letters/{{$categorypalabras->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block" >
                                        <strong>{{$postrule->name}} </strong>
                                    </a>
                                @endif
                            @endforeach
                        @endif

                        @if ($haypalabrasenrules === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL CUATRO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION RULES -->
                            @foreach ($questionType->rules as $rulerule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PALABRAS -->
                                @if ($rulerule->type === "Reglas ortográficas de palabras")
                                    
                                    @php
                                        //MEDIANTE EL CAMPO SECTION_ID DE LA RELACION POST, SE BUSCA EL REGISTRO DE NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 4
                                        $sectionrule_idpalabras = $rulerule->post->section_id;
                                        //BUSCAR EN LA TABLA SECTIONS LA REGLA DE NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 4 MEDIANTE EL CAMPO SECTION_ID DE POST
                                        $sectionrulepalabras = DB::table('sections')->find($sectionrule_idpalabras);

                                        //MEDIANTE EL CAMPO CATEGORY_ID DE LA VARIABLE SECTIONRULEPALABRAS SE BUSCA EL REGISTRO DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 4
                                        $categoryrule_idpalabras = $sectionrulepalabras->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 4 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categoryrulepalabras = DB::table('categories')->find($categoryrule_idpalabras);

                                    @endphp
                            
                                    <!-- CON EL OBJETO CATEGORY MEDIANTE SU CAMPO SLUG, SE REFERENCIA A LA CATEGORIA NIVEL 1 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    {{--<a href="/estudiante/letters/{{$categoryrulepalabras->slug}}/{{$sectionrulepalabras->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$rulerule->name}}
                                    </a>--}}
                                    <a href="/estudiante/letters/{{$categoryrulepalabras->slug}}/{{$sectionrulepalabras->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$rulerule->name}}</strong>
                                    </a>

                                @endif
                            
                            @endforeach
                        @endif

                        @if ($haypalabrasennotes === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL CINCO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION NOTES -->
                            @foreach ($questionType->notes as $noterule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PALABRAS -->
                                @if ($noterule->type === "Reglas ortográficas de palabras")
                                    
                                    @php
                                        //MEDIANTE EL CAMPO POST_ID DE LA RELACION RULE, SE BUSCA EL REGISTRO NIVEL 3 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $postrule_idpalabras = $noterule->rule->post_id;
                                        //BUSCAR EN LA TABLA SECTIONS LA REGLA DE NIVEL 3 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO POST_ID DE RULE
                                        $postrulepalabras = DB::table('posts')->find($postrule_idpalabras);

                                        //MEDIANTE EL CAMPO SECTION_ID DE LA VARIABLE POSTRULEPALABRAS SE BUSCA EL REGISTRO NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $sectionrule_idpalabras = $postrulepalabras->section_id;
                                        //BUSCAR EN LA TABLA SECTION LA REGLA DE NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO SECTION_ID DE POST
                                        $sectionrulepalabras = DB::table('sections')->find($sectionrule_idpalabras);

                                        //MEDIANTE EL CAMPO CATEGORY_ID DE LA VARIABLE SECTIONRULEPALABRAS SE BUSCA EL REGISTRO NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $categoryrule_idpalabras = $sectionrulepalabras->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categoryrulepalabras = DB::table('categories')->find($categoryrule_idpalabras);

                                    @endphp
                            
                                    <!-- CON EL OBJETO CATEGORY MEDIANTE SU CAMPO SLUG, SE REFERENCIA A LA CATEGORIA NIVEL 1 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    {{--<a href="/estudiante/letters/{{$categoryrulepalabras->slug}}/{{$sectionrulepalabras->slug}}/{{$postrulepalabras->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$noterule->name}}
                                    </a>--}}
                                    <a href="/estudiante/letters/{{$categoryrulepalabras->slug}}/{{$sectionrulepalabras->slug}}/{{$postrulepalabras->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$noterule->name}}</strong>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif



            <!-- REGLAS ORTOGRAFICAS DE ACENTUACION -->
            <!-- CON EL IF SE PREGUNTA MEDIANTE LAS VARIABLAS HAYACENTUACION SI ALGUNA DE ELLAS ES TRUE, LO QUE SIGNIFICA QUE HAY REGLAS ORTOGRAFICAS DE ESE NIVEL -->
            @if (($hayacentuacionencategories === true ) || ($hayacentuacionensections === true) || ($hayacentuacionenposts === true) || ($hayacentuacionenrules === true) || ($hayacentuacionennotes === true))
                <div class="row row-cols-1">
                    <h5 class="text-red mt-4 ml-2"><strong>Reglas ortográficas de acentuación:</strong></h5>
                    <div class="p-2">
                        <!-- SI HAY REGLAS ORTOGRAFICAS DE ACENTUACION DE CUALQUIER NIVEL, AHORA PREGUNTA INDIVIDUALMENTE PARA IR MOSTRANDO LAS REGLAS ORTOGRAFICAS -->
                        @if ($hayacentuacionencategories === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL UNO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION CATEGORIES -->
                            @foreach ($questionType->categories as $categoryrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES ACENTUACION -->
                                @if ($categoryrule->type === "Reglas ortográficas de acentuación")
                                    {{--<a href="/estudiante/acentuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$categoryrule->name}}
                                    </a>--}}
                                    <a href="/estudiante/acentuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$categoryrule->name}}</strong>
                                    </a>
                                @endif
                               
                            @endforeach
                        @endif

                        @if ($hayacentuacionensections === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL DOS ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION SECTIONS -->
                            @foreach ($questionType->sections as $sectionrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE ACENTUACION -->
                                @if ($sectionrule->type === "Reglas ortográficas de acentuación")
                                    {{--<a href="/estudiante/acentuation/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$sectionrule->name}}    
                                    </a>--}}
                                    <a href="/estudiante/acentuation/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$sectionrule->name}}</strong>
                                    </a>
                                @endif
                                
                            @endforeach
                        @endif

                        @if ($hayacentuacionenposts === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL TRES ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION POSTS -->
                            @foreach ($questionType->posts as $postrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE ACENTUACION -->
                                @if ($postrule->type === "Reglas ortográficas de acentuación")
                                    @php 
                                        //CATEGORY_IDACENTUACION PARA BUSCAR LA CATEGORIA DE NIVEL 1 QUE CONTIENE A LA REGLA DE NIVEL 3
                                        $category_idacentuacion = $postrule->section->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 3 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categoryacentuacion = DB::table('categories')->find($category_idacentuacion);
                                    @endphp

                                    <!-- CON EL OBJETO CATEGORY MEDIANTE SU CAMPO SLUG, SE REFERENCIA A LA CATEGORIA NIVEL 1 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    {{--<a href="/estudiante/acentuation/{{$categoryacentuacion->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$postrule->name}}
                                    </a>--}}
                                    <a href="/estudiante/acentuation/{{$categoryacentuacion->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$postrule->name}}</strong>
                                    </a>
                                @endif
                                
                            @endforeach
                        @endif

                        @if ($hayacentuacionenrules === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL CUATRO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION RULES -->
                            @foreach ($questionType->rules as $rulerule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE ACENTUACION -->
                                @if ($rulerule->type === "Reglas ortográficas de acentuación")
                                    @php 

                                        //MEDIANTE EL CAMPO SECTION_ID DE LA RELACION POST, SE BUSCA EL REGISTRO NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 4
                                        $sectionrule_idacentuacion = $rulerule->post->section_id;
                                        //BUSCAR EN LA TABLA SECTIONS LA REGLA DE NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 4 MEDIANTE EL CAMPO SECTION_ID DE POST
                                        $sectionruleacentuacion = DB::table('sections')->find($sectionrule_idacentuacion);


                                        //MEDIANTE EL CAMPO CATEGORY_ID DE LA VARIABLE SECTIONRULEACENTUACION SE BUSCA EL REGISTRO NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 4
                                        $categoryrule_idacentuacion = $sectionruleacentuacion->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 4 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categoryruleacentuacion = DB::table('categories')->find($categoryrule_idacentuacion);
                                    @endphp

                                    <!-- CON EL OBJETO CATEGORY MEDIANTE SU CAMPO SLUG, SE REFERENCIA A LA CATEGORIA NIVEL 1 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    <!-- CON EL OBJETO SECTION MEDIANTE SU CAMPO SLUG SE REFERENCIA A LA SECTION NIVEL 2 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    {{--<a href="/estudiante/acentuation/{{$categoryruleacentuacion->slug}}/{{$sectionruleacentuacion->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$rulerule->name}}
                                    </a>--}}
                                    <a href="/estudiante/acentuation/{{$categoryruleacentuacion->slug}}/{{$sectionruleacentuacion->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$rulerule->name}}</strong>
                                    </a>
                                @endif
                               
                            @endforeach
                        @endif


                        @if ($hayacentuacionennotes === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL CINCO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION NOTES -->
                            @foreach ($questionType->notes as $noterule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPEE DE LA REGLA QUE SE RECORRE ES DE ACENTUACION -->
                                @if ($noterule->type === "Reglas ortográficas de acentuación")
                                    
                                    @php 

                                        //MEDIANTE EL CAMPO POST_ID DE LA RELACION RULE, SE BUSCA EL REGISTRO NIVEL 3 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $postrule_idacentuacion = $noterule->rule->post_id;
                                        //BUSCAR EN LA TABLA SECTIONS LA REGLA DE NIVEL 3 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO POST_ID DE RULE
                                        $postruleacentuacion = DB::table('posts')->find($postrule_idacentuacion);

                                        //MEDIANTE EL CAMPO SECTION_ID DE LA VARIABLE POSTRULEACENTUACION SE BUSCA EL REGISTRO NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $sectionrule_idacentuacion = $postruleacentuacion->section_id;
                                        //BUSCAR EN LA TABLA SECTION LA REGLA DE NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO SECTION_ID DE POST
                                        $sectionruleacentuacion = DB::table('sections')->find($sectionrule_idacentuacion);

                                        //MEDIANTE EL CAMPO CATEGORY_ID DE LA VARIABLE SECTIONRULEACENTUACION SE BUSCA EL REGISTRO NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $categoryrule_idacentuacion = $sectionruleacentuacion->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categoryruleacentuacion = DB::table('categories')->find($categoryrule_idacentuacion);
                                    @endphp

                                    <!-- CON EL OBJETO CATEGORY MEDIANTE SU CAMPO SLUG, SE REFERENCIA A LA CATEGORIA NIVEL 1 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    <!-- CON EL OBJETO SECTION MEDIANTE SU CAMPO SLUG SE REFERENCIA A LA SECTION NIVEL 2 EN LA RUTA DE LA REGLA ORTOGRAFICA -->
                                    {{--<a href="/estudiante/acentuation/{{$categoryruleacentuacion->slug}}/{{$sectionruleacentuacion->slug}}/{{$postruleacentuacion->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$noterule->name}}
                                    </a>--}}
                                    <a href="/estudiante/acentuation/{{$categoryruleacentuacion->slug}}/{{$sectionruleacentuacion->slug}}/{{$postruleacentuacion->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$noterule->name}}</strong>
                                    </a>

                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif
                


            <!-- REGLAS ORTOGRAFICAS DE PUNTUACION -->
            <!-- CON EL IF SE PREGUNTA MEDIANTE LAS VARIABLES HAYPUNTUACION SI ALGUNA DE ELLAS ES TRUE, LO QUE SIGNIFICA QUE HAY REGLAS ORTOGRAFICAS DE ESE NIVEL -->
            @if (($haypuntuacionencategories === true) || ($haypuntuacionensections === true) || ($haypuntuacionenposts === true) || ($haypuntuacionenrules === true) || ($haypuntuacionennotes === true))
                <div class="row row-cols-1">
                    <h5 class="text-red mt-4 ml-2"><strong>Reglas ortográficas de puntuación:</strong></h5>
                    <div class="p-2">
                        <!-- SI HAY REGLAS ORTOGRAFICAS DE PUNTUACION DE CUALQUIER NIVEL, AHORA PREGUNTAR INDIVIDUALMENTE PARA IR MOSTRANDO LAS REGLAS ORTOGRAFICAS -->
                        @if ($haypuntuacionencategories === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL UNO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION CATEGORIES -->
                            @foreach ($questionType->categories as $categoryrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PUNTUACION -->
                                @if ($categoryrule->type === "Reglas ortográficas de puntuación")
                                    {{--<a href="/estudiante/punctuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$categoryrule->name}}
                                    </a>--}}
                                    <a href="/estudiante/punctuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$categoryrule->name}}</strong>
                                    </a>
                                @endif
                                
                            @endforeach
                        @endif

                        @if ($haypuntuacionensections === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL DOS ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION SECTIONS -->
                            @foreach ($questionType->sections as $sectionrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PUNTUACION -->
                                @if ($sectionrule->type === "Reglas ortográficas de puntuación")
                                    {{--<a href="/estudiante/punctuation/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$sectionrule->name}}
                                    </a>--}}
                                    <a href="/estudiante/punctuation/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$sectionrule->name}}</strong>
                                    </a>
                                @endif
                                
                            @endforeach
                            
                        @endif

                        @if ($haypuntuacionenposts === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL TRES ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION POSTS -->
                            @foreach ($questionType->posts as $postrule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PUNTUACION -->
                                @if ($postrule->type === "Reglas ortográficas de puntuación")
                                    @php 
                                        //CATEGORY_IDPUNTUACION PARA BUSCAR LA CATEGORIA DE NIVEL 1 QUE CONTIENE A LA REGLA DE NIVEL 3
                                        $category_idpuntuacion = $postrule->section->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 3 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categorypuntuacion = DB::table('categories')->find($category_idpuntuacion);

                                    @endphp
                                    {{--<a href="/estudiante/punctuation/{{$categorypuntuacion->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$postrule->name}}
                                    </a>--}}
                                    <a href="/estudiante/punctuation/{{$categorypuntuacion->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$postrule->name}}</strong>
                                    </a>
                                @endif
                               
                            @endforeach
                        @endif

                        @if ($haypuntuacionenrules === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL CUATRO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION RULES -->
                            @foreach ($questionType->rules as $rulerule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PUNTUACION -->
                                @if ($rulerule->type === "Reglas ortográficas de puntuación")
                                    @php 
                                            
                                        //MEDIANTE EL CAMPO SECTION_ID DE LA RELACION POST, SE BUSCA EL REGISTRO NIVEL 2 QUE CONTIENE A ESTA REGLA NIVEL 4
                                        $sectionrule_idpuntuacion = $rulerule->post->section_id;
                                        //BUSCAR EN LA TABLA SECTIONS LA REGLA DE NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 4 MEDIANTE EL CAMPO SECTION_ID DE POST
                                        $sectionrulepuntuacion = DB::table('sections')->find($sectionrule_idpuntuacion);

                                        //MEDIANTE EL CAMPO CATEGORY_ID DE LA VARIABLE SECTIONRULEPUNTUACION SE BUSCA EL REGISTRO DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 4
                                        $categoryrule_idpuntuacion = $sectionrulepuntuacion->category_id;
                                        $categoryrulepuntuacion = DB::table('categories')->find($categoryrule_idpuntuacion);

                                    @endphp
                                    {{--<a href="/estudiante/punctuation/{{$categoryrulepuntuacion->slug}}/{{$sectionrulepuntuacion->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$rulerule->name}}
                                    </a>--}}
                                    <a href="/estudiante/punctuation/{{$categoryrulepuntuacion->slug}}/{{$sectionrulepuntuacion->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$rulerule->name}}</strong>
                                    </a>
                                @endif
                                
                            @endforeach
                        @endif


                        @if ($haypuntuacionennotes === true)
                            <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL CINCO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION NOTES -->
                            @foreach ($questionType->notes as $noterule)
                                <!-- CON EL IF SE PREGUNTA SI EL TYPE DEE LA REGLA QUE SE RECORRE ES DE PUNTUACION -->
                                @if ($noterule->type === "Reglas ortográficas de puntuación")
                                    @php 
                                            
                                        //MEDIANTE EL CAMPO POST_ID DE LA RELACION RULE, SE BUSCA EL REGISTRO NIVEL 3 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $postrule_idpuntuacion = $noterule->rule->post_id;
                                        //BUSCAR EN LA TABLA SECTIONS LA REGLA DE NIVEL 3 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO POST_ID DE RULE
                                        $postrulepuntuacion = DB::table('posts')->find($postrule_idpuntuacion);

                                        //MEDIANTE EL CAMPO SECTION_ID DE LA VARIABLE POSTRULEPUNTUACION SE BUSCA EL REGISTRO NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $sectionrule_idpuntuacion = $postrulepuntuacion->section_id;
                                        //BUSCAR EN LA TABLA SECTION LA REGLA DE NIVEL 2 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO SECTION_ID DE POST
                                        $sectionrulepuntuacion = DB::table('sections')->find($sectionrule_idpuntuacion);

                                        //MEDIANTE EL CAMPO CATEGORY_ID DE LA VARIABLE SECTIONRULEPUNTUACION SE BUSCA EL REGISTRO NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 5
                                        $categoryrule_idpuntuacion = $sectionrulepuntuacion->category_id;
                                        //BUSCAR EN LA TABLA CATEGORIES LA REGLA DE NIVEL 1 QUE CONTIENE A ESTA REGLA DE NIVEL 5 MEDIANTE EL CAMPO CATEGORY_ID DE SECTION
                                        $categoryrulepuntuacion = DB::table('categories')->find($categoryrule_idpuntuacion);

                                    @endphp
                                    {{--<a href="/estudiante/punctuation/{{$categoryrulepuntuacion->slug}}/{{$sectionrulepuntuacion->slug}}/{{$postrulepuntuacion->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                        {{$noterule->name}}
                                        <br>
                                    </a>--}}
                                    <a href="/estudiante/punctuation/{{$categoryrulepuntuacion->slug}}/{{$sectionrulepuntuacion->slug}}/{{$postrulepuntuacion->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" class="h5 text-start text-blue mt-2 mb-2 d-block">
                                        <strong>{{$noterule->name}}</strong>
                                    </a>
                                @endif
                                
                            @endforeach
                        @endif
                    </div>
                </div>          
            @endif




        </div>

    </div>
            


    </div>




    </div>





<!-- /////////////////////////////////////////////////////////////////////FIN NUEVA VISTA ADMIN RESULTADOS PC////////////////////////////////////////////// -->






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop