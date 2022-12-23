<?php

namespace App\Http\Controllers\Admin\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Word;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Models\Section;
use App\Models\Category;

class RulePunctuationController extends Controller
{

    //CONTROLADOR PARA CONTROLAR EL ACCESO A LAS RUTAS INDEX,CREATE, EDIT, DESTROY DE UNA RUTA TIPO RESOURCE DE WEB.PHP
    public function __construct()
    {
        //SE INVOCA A UN PERMISO CREADO Y AL METODO QUE VA A PROTEGER ESE PERMISO
        $this->middleware('can:admin.rules.rulepunctuation.index')->only('index');
        $this->middleware('can:admin.rules.rulepunctuation.create')->only('create', 'store');
        $this->middleware('can:admin.rules.rulepunctuation.edit')->only('edit', 'update');
        $this->middleware('can:admin.rules.rulepunctuation.show')->only('show');
        $this->middleware('can:admin.rules.rulepunctuation.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //IMPORTAR LAS RULES CUYO CAMPO TYPE SEA PALABRAS
        //$rules = Rule::where('type', "Reglas ortográficas de puntuación")->get();

        //ACTUALIZACION CONSULTA CON PAGINACION
        $rules = Rule::orderBy('id', 'DESC')->where('type', "Reglas ortográficas de puntuación")->paginate(10);

        return view('admin.information.rules.rulepunctuation.index', compact('rules'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //SE ENVIAN LOS TERMINOS DEL GLOSARIO PARA QUE EL USUARIO PUEDA ESCOGER LOS TERMINOS ADECUADOS
        $words = Word::all();

        //SE CAPTURAN LAS REGLAS DE NIVEL 3 (POSTS) CUYO CAMPO TYPE SEA REGLAS DE PALABRAS
        $posts = Post::where('type', "Reglas ortográficas de puntuación")->get(); 

        return view('admin.information.rules.rulepunctuation.create', compact('words', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:rules',
            'body' => 'required',
            'post_id' => 'required'
        ]);

        //GUARDAR REGISTRO
        //CON EL IF SE PREGUNTA SI LA REGLA VIENE CON UNA IMAGEN O SI VIENE SIN IMAGEN
        if($request->file('image')){
            //SI EL POST VIENE CON UNA IMAGEN, SE CREA EL REGISTRO CON EL CAMPO IMAGEN
            
            $rulepunctuation = Rule::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => Storage::put('reglasnivelcuatrorules', $request->file('image')),
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'type' => "Reglas ortográficas de puntuación",
                'clasification' => "Reglas ortográficas de puntuación",
                'post_id' => $request->post_id
            ]);
        }else{
            
            //SI EL POST NO VIENE CON IMAGEN, SE CREA EL POST DE ESTA MANERA
            $rulepunctuation = Rule::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $request->image,
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'type' => "Reglas ortográficas de puntuación",
                'clasification' => "Reglas ortográficas de puntuación",
                'post_id' => $request->post_id
            ]);
        }

        //CON EL IF SE PREGUNTA SI EL REQUEST TIENE WORDS[]
        if($request->words){
            //SI ES ASI, SE ACCEDE A LA RELACION WORDS() DEL MODELO SECTION QUE ES LA RELACION MUCHOS A MUCHOS CON EL MODELO WORDS
            //Y CON EL METODO ATTACH() SE VA A GUARDAR EN LA TABLA INTERMEDIA SECTION_WORD, LAS WORDS QUE HAYA SELECCIONADO EL USUARIO
            //DENTRO DEL PARENTESIS DE ATTACH() SE PONE REQUEST->WORDS PORQUE AHI ESTAN LAS IDS DE LAS WORDS QUE ESCOGIO EL USUARIO
            $rulepunctuation->words()->attach($request->words);
        }

        return redirect()->route('admin.rules.rulepunctuation.index')->with('message', 'Regla creada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rulepunctuation)
    {
        //CAPTURAR LA RELACION RULEWORD CON POST QUE ES LA REGLA DE NIVEL 3 QUE LA CONTIENE
        $post = $rulepunctuation->post;
        //EN BASE AL CAMPO SECTION_ID DE LA VARIABLE POST, BUSCAR LA SECTION QUE CONTIENE A LAS REGLAS
        $section = Section::find($post->section_id);
        //EN BASE AL CAMPO CATEGORY_ID DE LA VARIABLE SECTION, BUSCAR LA CATEGORY QUE CONTIENE A LAS REGLAS
        $category = Category::find($section->category_id);

        return view('admin.information.rules.rulepunctuation.show', compact('rulepunctuation', 'category', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $rulepunctuation)
    {
        //ENVIAR EL NUMERO DE WORDS QUE TIENE EL USUARIO EN LA REGLA CREADA
        $numero = count($rulepunctuation->words);

        //SE ENVIA A LA VISTA DE EDITAR TODAS LAS WORDS
        $words = Word::all();

        //SE ENVIA A LA VISTA LOS TERMINOS SELECCIONADOS POR EL USUARIO, SOLO EL CAMPO WORD_ID
        //SE CREA UN ARRAY PARA ALMACENAR LOS IDS Y CON UN FOR SE RECORRE LA RELACION ENTRE WORDS Y POSTS
        //PARA CAPTURAR LOS TERMINOS QUE EL USUARIO HAYA SELECCIONADO EN LA VISTA CREAR Y ENVIARLOS A LA VISTA
        $selectedWords = [];
        for($i=0; $i< count($rulepunctuation->words); $i++){
            array_push($selectedWords, $rulepunctuation->words[$i]->id);
        }

        //SE ENVIAN LAS REGLAS DE NIVEL 3 (POSTS) DONDE SU CAMPO TYPE SE REGLAS ORTOGRAFICAS DE PALABRAS
        $posts = Post::where('type', "Reglas ortográficas de puntuación")->get();

        return view('admin.information.rules.rulepunctuation.edit', compact('rulepunctuation', 'words', 'selectedWords', 'numero', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rule $rulepunctuation)
    {
        //return $request;

        $request->validate([
            'name' => 'required|string',
            'slug' => "required|unique:rules,slug,$rulepunctuation->id",
            'body' => 'required',
            'post_id' => 'required'
        ]);

        //ACTUALIZAR REGLA NIVEL 4 (RULES)
        //CON EL IF SE PREGUNTA SI EN EL REQUEST SE ESTA ENVIANDO UNA IMAGEN O NO SE ESTA ENVIANDO NADA
        if($request->file('image')){
            //SI EL POST YA TENIA UNA IMAGEN, QUE SE ELIMINE LA IMAGEN ANTERIOR
            //SE PREGUNTA SI EL REGISTRO SECTIONWORD YA TENIA UNA IMAGEN O NO
            if(isset($rulepunctuation->image)){
                //SI EL REGISTRO SECTIONWORD YA TENIA UNA IMAGEN, QUE SE ELIMINE LA IMAGEN ANTERIOR
                Storage::delete($rulepunctuation->image);
            }
            //SE ACTUALIZA EL REGISTRO NUEVO DE SECTION WORD CON EL NUEVO CAMPO IMAGEN
            $rulepunctuation->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => Storage::put('reglasnivelcuatrorules', $request->file('image')),
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'type' => "Reglas ortográficas de puntuación",
                'clasification' => "Reglas ortográficas de puntuación",
                'post_id' => $request->post_id
            ]);
        }else{
            //SI NO SE ESTA ENVIANDO IMAGENES ENTONCES QUE SE ACTUALICEEN LOS DEMAS CAMPOS MENOS LA IMAGEN
            $rulepunctuation->update([
                'name' => $request->name,
                'slug' => $request->slug,
                //'image' => Storage::put('reglasnivelcuatrorules', $request->file('image')),
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'type' => "Reglas ortográficas de puntuación",
                'clasification' => "Reglas ortográficas de puntuación",
                'post_id' => $request->post_id
            ]);
        }

        //SE PONE EL METODO SYNC SIN EL IF PARA QUE SE PUEDA AGREGAR MAS WORDS O QUITAR TODAS LAS WORDS PORQUE CON EL IF
        //SI DESMARCABAMOS TODAS LAS WORDS, AL ENTRAR DE NUEVO LA RELACION NO SE QUITABA
        $rulepunctuation->words()->sync($request->words);

        return redirect()->route('admin.rules.rulepunctuation.index')->with('message', 'Regla actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rule $rulepunctuation)
    {
        //CON EL IF SE PREGUNTA SI EL REGISTRO TIENE UNA IMAGEN
        if(isset($rulepunctuation->image)){
            //SI ES ASI, ENTONCES SE ELIMINA LA IMAGEN Y LUEGO EL REGISTRO
            //SE ELIMINA LA IMAGEN ANTES DE ELIMINAR EL REGISTRO
            Storage::delete($rulepunctuation->image);
            $rulepunctuation->delete();
        }
        else{
            //SI NO ES ASI, ENTONCES SE ELIMINA EL REGISTRO
            $rulepunctuation->delete();
        }

        return redirect()->route('admin.rules.rulepunctuation.index')->with('message', 'Regla eliminada.');
    }
}
