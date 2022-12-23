<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Indication;
use App\Models\Answer;
use App\Models\Justification;
use App\Models\Evaluation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Section;
use App\Models\Post;
use App\Models\Rule;
use App\Models\Note;
use App\Models\Result;

class OracionImagenController extends Controller
{

    //CONTROLADOR PARA CONTROLAR EL ACCESO A LAS RUTAS INDEX,CREATE, EDIT, DESTROY DE UNA RUTA TIPO RESOURCE DE WEB.PHP
    public function __construct()
    {
        //SE INVOCA A UN PERMISO CREADO Y AL METODO QUE VA A PROTEGER ESE PERMISO
        $this->middleware('can:admin.question.oracionimagen.index')->only('index');
        $this->middleware('can:admin.question.oracionimagen.create')->only('create', 'store');
        $this->middleware('can:admin.question.oracionimagen.edit')->only('edit', 'update');
        $this->middleware('can:admin.question.oracionimagen.show')->only('show');
        $this->middleware('can:admin.question.oracionimagen.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $order = 'DESC';
    private $limit = 10;

    public function index()
    {
        //$questions = Question::orderBy('id', $this->order)->where('type', "OI")->with('evaluation')->paginate($this->limit);

        //ACTUALIZACION CONSULTA CON PAGINACION
        $questions = Question::orderBy('id', 'DESC')->where('type', "OI")->with('evaluation')->paginate(10);

        return view('admin.question.oracionimagen.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $evaluations = Evaluation::all();


        //CAPTURAR LAS REGLAS ORTOGRAFICAS DE PALABRAS SEGUN EL NIVEL
        $palabrasniveluno = Category::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasniveldos = Section::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasniveltres = Post::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasnivelcuatro = Rule::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasnivelcinco = Note::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();

        //CAPTURAR LAS REGLAS ORTOGRAFICAS DE ACENTUACION SEGUN EL NIVEL
        $acentuacionniveluno = Category::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionniveldos = Section::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionniveltres = Post::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionnivelcuatro = Rule::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionnivelcinco = Note::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();

        //CAPTURAR LAS REGLAS ORTOGRAFICAS DE PUNTUACION SEGUN EL NIVEL
        $puntuacionniveluno = Category::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionniveldos = Section::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionniveltres = Post::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionnivelcuatro = Rule::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionnivelcinco = Note::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();

        return view('admin.question.oracionimagen.create', compact('evaluations', 'palabrasniveluno', 'palabrasniveldos', 'palabrasniveltres', 'palabrasnivelcuatro', 'palabrasnivelcinco'
        , 'acentuacionniveluno', 'acentuacionniveldos', 'acentuacionniveltres', 'acentuacionnivelcuatro', 'acentuacionnivelcinco'
        , 'puntuacionniveluno', 'puntuacionniveldos', 'puntuacionniveltres', 'puntuacionnivelcuatro', 'puntuacionnivelcinco'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            //'title.required' => 'Por favor ingrese el enunciado de pregunta.',
            'slug' => 'required|string|unique:questions',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            //REVISAR SOBRE EL FORMATO MPGA QUE REESCRIBE EL .MP3 COMO .MPGA PUEDE DAR ERRORES AL SUBIR LA APLICACION 
            //'audio' => 'required|mimes:mp3,mpga,wav',
            'evaluation_id' => 'required',
            'opciones' => 'required|array',
            'opciones.*' => 'required|string|distinct',
            //'correct_answer' => 'required',
            //'correct_answer.required' => 'Por favor, marque una respuesta como correcta.'
            
        ]);

        //GUARDAR QUESTION
        $oracionimagen = Question::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => Storage::put('imagenesoi', $request->file('image')),
            //'audio' => Storage::put('audiosoa', $request->file('audio')),
            //'image' => $request->file('image')->store('imagenesfinalesapp'),
            'evaluation_id' => $request->evaluation_id,
            'type' => "OI",
            //ACTUALIZACION, GUARDAR LA COLUMNA RULE
            'rule' => $request->rule,
            
        ]);

        //GUARDAR ANSWERS
        foreach($request['opciones'] as $key=>$opcion){
            Answer::create([
                'question_id' => $oracionimagen->id,
                //CON TRIM SE QUITAN LOS ESPACIOS EN BLANCO DEL INICIO Y FINAL DE LA RESPUESTA
                'answer' => trim($opcion),
                'is_correct' => true
            ]);
        }

        //GUARDAR INDICATIONS
        $elementosindications = count(array_filter($request->indicaciones));
        $arrayindicaciones = array_filter($request->indicaciones);
        for($i=0; $i<$elementosindications; $i++){
            Indication::create([
                'question_id' => $oracionimagen->id,
                'indication' => $arrayindicaciones[$i]
            ]);
        }


        $elementos = count(array_filter($request->justificaciones));
         $arrayjustificaciones = array_filter($request->justificaciones);
         $arrayreglas = array_filter($request->reglas);
         //IDCORRECTA CONTIENE EL ID DE LA RESPUESTA CORRECTA A LA QUE SE ASOCIARAN LAS JUSTIFICACIONES
         //YA QUE ES PREGUNTA DE OPCION MULTIPLE TIENE RESPUESTAS CON IS_CORRECT TRUE Y FALSE
         //Y HAY QUE RELACIONAR LAS JUSTIFICACIONES CON LA RESPUESTA TRUE DE LA PREGUNTA ACTUAL
         //$idcorrecta = Answer::where('question_id', $opcionmultiple->id)->where('is_correct', true)->value('id');
 
         for($j=0; $j<$elementos; $j++){
             Justification::create([
                 'question_id' => $oracionimagen->id,
                 'reason' => $arrayjustificaciones[$j],
                 'rule' => $arrayreglas[$j]
             ]);
         }


         /////////////////////////RELACION MUCHOS A MUCHOS DE PALABRAS

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY CATEGORYWORDS
        if($request->categorywords){
            //SI ES ASI CON EL METODO ATTACH SE GUARDAN LOS REGISTROS EN LA TABLA INTERMEDIA
            $oracionimagen->categories()->attach($request->categorywords);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY SECTIONWORDS
        if($request->sectionwords){
            $oracionimagen->sections()->attach($request->sectionwords);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY POSTWORDS
        if($request->postwords){
            $oracionimagen->posts()->attach($request->postwords);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY RULEWORDS
        if($request->rulewords){
            $oracionimagen->rules()->attach($request->rulewords);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY NOTEWORDS
        if($request->notewords){
            $oracionimagen->notes()->attach($request->notewords);
        }


        /////////////////////////RELACION MUCHOS A MUCHOS DE ACENTUACION

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY CATEGORYWORDS
        if($request->categoryacentuations){
            //SI ES ASI CON EL METODO ATTACH SE GUARDAN LOS REGISTROS EN LA TABLA INTERMEDIA
            $oracionimagen->categories()->attach($request->categoryacentuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY SECTIONWORDS
        if($request->sectionacentuations){
            $oracionimagen->sections()->attach($request->sectionacentuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY POSTWORDS
        if($request->postacentuations){
            $oracionimagen->posts()->attach($request->postacentuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY RULEWORDS
        if($request->ruleacentuations){
            $oracionimagen->rules()->attach($request->ruleacentuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY NOTEWORDS
        if($request->noteacentuations){
            $oracionimagen->notes()->attach($request->noteacentuations);
        }


        /////////////////////////RELACION MUCHOS A MUCHOS DE PUNTUACION

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY CATEGORYWORDS
        if($request->categorypunctuations){
            //SI ES ASI CON EL METODO ATTACH SE GUARDAN LOS REGISTROS EN LA TABLA INTERMEDIA
            $oracionimagen->categories()->attach($request->categorypunctuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY SECTIONWORDS
        if($request->sectionpunctuations){
            $oracionimagen->sections()->attach($request->sectionpunctuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY POSTWORDS
        if($request->postpunctuations){
            $oracionimagen->posts()->attach($request->postpunctuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY RULEWORDS
        if($request->rulepunctuations){
            $oracionimagen->rules()->attach($request->rulepunctuations);
        }

        //CON EL IF SE PREGUNTA SI EN EL REQUEST TIENE EL ARRAY NOTEWORDS
        if($request->notepunctuations){
            $oracionimagen->notes()->attach($request->notepunctuations);
        }


         return redirect()->route('admin.question.oracionimagen.index')->with('message', 'Pregunta creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $oracionimagen)
    {
        return view('admin.question.oracionimagen.show', compact('oracionimagen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $oracionimagen)
    {
        $evaluations = Evaluation::all();

        //ENVIAR A LA VISTA LAS REGLAS ORTOGRAFICAS SELECCIONADAS POR EL USUARIO SOLO EL CAMPO ID

        //SE CREA UN ARRAY PARA GUARDAR LOS IDS Y CON UN FOR SE RECORREN LAS RELACIONES
        //PARA CAPTURAR LOS TERMINOS QUE EL USUARIO HAYA SELECCIONADO EN LA VISTA CREAR Y ENVIARLOS A LA VISTA

        //CAPTURAR REGLAS NIVEL 1
        $reglasniveluno = [];
        for($i=0; $i< count($oracionimagen->categories); $i++){
            array_push($reglasniveluno, $oracionimagen->categories[$i]->id);
        }

        //CAPTURAR REGLAS NIVEL 2
        $reglasniveldos = [];
        for($j=0; $j<count($oracionimagen->sections); $j++){
            array_push($reglasniveldos, $oracionimagen->sections[$j]->id);
        }

        //CAPTURAR REGLAS NIVEL 3
        $reglasniveltres = [];
        for($k=0; $k<count($oracionimagen->posts); $k++){
            array_push($reglasniveltres, $oracionimagen->posts[$k]->id);
        }

        //CAPTURAR REGLAS NIVEL 4
        $reglasnivelcuatro = [];
        for($n=0; $n<count($oracionimagen->rules); $n++){
            array_push($reglasnivelcuatro, $oracionimagen->rules[$n]->id);
        }


        //CAPTURAR REGLAS NIVEL 5
        $reglasnivelcinco = [];
        for($l=0; $l<count($oracionimagen->notes); $l++){
            array_push($reglasnivelcinco, $oracionimagen->notes[$l]->id);
        }

        //SE ENVIAN A LA VISTA LOS IDS Y NAMES DE TODAS LAS REGLAS ORTOGRAFICAS SEGUN SEA DE PALABRAS, PUNTUACION O ACENTUACION
        //REGLAS DE PALABRAS
        //CAPTURAR LAS REGLAS ORTOGRAFICAS DE PALABRAS SEGUN EL NIVEL
        $palabrasniveluno = Category::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasniveldos = Section::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasniveltres = Post::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasnivelcuatro = Rule::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();
        $palabrasnivelcinco = Note::where('type', "Reglas ortográficas de palabras")->select('id', 'name', 'slug')->get();

        //CAPTURAR LAS REGLAS ORTOGRAFICAS DE ACENTUACION SEGUN EL NIVEL
        $acentuacionniveluno = Category::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionniveldos = Section::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionniveltres = Post::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionnivelcuatro = Rule::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();
        $acentuacionnivelcinco = Note::where('type', "Reglas ortográficas de acentuación")->select('id', 'name', 'slug')->get();

        //CAPTURAR LAS REGLAS ORTOGRAFICAS DE PUNTUACION SEGUN EL NIVEL
        $puntuacionniveluno = Category::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionniveldos = Section::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionniveltres = Post::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionnivelcuatro = Rule::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();
        $puntuacionnivelcinco = Note::where('type', "Reglas ortográficas de puntuación")->select('id', 'name', 'slug')->get();

        return view('admin.question.oracionimagen.edit', compact('oracionimagen', 'evaluations'
                    , 'reglasniveluno', 'reglasniveldos', 'reglasniveltres', 'reglasnivelcuatro', 'reglasnivelcinco'
                    , 'palabrasniveluno', 'palabrasniveldos', 'palabrasniveltres', 'palabrasnivelcuatro', 'palabrasnivelcinco'
                    , 'acentuacionniveluno', 'acentuacionniveldos', 'acentuacionniveltres', 'acentuacionnivelcuatro', 'acentuacionnivelcinco'
                    , 'puntuacionniveluno', 'puntuacionniveldos', 'puntuacionniveltres', 'puntuacionnivelcuatro', 'puntuacionnivelcinco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $oracionimagen)
    {
        
        $request->validate([
            'title' => 'string|required',
            'slug' => "required|unique:questions,slug,$oracionimagen->id",
            'evaluation_id' => 'required',
            'opciones' => 'required|array',
            'opciones.*' => 'required|string|distinct',
            ////'correct_answer' => 'required',
            'indicaciones' => 'required|array',
            'indicaciones.*' => 'required|string|distinct',
            'justificaciones' => 'required|array',
            'justificaciones.*' => 'required|string|distinct',
            'reglas' => 'required|array',
            //SE QUITA ESTA REGLA PORQUE SINO NO DEJA GUARDAR AL ESTAR PONIENDO EN LA TABLA DE REGLAS, REGLAS IGUALES
            //'reglas.*' => 'required|string|distinct',
            
        ]);

        

    
        //ACTUALIZAR QUESTION
        //CON EL IF SE PREGUNTA SI EN EL REQUEST VIENE UNA IMAGEN O NO VIENE UNA IMAGEN
        if($request->file('image')){
            //SI EL POST YA TENIA UNA IMAGEN, QUE SE ELIMINE LA IMAGEN ANTERIOR
            Storage::delete($oracionimagen->image);
            //SE ACTUALIZA EL REGISTRO NUEVO DE OPCIONMULTIPLEI CON EL NUEVO CAMPO DE IMAGEN Y AUDIO
            $oracionimagen->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'image' => Storage::put('imagenesoi', $request->file('image')),
                'evaluation_id' => $request->evaluation_id,
                'type' => "OI",
                //ACTUALIZACION SE ACTUALIZA EL NUEVO CAMPO RULE
                //'rule' => $request->rule,
            ]);
        }
        else{
            //SI NO SE ESTA ENVIANDO IMAGENES, ENTONCES QUE SE ACTUALICEN SOLO LOS DEMAS CAMPOS
            $oracionimagen->update([
                'title' => $request->title,
                'slug' => $request->slug,
                //'image' => Storage::put('imagenesoma', $request->file('image')),
                //'audio' => Storage::put('audiosoma', $request->file('audio')),
                'evaluation_id' => $request->evaluation_id,
                'type' => "OI",
                //ACTUALIZACION SE ACTUALIZA EL NUEVO CAMPO RULE
                //'rule' => $request->rule,
            ]);
        }


        //ACTUALIZAR ANSWERS
        Answer::where('question_id', $oracionimagen->id)->delete();
        foreach($request['opciones'] as $key=>$opcion){
            Answer::create([
                'question_id' => $oracionimagen->id,
                //CON TRIM SE QUITAN LOS ESPACIOS EN BLANCO DEL INICIO Y FINAL DE LA RESPUESTA
                'answer' => trim($opcion),
                'is_correct' => true
            ]);
        }

        //ACTUALIZAR INDICATIONS
        Indication::where('question_id', $oracionimagen->id)->delete();
        $elementosindications = count($request->indicaciones);
        $arrayindicaciones = $request->indicaciones;
        for($i=0; $i<$elementosindications; $i++){
            Indication::create([
                'question_id' => $oracionimagen->id,
                'indication' => $arrayindicaciones[$i]
            ]);
        }


        //ACTUALIZAR JUSTIFICACIONES
        
        $elementos = count($request->justificaciones);
        $arrayjustificaciones = $request->justificaciones;
        $arrayreglas = $request->reglas;
        //ID CORRECTA CONTIENE EL ID DE LA RESPUESTA CORRECTA A LA QUE SE ASOCIARAN LAS JUSTIFICACIONES
        //YA QUE ES PREGUNTA OPCION MULTIPLE TIENE RESPUESTAS CON IS_CORRECT FALSE
        //Y HAY QUE RELACIONAR LAS JUSTIFICACIONES CON LA RESPUESTA TRUE DE LA PREGUNTA ACTUAL

        Justification::where('question_id', $oracionimagen->id)->delete();
        for($j=0; $j<$elementos; $j++){
            Justification::create([
                'question_id' => $oracionimagen->id,
                'reason' => $arrayjustificaciones[$j],
                'rule' => $arrayreglas[$j]
            ]);
        }


        //IMPORTANTE
        //EN LA ACTUALIZACION DE REGLAS ORTOGRAFICAS SIEMPRE SE PONE SYNC EN LAS DE  PALABRAS
        //PARA QUE LIMPIE LAS TABLAS INTERMEDIAS Y SI HAY REGLAS DE PALABRAS LAS ALMACENE
        //Y EN LAS REGLAS DE ACENTUACION Y PUNTUACION SE PONE CON ATTACH PARA QUE SE AGREGUEN 
        //EN LAS TABLAS LAS REGLAS DE ESAS CATEGORIAS PORQUE SI SE PONE SYNC SE VAN BORRANDO 
        //LAS REGLAS QUE HAYA PUESTO ANTES 
            
        ///////////////////////////////ACTUALIZAR RELACION MUCHOS A MUCHOS DE PALABRAS

        //ACTUALIZAR RELACION CON PALABRAS NIVEL 1 CATEGORIES
        $oracionimagen->categories()->sync($request->categorywords);
        //ACTUALIZAR RELACION CON PALABRAS NIVEL 2 SECTIONS
        $oracionimagen->sections()->sync($request->sectionwords);
        //ACTUALIZAR RELACION CON PALABRAS NIVEL 3 POSTS
        $oracionimagen->posts()->sync($request->postwords);
        //ACTUALIZAR RELACION CON PALABRAS NIVEL 4 RULES
        $oracionimagen->rules()->sync($request->rulewords);
        //ACTUALIZAR RELACION CON PALABRAS NIVEL 5 NOTES
        $oracionimagen->notes()->sync($request->notewords);

        ///////////////////////////////////ACTUALIZAR RELACION MUCHOS A MUCHOS DE ACENTUACION

        //ACTUALIZAR RELACION CON ACENTUACION NIVEL 1 CATEGORIES
        $oracionimagen->categories()->attach($request->categoryacentuations);
        //ACTUALIZAR RELACION CON ACENTUACION NIVEL 2 SECTIONS
        $oracionimagen->sections()->attach($request->sectionacentuations);
        //ACTUALIZAR RELACION CON ACENTUACION NIVEL 3 POSTS
        $oracionimagen->posts()->attach($request->postacentuations);
        //ACTUALIZAR RELACION CON ACENTUACION NIVEL 4 RULES
        $oracionimagen->rules()->attach($request->ruleacentuations);
        //ACTUALIZAR RELACION CON ACENTUACION NIVEL 5 NOTES
        $oracionimagen->notes()->attach($request->noteacentuations);


        ///////////////////////////////////ACTUALIZAR RELACION MUCHOS A MUCHOS DE PUNTUACION

        //ACTUALIZAR RELACION CON PUNTUACION NIVEL 1 CATEGORIES
        $oracionimagen->categories()->attach($request->categorypunctuations);
        //ACTUALIZAR RELACION CON PUNTUACION NIVEL 2 SECTIONS
        $oracionimagen->sections()->attach($request->sectionpunctuations);
        //ACTUALIZAR RELACION CON PUNTUACION NIVEL 3 POSTS
        $oracionimagen->posts()->attach($request->postpunctuations);
        //ACTUALIZAR RELACION CON PUNTUACION NIVEL 4 RULES
        $oracionimagen->rules()->attach($request->rulepunctuations);
        //ACTUALIZAR RELACION CON PUNTUACION NIVEL 5 NOTES
        $oracionimagen->notes()->attach($request->notepunctuations);


        return redirect()->route('admin.question.oracionimagen.index')->with('message', 'Pregunta actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $oracionimagen)
    {
        //ELIMINAR LA IMAGEN ANTES DE ELIMINAR EL REGISTRO
        //Storage::delete($oracionimagen->image);

        //$oracionimagen->delete();

        //return redirect()->route('admin.question.oracionimagen.index')->with('message', 'Pregunta eliminada con éxito.');


        //ACTUALIZACION
        //CONTROLAR QUE SI UN EXAMEN YA HA SIDO RESPONDIDO, ENTONCES QUE NO SE PUEDA BORRAR EL EXAMEN

        //EN LA VARIABLE WASQUESTIONRESPONSE SE CONSULTA SI EXISTEN REGISTROS EN LA TABLA RESULTS CON EL QUESTION ID 
        //DE LA PREGUNTA ACTUAL
        $wasQuestionResponse = Result::where('question_id', $oracionimagen->id)->exists();

        //SI WASQUESTIONRESPONSE ES TRUE, SIGNIFICA QUE ALGUIEN YA RESPONDIO LA PREGUNTA, ENTONCES NO SE PUEDE ELIMINAR
        //PERO SI ES FALSE ENTONCES SE ELIMINA EL REGISTRO
        if($wasQuestionResponse === true){
            return redirect()->route('admin.question.oracionimagen.index')->with('message', 'La pregunta ha sido respondida, no se puede eliminar');
        }
        else{
            //ELIMINAR LA IMAGEN ANTES DE ELIMINAR EL REGISTRO
            Storage::delete($oracionimagen->image);

            $oracionimagen->delete();

            return redirect()->route('admin.question.oracionimagen.index')->with('message', 'Pregunta eliminada con éxito.');
        }
    }
}
