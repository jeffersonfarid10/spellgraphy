<x-app-layout>


    <!-- ///////////////////////////////////////////////////////////NUEVA VISTA RESULTADOS PREGUNTA TI//////////////////////////////  -->


    <!-- SE CREA UN DIV PADRE QUE VA A SER DE COLOR BLANCO -->
    <div class="bg-white">

        <!-- SE CREA UN DIV HIJO CON CLASS CONTAINER Y QUE DEBE TENER OBLIGATORIAMENTE UN PT-24 PORQUE SINO EL NAVBAR FIXED VA A OCULTAR INFORMACION --> 
        <div class="container mx-auto pt-24 p-12">

            <!-- BOTON REGRESAR -->
            <div>
                <a href="/estudiante/resultado/{{$userId}}/evaluacion/{{$evaluationId}}">
                    <button class="px-4 py-2 rounded shadow focus:shadow-md focus:outline-none transition-all text-white bg-green-500 hover:bg-green-700 ring-green-300 focus:ring">
                        Regresar
                    </button>
                </a>
            </div> 

            <!-- DIV QUE CONTIENE EL TITULO DE LA PREGUNTA Y LAS INDICACIONES -->
            <div class="container mx-auto rounded-3xl p-5">
                <h3 class="text-2xl md:text-3xl text-left font-anton text-slate-700">{{$questionType->title}}</h3>
                <br>
                <h4 class="text-2xl md:text-2xl text-left font-anton text-red-700 m-5 pb-5">Indicaciones de la pregunta:</h4>
                <!-- INDICACIONES -->
                @foreach ($questionType->indications as $key=>$indication)
                    <p class="text-xl font-sora mb-5 text-justify">{{$key+1}}. {{$indication->indication}}</p>
                @endforeach
                
            </div>


            <!-- DIV QUE CONTIENE LA IMAGEN -->
            <!-- IMAGEN -->
            <div class="container mx-auto p-10">
                <div class="w-4/5 mx-auto">
                    <!-- IMPORTANTE PONER LA LINEA DIAGONAL AL INICIO DE LA RUTA EN LAS IMAGENES DE LAS REGLAS DE NIVEL UNO PARA ADELANTE PORQUE SINO NO VA A APARECER LA IMAGEN -->
                    <img id="image" name="imagen" src="/storage/{{$questionType->image}}" alt="" class="w-full h-full object-cover object-center rounded-lg shadow-red-200 shadow-2xl">
                </div>
            </div>  


            <!-- DIV QUE CONTIENE LA PUNTUACION DE LA PREGUNTA -->
            <div class="container mx-auto mt-10 rounded">
                <div class="w-full mx-auto bg-white shadow-lg rounded-3xl border border-gray-200">
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-red-500 font-sora text-center m-4">Resultados de tu respuesta:</h2>
                        <h4 class="font-semibold text-red-500 font-sora">Puntaje: </h4>
                        <h4 class="font-semibold text-gray-800 font-sora text-center text-2xl">{{$sumaresultados}}</h4>
                    </header>
                </div>
            </div>


            <!-- ////////////////////////////////////////REVISIONES DETALLADAS DE CADA RESPUESTA DEL USUARIO -->

            <!--//////////////////////////////////////////TEXTO IMAGEN -->


            <div class="container mt-10 w-full mx-auto bg-white shadow-lg rounded-3xl border border-gray-600">
                
                <!-- TITULO -->
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-red-500 font-sora text-center">Revisión respuesta:</h2>
                </header>
                <!-- OBSERVACION -->
                <div class="px-5 py-4 border-b border-gray-100">
                    <h4 class="font-semibold text-red-500 font-sora">Observación: </h4>
                    <h4 class="font-semibold text-gray-800 font-sora text-center text-xl">{{$respuestaParrafoUno}}</h4>
                </div>


                <!-- CON EL IF SE PREGUNTA SI LA VARIABLE RESULTADOTIUNO ES IGUAL A CERO, LO QUE SIGNIFICA QUE LA RESPUESTA
                ES INCORRECTA, SI ES ASI ENTONCES QUE APAREZCAN CUATRO ELEMENTOS: EL TEXTO DE RESPUESTA DEL USUARIO ORIGINAL,
                EL TEXTO CORRECTO ORIGINAL, EL TEXTO DE RESPUESTA DEL USUARIO REVISADO Y EL TEXTO CORRECTO REVISADO
                PERO SI LA VARIABLE RESULTADO ES DIFERENTE DE CERO, LO QUE SIGNIFICA QUE ESTA BIEN, SOLO SE MUESTRE EL TEXTO 
                RESPUESTA DEL USUARIO ORIGINAL Y EL TEXTO CORRECTO ORIGINAL-->
                <!-- RESPUESTA USUARIO -->
                @if ($resultadotiuno === 0.00)
                    <!-- SI LA RESPUESTA DEL USUARIO ES INCORRECTA ENTONCES SE ENVIAN LOS SIGUIENTES DATOS -->

                    <!-- LA RESPUESTA DEL USUARIO ORIGINAL SE MUESTRA MEDIANTE LA VARIABLE  stringseccionestextotausuario 
                    QUE VA A MOSTRAR DONDE EL USUARIO HA COLOCADO ESPACIOS DEMAS SI FUESE EL CASO -->
                    <!-- ESTA SECCION SE PUEDE COMENTAR POR EL ELEMENTO $textoUsuario SI LUEGO NO QUIERO QUE SE MUESTREN LOS ESPACIOS AÑADIDOS -->
                    
                    <!-- ESTE GRID CONTIENE LA RESPUESTA ORIGINAL DEL USUARIO Y LA RESPUESTA CORRECTA EN DOS COLUMNAS SE COMENTO PARA AGREGAR
                    EN LA PARTE DE ABAJAO EN DOS FILAS DIFERENTES EL TEXTO DEL USUARIO Y EL TEXTO CORRECTO -->
                    <!-- GRID CON DOS COLUMNAS UNA MUESTRA LA RESPUESTA DEL USUARIO Y OTRA LA RESPUESTA CORRECTA -->
                    {{--<div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-800 rounded">
                        <!-- RESPUESTA USUARIO -->
                        <div class="container mx-auto p-5">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Tu respuesta:</h5>

                            <!-- CON EL IF SE PREGUNTA SI LA VARIABLE $existenespacios ES TRUE, ENTONCES SE MUESTRA LA RESPUESTA DEL USUARIO CON LOS "_" Y EL
                            MENSAJE QUE HAY ESPACIOS ADICIONALES EN LA RESPUESTA, PERO SI ES FALSE, ES DECIR NO TIENE ESPACIOS, SOLO SE MUESTRA LA RESPUESTA DEL USUARIO -->
                            @if ($existenespaciosti)
                                <label class="text-gray-500">Si tu respuesta posee "_" dentro del enunciado, significa que agregaste espacios adicionales entre palabras o signos.</label>
                                <h4 class="font-semibold text-gray-800 font-sora text-justify text-2xl">{{$stringseccionestextotiusuario}}</h4>
                                
                            @else
                            <h4 class="font-semibold text-gray-800 font-sora text-justify text-2xl">{{$stringseccionestextotiusuario}}</h4>
                            @endif
                            
                        </div>
                        <!-- RESPUESTA CORRECTA -->
                        <div class="container mx-auto p-5">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Respuesta correcta:</h5>
                            <h4 class="font-semibold text-gray-800 font-sora text-justify text-2xl">{{$textoCorrecto}}</h4>
                        </div>
                    </div>--}}

                    <!-- GRID QUE MUESTRA LA RESPUESTA DEL USUARIO -->
                    <div class="grid grid-cols-1 border-2">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Tu respuesta:</h5>
                        <!-- CON EL IF SE PREGUNTA SI LA VARIABLE $existenespacios ES TRUE, ENTONCES SE MUESTRA LA RESPUESTA DEL USUARIO CON LOS "_" Y EL
                        MENSAJE QUE HAY ESPACIOS ADICIONALES EN LA RESPUESTA, PERO SI ES FALSE, ES DECIR NO TIENE ESPACIOS, SOLO SE MUESTRA LA RESPUESTA DEL USUARIO -->
                            @if ($existenespaciosti)
                                <label class="text-gray-500 pl-4">Si tu respuesta posee "_" dentro del enunciado, significa que agregaste espacios adicionales entre palabras o signos.</label>
                                <h4 class="font-semibold text-gray-800 font-sora text-justify text-2xl m-4">{{$stringseccionestextotiusuario}}</h4>
                                
                            @else
                                <h4 class="font-semibold text-gray-800 font-sora text-justify text-2xl m-4">{{$stringseccionestextotiusuario}}</h4>
                            @endif
                    </div>
                    <!-- GRID QUE MUESTRA LA RESPUESTA CORRECTA -->
                    <div class="grid grid-cols-1 border-2">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Texto correcto:</h5>
                        <h4 class="font-semibold text-gray-800 font-sora text-justify text-xl md:text-2xl m-2">{{$textoCorrecto}}</h4>
                    </div>

                    <!-- LAS SIGUIENTES SECCIONES SOLO SE MUESTRAN SI EL USUARIO HA OMITIDO SIGNOS O PALABRAS EN SU RESPUESTA 
                    SI SOLO TIENE ESPACIOS ADICIONALES EN BLANCO, NO SE MUESTRAN ESTAS SECCIONES-->
                    @if (($hayUnEspacioEnBlancoTextoImagen === true) && 
                        (count($resultadoSignosIncorrectosParrafoUsuario) === 0) && (count($resultadoSignosQueLeFaltaronParrafoUsuario) === 0) &&
                        (count($resultadoSeccionesQueLeFaltaronParrafoUsuario) === 0))
                        <div class="grid grid-cols-1 border-2 p-4">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5 text-center text-xl">Revisa tu respuesta. Haz agregado espacios en blanco adicionales "_" en tu respuesta.</h5>
                        
                        </div>   
                    @else

                        <!-- SI LA RESPUESTA TIENE ESPACIOS EN BLANCO Y ADEMAS TIENE OTROS ELEMENTOS INCORRECTOS QUE APAREZCA ESTE MENSAJE -->
                        @if ($mensajeEspacioBlancoTextoImagen === true)
                            <div class="grid grid-cols-1 border-2 p-4">
                                <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5 text-center text-xl">Revisa tu respuesta original. Haz agregado espacios en blanco adicionales "_" en tu respuesta.</h5>
                            
                            </div>
                            <!-- TITULO PARA MOSTRAR LA REVISION DETALLADA DE LA RESPUESTA -->
                            <div class="grid grid-cols-1 border-2 p-4">
                                <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5 text-center text-xl">
                                    A continuación puedes revisar los elementos incorrectos de tu respuesta.</h5>
                                <h5 class="font-bold font-sora text-black mt-4 ml-4 mb-5 text-center text-xl">
                                    *Se han eliminado los espacios adicionales que agregaste en tu respuesta*.</h5>
                                
                            </div>
                        @else 

                            <!-- TITULO PARA MOSTRAR LA REVISION DETALLADA DE LA RESPUESTA -->
                            <div class="grid grid-cols-1 border-2 p-4">
                                <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5 text-center text-xl">
                                    A continuación puedes revisar los elementos incorrectos de tu respuesta.</h5>
                                
                            </div>

                        @endif

                        <!-- GRID QUE MUESTRA DE COLOR ROJO LOS ELEMENTOS INCORRECTOS DE LA RESPUESTA DEL USUARIO -->
                        <div class="grid grid-cols-1 border-2 p-4">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Revisión de tu respuesta:</h5>
                            <p class="text-lg mt-4 ml-4 mb-5">Se marcan de color rojo los elementos incorrectos de tu respuesta.</p>
                            <h4 id="textousuario" class="font-semibold text-gray-800 font-sora text-justify text-xl md:text-2xl">{{$textoUsuario}}</h4>
                        </div>
                        <!-- GRID QUE MUESTRA DE COLOR VERDE LOS ELEMENTOS DE LA RESPUESTA CORRECTA QUE NO SE ENCONTRARON EN LA ORACION DEL USUARIO -->
                        <div class="grid grid-cols-1 border-2 p-4">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Comparación con la respuesta correcta:</h5>
                            <p class="text-lg mt-4 ml-4 mb-5">Se marcan de color verde los elementos de la respuesta correcta que no se encontraron en tu respuesta.</p>
                            <h4 id="textocorrecto" class="font-semibold text-gray-800 font-sora text-justify text-xl md:text-2xl">{{$textoCorrecto}}</h4>
                        </div>
                    @endif

                    <!-- GRID QUE MUESTRA DE COLOR ROJO LOS ELEMENTOS INCORRECTOS DE LA RESPUESTA DEL USUARIO -->
                    {{--<div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Revisión de tu respuesta:</h5>
                        <p class="text-lg mt-4 ml-4 mb-5">Se marcan de color rojo los elementos incorrectos de tu respuesta.</p>
                        <h4 id="textousuario" class="font-semibold text-gray-800 font-sora text-justify text-xl md:text-2xl">{{$textoUsuario}}</h4>
                    </div>
                    <!-- GRID QUE MUESTRA DE COLOR VERDE LOS ELEMENTOS DE LA RESPUESTA CORRECTA QUE NO SE ENCONTRARON EN LA ORACION DEL USUARIO -->
                    <div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Comparación con la respuesta correcta:</h5>
                        <p class="text-lg mt-4 ml-4 mb-5">Se marcan de color verde los elementos de la respuesta correcta que no se encontraron en tu respuesta.</p>
                        <h4 id="textocorrecto" class="font-semibold text-gray-800 font-sora text-justify text-xl md:text-2xl">{{$textoCorrecto}}</h4>
                    </div>--}}
                
                @else 
                    <!-- SI LA RESPUESTA ES CORRECTA SOLO SE MUESTRAN LA RESPUESTA DEL USUARIO ORIGINAL Y LA RESPUESTA CORRECTA ORIGINAL -->
                    <!-- RESPUESTA DEL USUARIO -->

                    <!-- GRID CON DOS COLUMNAS UNA MUESTRA LA RESPUESTA DEL USUARIO Y OTRA LA RESPUESTA CORRECTA -->
                    {{--<div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-800 rounded">
                        <!-- RESPUESTA USUARIO -->
                        <div class="container mx-auto p-5">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Tu respuesta:</h5>
                            <h4 id="textousuario" class="font-semibold text-gray-800 font-sora text-center text-2xl">{{$textoUsuario}}</h4>
                        </div>
                        <!-- RESPUESTA CORRECTA -->
                        <div class="container mx-auto p-5">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Respuesta correcta:</h5>
                            <h4 id="textocorrecto" class="font-semibold text-gray-800 font-sora text-center text-2xl">{{$textoCorrecto}}</h4>
                        </div>
                    </div>--}}


                    <!-- RESPUESTA USUARIO -->
                    <div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Tu respuesta:</h5>
                        <h4 id="textousuario" class="font-semibold text-gray-800 font-sora text-justify text-2xl">{{$textoUsuario}}</h4>
                    </div>
                    <!-- RESPUESTA CORRECTA -->
                    <div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Respuesta correcta:</h5>
                        <h4 id="textocorrecto" class="font-semibold text-gray-800 font-sora text-justify text-2xl">{{$textoCorrecto}}</h4>
                    </div>

                @endif

                <!-- PALABRAS Y SECCIONES DE LA RESPUESTA DEL USUARIO QUE SON INCORRECTAS -->
                <!-- SE PONE CON IF PARA QUE EL DIV SOLO APAREZCA CUANDO EL USUARIO TENGA PALABRAS O SECCIONES INCORRECTAS
                EN LA RESPUESTA -->
                @if (count($resultadoSeccionesParrafoUsuarioIncorrectas) > 0)
                    <!-- GRID QUE MUESTRA LAS PALABRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE NO TIENEN NADA QUE VER CON LA RESPUESTA CORRECTA -->
                    <div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Elementos incorrectos de tu respuesta:</h5>
                        <p class="text-lg mt-4 ml-4 mb-5">Los siguientes elementos de tu respuesta son incorrectos.</p>

                        <!-- SE CAMBIO EL RESULTADOENUNCIADOPALABRASINCORRECTASUSUARIOUNO POR EL RESULTADOSECCIONESINCORRECTASENUNCIADOUSUARIOUNO QUE ANALIZA TANTO PALABRAS COMO SECCIONES
                        DE LA RESPUESTA DEL USUARIO QUE ESTEN INCORRECTAS -->
                        <!-- SE AGREGA ARRAY_UNIQUE AL ARRAY PARA QUE NO MUESTRE ELEMENTOS REPETIDOS -->
                        <div>
                            <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                            @foreach (array_unique($resultadoSeccionesParrafoUsuarioIncorrectas) as $key=>$elemento)
                                <span id="palabrasIncorrectasParrafoUsuario" name="palabrasIncorrectasParrafoUsuario" class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl ml-4">{{$elemento}}</span>
                                <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                                
                            @endforeach
                        </div>
                        
                    </div>
                @endif

                <!-- SIGNOS DE LA RESPUESTA DEL USUARIO QUE SON INCORRECTOS -->
                <!-- SE PONE CON IF PARA QUE EL DIV SOLO APAREZCA CUANDO EL USUARIO TENGA SIGNOS INCORRECTOS EN SU RESPUESTA -->
                @if (count($resultadoSignosIncorrectosParrafoUsuario) > 0)

                    <!-- GRID QUE MUESTRA LAS PALABRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE NO TIENEN NADA QUE VER CON LA RESPUESTA CORRECTA -->
                    <div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Elementos ortográficos incorrectos:</h5>
                        <p class="text-lg mt-4 ml-4 mb-5">Los siguientes elementos ortográficos incorrectos fueron encontrados en tu respuesta.</p>

                        
                        <div>
                            <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                            @foreach ($resultadoSignosIncorrectosParrafoUsuario as $elemento)
                                <span id="signosIncorrectosParrafoUsuario" name="signosIncorrectosParrafoUsuario" class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl ml-4">{{$elemento}}</span>
                                <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                                
                            @endforeach
                        </div>
                        
                    </div>

                @endif


                <!-- SIGNOS QUE LE FALTARON AL USUARIO UNO -->
                <!-- SE PONE CON IF PARA QUE EL DIV SOLO APAREZCA CUANDO EL USUARIO TENGA SIGNOS DE LA ORACION CORRECTA QUE
                NO PUSO EN SU RESPUESTA -->
                @if (count($resultadoSignosQueLeFaltaronParrafoUsuario) > 0)

                    <!-- GRID QUE MUESTRA LAS PALABRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE NO TIENEN NADA QUE VER CON LA RESPUESTA CORRECTA -->
                    <div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Signos de puntuación no encontrados en tu respuesta:</h5>
                        <p class="text-lg mt-4 ml-4 mb-5">Los siguientes signos de puntuación no fueron encontrados en tu respuesta.</p>

                        
                        <div>
                            <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                            @foreach ($resultadoSignosQueLeFaltaronParrafoUsuario as $elemento)
                                <span id="signosQueLeFaltaronAlUsuario" name="signosQueLeFaltaronAlUsuario" class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl ml-4">{{$elemento}}</span>
                                <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                                
                            @endforeach
                        </div>
                        
                    </div>
                    
                @endif


                <!-- SECCIONES QUE ESTAN INCORRECTAS DEL USUARIO UNO -->
                <!-- SE PONE CON IF PARA QUE EL DIV SOLO APAREZCA CUANDO EL USUARIO TENGA SECCIONES DE SU RESPUESTA
                QUE ESTEN INCORRECTAS -->
                @if (count($resultadoSeccionesQueLeFaltaronParrafoUsuario) > 0)
                    <!-- GRID QUE MUESTRA LAS PALABRAS O ELEMENTOS DE LA RESPUESTA DEL USUARIO QUE NO TIENEN NADA QUE VER CON LA RESPUESTA CORRECTA -->
                    <div class="grid grid-cols-1 border-2 p-4">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Secciones de la respuesta correcta no encontradas en tu respuesta:</h5>
                        <p class="text-lg mt-4 ml-4 mb-5">Las siguientes secciones no se encontraron en tu respuesta debido a que colocaste incorrectamente ciertos signos de puntuación o escribiste palabras incorrectamente.
                            En la respuesta correcta se marcan de color verde las secciones que no se encontraron en tu texto.
                        </p>

                        
                        <div>
                            <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                            @foreach ($resultadoSeccionesQueLeFaltaronParrafoUsuario as $elemento)
                                <span id="seccionesQueLeFaltaronAlUsuario" name="seccionesQueLeFaltaronAlUsuario" class="font-semibold text-gray-800 font-sora text-center text-xl md:text-2xl ml-4">{{$elemento}}</span>
                                <span class="font-semibold text-red-500 font-sora text-center text-xl md:text-2xl ml-4"> | </span>
                                
                            @endforeach
                        </div>
                        
                    </div>
                @endif 
                

            </div>


            <!-- DIV QUE CONTIENE EL TITULO DE REGLAS QUE SE TOMARON EN CUENTA Y UNA DESCRIPCION -->
            <div class="container mx-auto rounded-3xl p-5">
                <h4 class="text-2xl md:text-2xl text-left font-anton text-red-700 m-5 pb-5">Reglas ortográficas que se tomaron en cuenta para esta actividad:</h4>
                <li class="text-xl font-sora mb-5 text-justify">En la siguiente sección se presentan las reglas ortográficas que se emplearon para la realización de esta actividad.</li>
                <li class="text-xl font-sora mb-5 text-justify">Haz click en la regla ortográfica de tu interés y accede a más información sobre el uso de esa regla ortográfica.</li>
                <li class="text-xl font-sora mb-5 text-justify">Adicionalmente, tienes algunas aclaraciones sobre la actividad que acabas de realizar.</li>
            </div>


            <!-- DIV QUE CONTIENE LAS REGLAS ORTOGRÁFICAS ASOCIADAS Y LAS JUSTIFICACIONES -->
            <div class="container mt-10 w-full mx-auto bg-white shadow-lg rounded-3xl border border-gray-600" >
                {{--<header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-red-500 font-sora">Reglas ortográficas tomaron en cuenta para esta actividad:</h2>
                </header>--}}

                <!-- TABLA CON DOS COLUMNAS QUE CONTIENE LAS JUSTIFICACIONES Y LA REGLA ASOCIADA -->
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class=" bg-gray-200 rounded-2xl">
                                <tr>
                                    {{--<th class="p-2 whitespace-nowrap">
                                        <div class=" text-center font-bold font-sora text-red-500 mt-4 ml-4 mb-5">Regla ortográfica</div>
                                    </th>--}}
                                    <th class="p-2 whitespace-nowrap">
                                        <div class=" text-center font-bold font-sora text-red-500 mt-4 ml-4 mb-5 text-xl">Explicación a la respuesta:</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">

                                <!-- RECORRER LAS JUSTIFICACIONES DE RESPUESTA -->
                                @foreach ($questionType->justifications as $justification)
                                    <tr>
                                        {{--<td class="p-2 whitespace-nowrap ">
                                            <div class="text-center font-sora font-medium text-xl">{{$justification->rule}}</div>
                                        </td>--}}
                                        <td>
                                            <p class="text-justify font-sora text-lg m-2">{{$justification->reason}}</p>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>



                <!-- SECCION QUE CONTIENE LAS REGLAS PARA IR A CADA UNA DE ELLAS -->
                <!-- ESTE DIV CONTIENE A LOS 3 TIPOS DE REGLAS ORTOGRAFICAS -->
                <div class="grid grid-cols-1  divide-y md:divide-y-0 md:divide-x-0 divide-gray-800 rounded">
                    <div class="container bg-slate-300 border-y border-slate-200">
                        <h5 class="font-bold font-sora text-red-500 mt-4 ml-4 mb-5 text-center text-xl">Haz click en la regla ortográfica de tu interés a continuación para acceder a más información:</h5>
                    </div>

                    <!-- REGLAS ORTOGRAFICAS DE PALABRAS -->
                    <!-- CON EL IF SE PREGUNTA MEDIANTE LAS VARIABLES HAYPALABRAS SI ALGUNA DE ELLAS ES TRUE, LO QUE SIGNIFICA QUE HAY REGLAS ORTOGRAFICAS DE ESE NIVEL -->
                    @if (($haypalabrasencategories === true) || ($haypalabrasensections === true) || ($haypalabrasenposts === true) || ($haypalabrasenrules === true) || ($haypalabrasennotes === true))
                        <div class="grid grid-cols-1">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4">Reglas ortográficas de palabras:</h5>
                            <div class="container mx-auto p-5">

                                <!-- SI HAY REGLAS ORTOGRAFICAS DE PALABRAS DE CUALQUIER NIVEL, AHORA PREGUNTAR INDIVIDUALMENTE PARA IR MOSTRANDO LAS REGLAS ORTOGRAFICAS -->
                                @if ($haypalabrasencategories === true)
                                    <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL UNO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION CATEGORIES -->
                                    @foreach ($questionType->categories as $categoryrule)
                                        <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES PALABRAS -->
                                        @if ($categoryrule->type === "Reglas ortográficas de palabras")
                                            {{--<a href="/estudiante/letters/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                                {{$categoryrule->name}}
                                            </a>--}}
                                            <a href="/estudiante/letters/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$categoryrule->name}}</button>
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
                                            <a href="/estudiante/letters/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$sectionrule->name}}  </button>
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
                                            <a href="/estudiante/letters/{{$categorypalabras->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$postrule->name}} </button>
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
                                            <a href="/estudiante/letters/{{$categoryrulepalabras->slug}}/{{$sectionrulepalabras->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$rulerule->name}}</button>
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
                                            <a href="/estudiante/letters/{{$categoryrulepalabras->slug}}/{{$sectionrulepalabras->slug}}/{{$postrulepalabras->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$noterule->name}}</button>
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
                        <div class="grid grid-cols-1">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4">Reglas ortográficas de acentuación:</h5>
                            <div class="container mx-auto p-5">
                                <!-- SI HAY REGLAS ORTOGRAFICAS DE ACENTUACION DE CUALQUIER NIVEL, AHORA PREGUNTA INDIVIDUALMENTE PARA IR MOSTRANDO LAS REGLAS ORTOGRAFICAS -->
                                @if ($hayacentuacionencategories === true)
                                    <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL UNO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION CATEGORIES -->
                                    @foreach ($questionType->categories as $categoryrule)
                                        <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES ACENTUACION -->
                                        @if ($categoryrule->type === "Reglas ortográficas de acentuación")
                                            {{--<a href="/estudiante/acentuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                                {{$categoryrule->name}}
                                            </a>--}}
                                            <a href="/estudiante/acentuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$categoryrule->name}}</button>
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
                                            <a href="/estudiante/acentuation/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$sectionrule->name}}</button>
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
                                            <a href="/estudiante/acentuation/{{$categoryacentuacion->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$postrule->name}}</button>
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
                                            <a href="/estudiante/acentuation/{{$categoryruleacentuacion->slug}}/{{$sectionruleacentuacion->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$rulerule->name}}</button>
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
                                            <a href="/estudiante/acentuation/{{$categoryruleacentuacion->slug}}/{{$sectionruleacentuacion->slug}}/{{$postruleacentuacion->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$noterule->name}}</button>
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
                        <div class="grid grid-cols-1">
                            <h5 class="font-bold font-sora text-red-500 mt-4 ml-4">Reglas ortográficas de puntuación:</h5>
                            <div class="container mx-auto p-5">
                                <!-- SI HAY REGLAS ORTOGRAFICAS DE PUNTUACION DE CUALQUIER NIVEL, AHORA PREGUNTAR INDIVIDUALMENTE PARA IR MOSTRANDO LAS REGLAS ORTOGRAFICAS -->
                                @if ($haypuntuacionencategories === true)
                                    <!-- SI HAY REGLAS ORTOGRAFICAS DE NIVEL UNO ENTONCES MOSTRAR LAS REGLAS RECORRIENDO LA COLECCION DE LA PREGUNTA CON LA RELACION CATEGORIES -->
                                    @foreach ($questionType->categories as $categoryrule)
                                        <!-- CON EL IF SE PREGUNTA SI EL TYPE DE LA REGLA QUE SE RECORRE ES DE PUNTUACION -->
                                        @if ($categoryrule->type === "Reglas ortográficas de puntuación")
                                            {{--<a href="/estudiante/punctuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" class="text-blue-500">
                                                {{$categoryrule->name}}
                                            </a>--}}
                                            <a href="/estudiante/punctuation/{{$categoryrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$categoryrule->name}}</button>
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
                                            <a href="/estudiante/punctuation/{{$sectionrule->category->slug}}/{{$sectionrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$sectionrule->name}}</button>
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
                                            <a href="/estudiante/punctuation/{{$categorypuntuacion->slug}}/{{$postrule->section->slug}}/{{$postrule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$postrule->name}}</button>
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
                                            <a href="/estudiante/punctuation/{{$categoryrulepuntuacion->slug}}/{{$sectionrulepuntuacion->slug}}/{{$rulerule->post->slug}}/{{$rulerule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$rulerule->name}}</button>
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
                                            <a href="/estudiante/punctuation/{{$categoryrulepuntuacion->slug}}/{{$sectionrulepuntuacion->slug}}/{{$postrulepuntuacion->slug}}/{{$noterule->rule->slug}}/{{$noterule->slug}}" target="_blank" rel="noopener noreferrer" >
                                                <button class="text-left text-lg font-sora font-semibold text-blue-700 block my-2">{{$noterule->name}}</button>
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






    <!-- ///////////////////////////////////////////////////////////////FIN NUEVA VISTA RESULTADOS PREGUNTA TI//////////////////////////////////// -->




    

    <!-- SCRIPT JUEGO -->
    <script src="{{asset('/js/resaltarti.js')}}"></script>
</x-app-layout>