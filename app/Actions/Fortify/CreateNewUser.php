<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\Evaluation;
//IMPORTAR MODELO ROLE
use Spatie\Permission\Models\Role;
//IMPORTAR MODELO PERMISSIONS
use Spatie\Permission\Models\Permission;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/(.+)@utn\.edu\.ec/'], 
            //'email.regex' => 'Debe ingresar el correo estudiantil con dominio: @utn.edu.ec',
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        //return User::create([
        //    'name' => $input['name'],
        //    'email' => $input['email'],
        //    'password' => Hash::make($input['password']),
        //]);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);


        //IMPORTANTE
        //BORRAR EL CODIGO DE ABAJO Y PEGAR EL CODIGO QUE ESTA EN EL BLOC DE NOTAS PARA QUE FUNCIONE LA ASIGNACION DE ROLES, PERMISOS Y EVALUACIONES

        /////////////////////CAPTURAR LOS EXAMENES
        $d1 = Evaluation::where('type', "D")->where('format', "1")->value('id');
        $pu1 = Evaluation::where('type', "PU")->where('format', "1")->value('id');
        $pd1 = Evaluation::where('type', "PD")->where('format', "1")->value('id');
        $pt1 = Evaluation::where('type', "PT")->where('format', "1")->value('id');
        $f1 = Evaluation::where('type', "F")->where('format', "1")->value('id');

        $d2 = Evaluation::where('type', "D")->where('format', "2")->value('id');
        $pu2 = Evaluation::where('type', "PU")->where('format', "2")->value('id');
        $pd2 = Evaluation::where('type', "PD")->where('format', "2")->value('id');
        $pt2 = Evaluation::where('type', "PT")->where('format', "2")->value('id');
        $f2 = Evaluation::where('type', "F")->where('format', "2")->value('id');

        $d3 = Evaluation::where('type', "D")->where('format', "3")->value('id');
        $pu3 = Evaluation::where('type', "PU")->where('format', "3")->value('id');
        $pd3 = Evaluation::where('type', "PD")->where('format', "3")->value('id');
        $pt3 = Evaluation::where('type', "PT")->where('format', "3")->value('id');
        $f3 = Evaluation::where('type', "F")->where('format', "3")->value('id');

        $d4 = Evaluation::where('type', "D")->where('format', "4")->value('id');
        $pu4 = Evaluation::where('type', "PU")->where('format', "4")->value('id');
        $pd4 = Evaluation::where('type', "PD")->where('format', "4")->value('id');
        $pt4 = Evaluation::where('type', "PT")->where('format', "4")->value('id');
        $f4 = Evaluation::where('type', "F")->where('format', "4")->value('id');

        if(($user->id ===1)){

            //CREAR LOS ROLES
            $roladmin = Role::create(['name' => 'Admin']);
            $rolestudiante = Role::create(['name' => 'Estudiante']);

            //CREAR LOS PERMISOS Y ASIGNARLOS AL USUARIO ADMIN

            //LA DESCRIPCION DE CADA LINEA COINCIDE CON LA RUTA DEL ARCHIVO WEB.PHP PARA DARME CUENTA A QUE PERMISO
            //ESTA RELACIONADO CON CADA RUTA

            //////////////////////////////////////////////////RUTAS ADMIN

            //RUTA PARA MOSTRAR LA VISTA INDICE DE PREGUNTAS PANEL ADMIN
            Permission::create(['name' => 'admin.exercise'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR VISTA INDICE DE REGLAS ORTOGRAFICAS PANEL ADMIN
            Permission::create(['name' => 'admin.rules'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE EVALUATION
            Permission::create(['name' => 'admin.evaluation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.evaluation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.evaluation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.evaluation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.evaluation.destroy'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR EL LISTADO DE PREGUNTAS QUE LE PERTENECEN A UN EXAMEN DESDE EL INDEX DE EVALUATIONS
            Permission::create(['name' => 'admin.evaluation.questions'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR VISTA INDICE DE RESULTADOS PANEL ADMIN
            Permission::create(['name' => 'admin.results'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR EL LISTADO DE EXAMENES ASIGNADOS A UN ESTUDIANTE ESPECIFICO MEDIANTE LA VISTA RESULTS
            Permission::create(['name' => 'admin.results.assignedevaluations'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR EL LISTADO DE RESPUESTAS DEL USUARIO A UNA EVALUACION ES ESPECIFICO MEDIANTE LA VISTA ASSIGNED EVALUATIONS
            Permission::create(['name' => 'admin.results.assignedquestions'])->syncRoles([$roladmin]);

            //RUTA PARA INGRESAR A LA SOLUCION DE UNA RESPUESTA DE UNA EVALUACION ESPECIFICA DE UN USUARIO ESPECIFICO DESDE EL PANEL ADMIN
            Permission::create(['name' => 'admin.results.viewresultquestions'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LAS NOTAS DE LOS USUARIOS EN LAS PRUEBAS DE DIAGNOSTICO
            Permission::create(['name' => 'admin.notes.diagnostic'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LAS NOTAS DE LOS USUARIOS EN LA PRUEBA DE PRACTICA UNO
            Permission::create(['name' => 'admin.notes.practiceone'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LAS NOTAS DE LOS USUARIOS EN LA PRUEBA DE PRACTICA DOS
            Permission::create(['name' => 'admin.notes.practicetwo'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LAS NOTAS DE LOS USUARIOS EN LA PRUEBA DE PRACTICA TRES
            Permission::create(['name' => 'admin.notes.practicethree'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LAS NOTAS DE LOS USUARIOS EN LA PRUEBA FINAL
            Permission::create(['name' => 'admin.notes.final'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR TODAS LAS NOTAS DE LOS USUARIOS EN UNA SOLA TABLA
            Permission::create(['name' => 'admin.notes.allresults'])->syncRoles([$roladmin]);


            //RUTA TIPO RESOURCE PARA EL CRUD DE OPCION MULTIPLE
            Permission::create(['name' => 'admin.question.opcionmultiple.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiple.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiple.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiple.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiple.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE PALABRACORRECCION
            Permission::create(['name' => 'admin.question.palabracorreccion.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.palabracorreccion.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.palabracorreccion.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.palabracorreccion.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.palabracorreccion.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE OPCIONMULTIPLE IMAGEN
            Permission::create(['name' => 'admin.question.opcionmultiplei.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplei.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplei.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplei.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplei.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE OPCIONMULTIPLE AUDIO
            Permission::create(['name' => 'admin.question.opcionmultiplea.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplea.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplea.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplea.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.opcionmultiplea.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE ORACIONAUDIO
            Permission::create(['name' => 'admin.question.oracionaudio.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionaudio.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionaudio.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionaudio.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionaudio.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE ORACIONIMAGEN
            Permission::create(['name' => 'admin.question.oracionimagen.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionimagen.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionimagen.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionimagen.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.oracionimagen.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE TEXTOIMAGEN
            Permission::create(['name' => 'admin.question.textoimagen.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoimagen.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoimagen.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoimagen.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoimagen.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE TEXTO AUDIO
            Permission::create(['name' => 'admin.question.textoaudio.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoaudio.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoaudio.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoaudio.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.textoaudio.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE QUESTION JUEGO
            Permission::create(['name' => 'admin.question.juego.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.juego.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.juego.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.juego.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.juego.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE QUESTION SOPALETRAS
            Permission::create(['name' => 'admin.question.sopaletras.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.sopaletras.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.sopaletras.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.sopaletras.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.question.sopaletras.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE REGLAS NIVEL 1 (CATEGORIES)
            Permission::create(['name' => 'admin.information.category.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.information.category.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.information.category.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.information.category.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.information.category.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA EL CRUD DE GLOSARIO DE TERMINOS
            Permission::create(['name' => 'admin.glossary.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.glossary.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.glossary.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.glossary.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.glossary.destroy'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LA VISTA DEL INDICE DE REGLAS ORTOGRAFICAS DE PALABRAS NIVEL 1 PANEL ADMIN
            Permission::create(['name' => 'admin.rules.categories'])->syncRoles([$roladmin]);

            //PARA LAS REGLAS NIVEL 1 (CATEGORIES) SE CREA 1 CONTROLADOR POR CADA TIPO DE REGLA: PALABRAS, ACENTUACION Y PUNTUACION

            //RUTA TIPO RESOURCE PARA CATEGORIES NIVEL 1 PALABRAS
            Permission::create(['name' => 'admin.categories.categoryword.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryword.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryword.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryword.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryword.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA CATEGORIES NIVEL 1 ACENTUACION
            Permission::create(['name' => 'admin.categories.categoryacentuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryacentuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryacentuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryacentuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categoryacentuation.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA CATEGORIES NIVEL 1 PUNTUACION
            Permission::create(['name' => 'admin.categories.categorypunctuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categorypunctuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categorypunctuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categorypunctuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.categories.categorypunctuation.destroy'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LA VISTA DEL INDICE DE REGLAS ORTOGRAFICAS DE PALABRAS NIVEL 2 PANEL ADMIN
            Permission::create(['name' => 'admin.rules.sections'])->syncRoles([$roladmin]);

            //PARA LAS REGLAS NIVEL 2 (SECTIONS) SE CREA 1 CONTROLADOR POR CADA TIPO DE REGLA: PALABRAS, ACENTUACION, PUNTUACION
            
            //RUTA TIPO RESOURCE PARA SECTIONS NIVEL 2 PALABRAS
            Permission::create(['name' => 'admin.sections.sectionword.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionword.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionword.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionword.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionword.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA SECTIONS NIVEL 2 ACENTUACION
            Permission::create(['name' => 'admin.sections.sectionacentuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionacentuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionacentuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionacentuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionacentuation.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA SECTIONS NIVEL 2 PUNTUACION
            Permission::create(['name' => 'admin.sections.sectionpunctuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionpunctuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionpunctuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionpunctuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.sections.sectionpunctuation.destroy'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTRAR LA VISTA DEL INDICE DE REGLAS ORTOGRAFICAS DE PALABRAS NIVEL 3 PANEL ADMIN
            Permission::create(['name' => 'admin.rules.posts'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA POSTS NIVEL 3 PALABRAS
            Permission::create(['name' => 'admin.posts.postword.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postword.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postword.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postword.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postword.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA POSTS NIVEL 3 ACENTUACION
            Permission::create(['name' => 'admin.posts.postacentuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postacentuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postacentuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postacentuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postacentuation.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA POSTS NIVEL 3 PUNTUACION
            Permission::create(['name' => 'admin.posts.postpunctuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postpunctuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postpunctuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postpunctuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.posts.postpunctuation.destroy'])->syncRoles([$roladmin]);

            //RUTA MOSTRAR LA VISTA DEL INDICE DE REGLAS ORTOGRAFICAS DE PALABRAS NIVEL 4 PANEL ADMIN
            Permission::create(['name' => 'admin.rules.rules'])->syncRoles([$roladmin]);

            //PARA LAS REGLAS DE NIVEL 4 (RULES) SE CREA 1 CONTROLADOR POR CADA TIPO DE REGLA: PALABRAS, ACENTUACION, PUNTUACION

            //RUTA TIPO RESOURCE PARA RULES NIVEL 4 PALABRAS
            Permission::create(['name' => 'admin.rules.ruleword.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleword.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleword.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleword.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleword.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA RULES NIVEL 4 ACENTUACION
            Permission::create(['name' => 'admin.rules.ruleacentuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleacentuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleacentuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleacentuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.ruleacentuation.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA RULES NIVEL 4 PUNTUACION
            Permission::create(['name' => 'admin.rules.rulepunctuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.rulepunctuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.rulepunctuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.rulepunctuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.rules.rulepunctuation.destroy'])->syncRoles([$roladmin]);

            //RUTA PARA MOSTAR LA VISTA DEL INDICE DE REGLAS ORTOGRAFICAS DE PALABRAS NIVEL 5 PANEL ADMIN
            Permission::create(['name' => 'admin.rules.notes'])->syncRoles([$roladmin]);

            //PARA LAS REGLAS DE NIVEL 5 (NOTES) SE CREA 1 CONTROLADOR POR CADA TIPO DE REGLA: PALABRAS, ACENTUACION, PUNTUACION

            //RUTA TIPO RESOURCE PARA RULES NIVEL 5 PALABRAS
            Permission::create(['name' => 'admin.notes.noteword.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteword.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteword.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteword.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteword.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA RULES NIVEL 5 ACENTUACION
            Permission::create(['name' => 'admin.notes.noteacentuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteacentuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteacentuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteacentuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.noteacentuation.destroy'])->syncRoles([$roladmin]);

            //RUTA TIPO RESOURCE PARA RULES NIVEL 5 PUNTUACION
            Permission::create(['name' => 'admin.notes.notepunctuation.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.notepunctuation.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.notepunctuation.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.notepunctuation.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.notes.notepunctuation.destroy'])->syncRoles([$roladmin]);


            //RUTA TIPO RESOURCE PARA CURD DE ASIGNAR ROLES A LOS USUARIOS Y PODER ELIMINAR USUARIOS
            Permission::create(['name' => 'admin.user.index'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.user.create'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.user.show'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.user.edit'])->syncRoles([$roladmin]);
            Permission::create(['name' => 'admin.user.destroy'])->syncRoles([$roladmin]);



            //ASIGNAR ROL ADMIN AL USUARIO CON ID 1
            $user->assignRole('Admin');

            return $user;

            //return $user;
        }
        elseif(($user->id ===2) || ($user->id ===4) || ($user->id ===6) || ($user->id ===8) || ($user->id ===10) || ($user->id ===12) || ($user->id ===14) || ($user->id ===16) || ($user->id ===18) || ($user->id ===20) ||
        
            ($user->id ===22) || ($user->id ===24) || ($user->id ===26) || ($user->id ===28)){

            $user->evaluations()->attach($d4);
            $user->evaluations()->attach($pu4);
            $user->evaluations()->attach($pd4);
            $user->evaluations()->attach($pt4);
            $user->evaluations()->attach($f4);

            //ASIGNAR ROL
            $user->assignRole('Estudiante');
            return $user;
        }
        elseif(($user->id ===3) || ($user->id ===5) || ($user->id ===7) || ($user->id ===9) || ($user->id ===11) || ($user->id ===13) || ($user->id ===15) || ($user->id ===17) || ($user->id ===19) || ($user->id ===21)
                || ($user->id ===23) || ($user->id ===25) || ($user->id ===27)){
            $user->evaluations()->attach($d4);
            $user->evaluations()->attach($pu4);
            $user->evaluations()->attach($pd4);
            $user->evaluations()->attach($pt4);
            $user->evaluations()->attach($f4);

            //ASIGNAR ROL
            $user->assignRole('Estudiante');
            return $user;
        }else{
            $user->evaluations()->attach($d4);
            $user->evaluations()->attach($pu4);
            $user->evaluations()->attach($pd4);
            $user->evaluations()->attach($pt4);
            $user->evaluations()->attach($f4);

            //ASIGNAR ROL
            $user->assignRole('Estudiante');
            return $user;
        }

        

    }
}
