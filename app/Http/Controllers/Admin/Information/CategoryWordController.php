<?php

namespace App\Http\Controllers\Admin\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Word;

class CategoryWordController extends Controller
{

    //CONTROLADOR PARA CONTROLAR EL ACCESO A LAS RUTAS INDEX,CREATE, EDIT, DESTROY DE UNA RUTA TIPO RESOURCE DE WEB.PHP
    public function __construct()
    {
        //SE INVOCA A UN PERMISO CREADO Y AL METODO QUE VA A PROTEGER ESE PERMISO
        $this->middleware('can:admin.categories.categoryword.index')->only('index');
        $this->middleware('can:admin.categories.categoryword.create')->only('create', 'store');
        $this->middleware('can:admin.categories.categoryword.edit')->only('edit', 'update');
        $this->middleware('can:admin.categories.categoryword.show')->only('show');
        $this->middleware('can:admin.categories.categoryword.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //IMPORTAR LAS CATEGORIES CUYO CAMPO TYPE SEA PALABRAS
        //$categories = Category::where('type', "Reglas ortográficas de palabras")->get();

        //ACTUALIZACION CONSULTA CON PAGINACION
        $categories = Category::orderBy('id', 'DESC')->where('type', "Reglas ortográficas de palabras")->paginate(10);

        return view('admin.information.categories.categoryword.index', compact('categories'));
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

        return view('admin.information.categories.categoryword.create', compact('words'));
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
            'slug' => 'required|string|unique:categories',
            'body' => 'required'
        ]);

        //GUARDAR REGISTRO
        //CON EL IF SE PREGUNTA SI LA REGLA VIENE CON UNA IMAGEN O SI VIENE SIN IMAGEN
        if($request->file('image')){
            //SI EL POST VIENE CON UNA IMAGEN, SE CREA EL REGISTRO CON EL CAMPO IMAGEN
            $categoryword = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => Storage::put('reglasnivelunocategories', $request->file('image')),
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'type' => "Reglas ortográficas de palabras",
                'clasification' => "Reglas ortográficas de palabras",
                'user_id' => auth()->user()->id
            ]);
        }else{
            //SI EL POST NO VIENE CON IMAGEN, SE CREA EL POST DE ESTA MANERA
            $categoryword = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $request->image,
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'type' => "Reglas ortográficas de palabras",
                'clasification' => "Reglas ortográficas de palabras",
                'user_id' => auth()->user()->id
            ]);
        }  
        

        //CON EL IF SE PREGUNTA SI EL REQUEST TIENE WORDS[]
        if($request->words){
            //SI ES ASI, SE ACCEDE A LA RELACION WORDS() DEL MODELO CATEGORY QUE ES LA RELACION MUCHOS A MUCHOS CON EL MODELO WORDS
            //Y CON EL METODO ATTACH() SE VA A GUARDAR EN LA TABLA INTERMEDIA CATEGORY_WORD, LAS WORDS QUE HAYA SELECCIONADO EL USUARIO
            //DENTRO DEL PARENTESIS DE ATTACH() SE PONE REQUEST->WORDS PORQUE AHI ESTAN LAS IDS DE LAS WORDS QUE ESCOGIO EL USUARIO
            $categoryword->words()->attach($request->words);
        }


        return redirect()->route('admin.categories.categoryword.index')->with('message', 'Regla creada correctamente.');
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categoryword)
    {
        //return $categoryword;
        return view('admin.information.categories.categoryword.show', compact('categoryword')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categoryword)
    {
        //ENVIAR EL NUMERO DE WORDS QUE TIENE EL USUARIO EN LA REGLA CREADA
        $numero =  count($categoryword->words);
        //SE ENVIAR LA VISTA DE EDITAR TODAS LAS WORDS
        $words = Word::all();
        //SE ENVIA A LA VISTA LOS TERMINOS SELECCIONADOS POR EL USUARIO, SOLO EL CAMPO WORD_ID
        //SE CREA UN ARRAY PARA ALMACENAR LOS IDS Y CON UN FOR SE RECORRE LA RELACION ENTRE WORDS Y CATEGORIES
        //PARA CAPTURAR LOS TERMINOS QUE EL USUARIO HAYA SELECCIONADO EN LA VISTA CREAR Y ENVIARLOS A LA VISTA
        $selectedWords = [];
        for($i=0; $i< count($categoryword->words); $i++){
            array_push($selectedWords, $categoryword->words[$i]->id);
        }
        //return $selectedWords;

        return view('admin.information.categories.categoryword.edit', compact('categoryword', 'words', 'numero', 'selectedWords'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $categoryword)
    {
        //return $categoryword->words;
        
        $request->validate([
            'name' => 'string|required',
            'slug' => "required|unique:categories,slug,$categoryword->id",
            'body' => 'required'
        ]);

        //ACTUALIZAR REGLA NIVEL 1 (CATEGORY)
        //CON EL IF SE PREGUNTA SI EN EL REQUEST SE ESTA ENVIANDO UNA IMAGEN O NO SE ESTA ENVIANDO NADA
        if($request->file('image')){
            //SI EL POST YA TENIA UNA IMAGEN, QUE SE ELIMINE LA IMAGEN ANTERIOR
            //Storage::delete($categoryword->image);
            //SE PREGUNTA SI EL REGISTRO CATEGORYWORD YA TENIA UNA IMAGEN O NO
            if(isset($categoryword->image)){
                //SI EL REGISTRO CATEGORYWORD TENIA UNA IMAGEN ENTONCES SE ELIMINA LA IMAGEN
                Storage::delete($categoryword->image);
            }
            //SE ACTUALIZA EL REGISTRO NUEVO DE CATEGORYWORD CON EL NUEVO CAMPO IMAGEN
            $categoryword->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => Storage::put('reglasnivelunocategories', $request->file('image')),
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'user_id' => auth()->user()->id,
                'type' => "Reglas ortográficas de palabras",
                'clasification' => "Reglas ortográficas de palabras"
            ]);
        }else{
            //SI NO SE ESTA ENVIANDO IMAGENES ENTONCES QUE SE ACTUALICEN LOS DEMAS CAMPOS MENOS LA IMAGEN
            $categoryword->update([
                'name' => $request->name,
                'slug' => $request->slug,
                //'image' => Storage::put('reglasnivelunocategories', $request->file('image')),
                'description' => $request->description,
                'body' => $request->body,
                'example' => $request->example,
                'exception' => $request->exception,
                'user_id' => auth()->user()->id,
                'type' => "Reglas ortográficas de palabras",
                'clasification' => "Reglas ortográficas de palabras"
            ]);
        }

        //ACTUALIZAR LAS WORDS POR LAS NUEVAS QUE HA SELECCIONADO EL USUARIO
        //CON EL IF SE PREGUNTA SI EN EL REQUEST VIENE CON EL ARRAY WORDS[] ES DECIR SI EL USUARIO HA SELECCIONADO WORDS
        //SI ES ASI ENTONCES SE ACTUALIZAN LOS WORDS
        //if($request->words){
            //SE PONE EL METODO SYNC SIN EL EDIT PARA QUE SE PUEDA AGREGAR MAS WORDS O QUITAR TODAS LAS WORDS PORQUE CON EL IF
            //SI DESMARCABAMOS TODAS LAS WORDS AL ENTRAR DE NUEVO LA RELACION NO SE QUITABA
            $categoryword->words()->sync($request->words);
        //}
        
        return redirect()->route('admin.categories.categoryword.index')->with('message', 'Regla actualizada correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categoryword)
    {
        //CON EL IF SE PREGUNTA SI EL REGISTRO TIENE UNA IMAGEN
        if(isset($categoryword->image)){
            //SI ES ASI, ENTONCES SE ELIMINA LA IMAGEN Y LUEGO EL REGISTRO
            //SE ELIMINA LA IMAGEN ANTES DE ELIMINAR EL REGISTRO
            Storage::delete($categoryword->image);

            $categoryword->delete();
        }
        else{
            //SI NO ES ASI, ENTONCES SE ELIMINA EL REGISTRO
            $categoryword->delete();
        }

        

        return redirect()->route('admin.categories.categoryword.index')->with('message', 'Regla eliminada.');
    }
}
