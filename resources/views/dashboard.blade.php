<x-app-layout>

    <!-- ANTIGUA VISTA DASHBOARD -->
{{--<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
--}}               {{--<x-jet-welcome />--}}
{{--            </div>
        </div>
    </div>
    hola dashboard
--}}


    <!-- //////////////////////////////////////////////////////////IMPORTANTE NUEVO DASHBOARD///////////////////////////////// -->


    <!-- VISTA DE PAGINA DASHBOARD -->
    <!-- SE CREA UN DIV PADRE QUE VA A SER DE COLOR BLANCO -->
    <div class="bg-white">
        <!-- SE CREA UN DIV HIJO CON CLASS CONTAINER Y QUE DEBE TENER OBLIGATORIAMENTE UN PT-24 PORQUE SINO EL NAVBAR FIXED VA A TAPAR LA INFORMACION -->
        <div class="container mx-auto pt-24 bg-sky-200 rounded-xl p-12">
            <!-- TITULO CON DEGRADADO -->
            <h1 class="mb-4 text-3xl font-extrabold md:text-5xl lg:text-6xl text-center font-anton tracking-wide border-white border-8 rounded"><span class="text-transparent bg-clip-text bg-gradient-to-r to-purple-700 from-blue-800">Bienvenido a SpellGraphy</span></h1>
        </div>



        <!-- GRID QUE CONTIENE 2 COLUMNAS 1 PARA EL VIDEO Y OTRA PARA UNA IMAGEN CON UN LOGOTIPO -->
        <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 p-10">

            <!-- VIDEO -->
            <div class= "col-span-1 aspect-video p-10">
                <video controls>
                    <source src="/videos/videofondo.mp4" type="video/mp4">
                </video>
            </div>
            <!-- IMAGEN CON FRASE DE ORTOGRAFIA: MEJORA TUS CONOCIMIENTOS DE ORTOGRAFIA CON SPELLGRAPHY -->
            <div>
                <img src="imagenesapp/imagenuno.jpg" alt="" class="object-cover object-center w-full h-full rounded-lg">
            </div>
        </div>

        <!-- CONTENEDOR QUE VA A CONTENER LA DESCRIPCION DE LA APLICACION -->
        <div class="container mx-auto p-10 ">
            <h3 class="text-2xl sm:text-3xl md:text-4xl text-left font-anton text-slate-700">Sobre esta aplicaci??n:</h3>

            <!-- DIV QUE CONTIENE LA DESCRIPCION DE LA PAGINA, AL FINAL SE PONE OVERFLOW-AUTO PARA QUE SI EL CONTENIDO
            EXCEDE EL DIV, ESTE NO SALGA DE AQUI -->
            <div class="bg-slate-400 m-10 p-12 overflow-auto rounded-xl">
                <p class="text-sm text-justify md:text-xl font-sora">
                    SpellGraphy es una aplicaci??n web orientada a promover el uso correcto de las reglas ortogr??ficas, las cuales son
                    parte fundamental para la correcta escritura de textos en el lenguaje espa??ol. A trav??s de esta aplicaci??n tendr??s
                    disponible informaci??n sobre reglas ortogr??ficas para la correcta escritura de palabras, la correcta colocaci??n de los signos de acentuaci??n 
                    y signos de puntuaci??n; as?? como actividades que te har??n reforzar tus conocimientos o aprender nuevos contenidos sobre la ortograf??a. 
                    
                </p>
                <br>
                    <p class="text-center text-2xl font-sans font-bold">SpellGraphy se divide en varias secciones que se detallan a continuaci??n.</p>
            </div>
        </div>

        <!-- CONTENEDOR CON LAS SECCIONES A DE EVALUACIONES A LAS QUE PUEDE INGRESAR -->
        <div class="container mx-auto p-10">
            <h3 class="text-2xl sm:text-3xl md:text-4xl text-left font-anton text-slate-700 m-5">Secci??n de actividades:</h3>
            <p class="text-xl font-sora m-5">En esta secci??n tienes a tu disposici??n las actividades que puedes realizar en SpellGraphy. Puedes ingresar a la p??gina de tu inter??s desde
                esta secci??n o desde el men?? de navegaci??n que se encuentra en la parte superior.
            </p>
            <!-- CONTENEDOR CON 2 CARD 1 PARA LA EVALUACION DE DIAGNOSTICO Y UNA PARA LA EVALUACION FINAL -->
            <div class="container mx-auto py-16 bg-gray-800 rounded-xl w-full">
                <div class="mx-auto grid gap-6 md:w-3/4 lg:w-full lg:grid-cols-3">
                    <!-- CARD UNO -->
                    <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 m-10 transform  hover:scale-125 transition duration-300">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-blue-600 font-anton">Evaluaci??n de diagn??stico</h3>
                            <p class="mb-6 text-justify">Al hacer click en el bot??n ingresar, te dirigir??s a la p??gina de tu evaluaci??n de diagn??stico asignada, donde deber??s responder algunas preguntas, 
                                para desbloquear las siguientes secciones de la aplicaci??n. ??Comencemos! </p>
                            <a href="{{route('estudiante.diagnostico')}}">
                                <!-- BOTON DE INGRESO -->
                                <button type="button" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                    Ingresar
                                </button>
                            </a>
                            
                        </div>
                    </div>
                    <!-- CARD DOS--> 
                    <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 m-10 transform  hover:scale-125 transition duration-300">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-rose-500 font-anton">Actividades de pr??ctica</pre></h3>
                            <p class="mb-6 text-justify">Al hacer click en el bot??n ingresar, tendr??s a tu disposici??n varias actividades de pr??ctica para mejorar tus conocimientos sobre ortograf??a. ??Vamos a por ello!</p>
                            <a href="{{route('estudiante.practica')}}">
                                <!-- BOTON DE INGRESO -->
                                <button type="button" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                    Ingresar
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- CARD TRES--> 
                    <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 m-10 transform  hover:scale-125 transition duration-300">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-purple-700 font-anton">Evaluaci??n final</h3>
                            <p class="mb-6 text-justify">Una vez que hayas culminado con la evaluaci??n de di??gnostico y las activades de pr??ctica, est??s listo para realizar la evaluaci??n final de la aplicaci??n web. ??Empecemos!</p>
                            <a href="{{route('estudiante.final')}}">
                                <!-- BOTON DE INGRESO -->
                                <button type="button" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                    Ingresar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- CONTENEDOR CON SECCION DE REGLAS ORTOGRAFICAS -->
        <div class="container mx-auto p-10">
            <h3 class="text-2xl sm:text-3xl md:text-4xl text-left font-anton text-slate-700 m-5">Secci??n de reglas ortogr??ficas:</h3>
            <p class="text-xl font-sora m-5">En esta secci??n tienes a tu disposici??n una gran cantidad de reglas ortogr??ficas divididas en tres categor??as: palabras, acentuaci??n y puntuaci??n. Puedes ingresar a la categor??a 
                de tu inter??s desde esta secci??n o desde el men?? de navegaci??n que se encuentra en la parte superior.
            </p>
            <!-- CONTENEDOR CON 3 CARD 1 PARA CADA TIPO DE REGLA ORTOGRAFICA-->
            <div class="container mx-auto py-16 bg-cyan-500 rounded-xl w-full">
                <div class="mx-auto grid gap-6 md:w-3/4 lg:w-full lg:grid-cols-3">
                    <!-- CARD UNO -->
                    <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 m-10 transform  hover:scale-125 transition duration-300">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-red-700 font-anton">Reglas ortogr??ficas de palabras</h3>
                            <p class="mb-6 font-sora text-justify">En esta categor??a podr??s encontrar las reglas ortogr??ficas destinadas a la correcta escritura de palabras.</p>
                            <a href="{{route('estudiante.letterslevelone')}}">
                                <!-- BOTON DE INGRESO -->
                                <button type="button" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                                    Acceder
                                </button>
                            </a>
                            
                        </div>
                    </div>
                    <!-- CARD DOS-->
                    <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 m-10 transform  hover:scale-125 transition duration-300">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-blue-700 font-anton">Reglas ortogr??ficas de acentuaci??n</h3>
                            <p class="mb-6 font-sora text-justify">En esta categor??a podr??s encontrar las reglas ortogr??ficas correspondientes al uso correcto de la tilde.</p>
                            <a href="{{route('estudiante.acentuationlevelone')}}">
                                <!-- BOTON DE INGRESO -->
                                <button type="button" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                                    Acceder
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- CARD TRES -->
                    <!-- CARD DOS-->
                    <div class="bg-white rounded-2xl shadow-xl px-8 py-12 sm:px-12 lg:px-8 m-10 transform  hover:scale-125 transition duration-300">
                        <div class="mb-12 space-y-4">
                            <h3 class="text-2xl font-semibold text-green-700 font-anton">Reglas ortogr??ficas de puntuaci??n</h3>
                            <p class="mb-6 font-sora text-justify">En esta categor??a podr??s encontrar las reglas ortogr??ficas que rigen el uso correcto de los signos de puntuaci??n en un texto.</p>
                            <a href="{{route('estudiante.punctuationlevelone')}}">
                                <!-- BOTON DE INGRESO -->
                                <button type="button" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                                    Acceder
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ////////////////////////////////////////////////////////////////////FIN NUEVO DASHBOARD///////////////////////////////////// -->
</x-app-layout>
