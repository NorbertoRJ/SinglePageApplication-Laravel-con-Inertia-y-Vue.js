<?php

namespace App\Http\Controllers;

use Inertia\Inertia; //hace uso de las vistas en vue
use App\Models\Note; //tener comunicación con el modelo y tabla de Note
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //traeme todos los datos, sin embargo si existe q has la siguiente consulta
        return Inertia::render('Notes/Index', [
            'notes' => Note::latest()//quitamos ->get()
                ->where('excerpt', 'LIKE', "%$request->q%")//cuando el extracto tengo algo de q
                ->get()
        ]);
        //retornamos elemento Inertia (componente)
        //metodo render-> le decimos que queremos renderizar = Notes/Index
        //en Pages deberemos crear una carpeta llamada Notes
        //creamos consulta [] llamada notes
        //usa eloquent para conectyar con el modelo Note::
        //::latest() traer los ultimos elementos -get()
        //así en esa vista podremos usar dichos registros
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Notes/Create');//solo necesitamos la vista de creación o formulario
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //accion 1 validar
         $request->validate([
            'excerpt' => 'required',
            'content' => 'required',
        ]);
        //accion 2 actualizar
        //si cumple con la validación actualiza todos los datos que recibimos en el request
        $note = Note::create($request->all());
        //ya no dara error de información masiva porque ya lo hicimos con el update en nuestro modelo

        //accion 3 redirigir al index
       // return redirect()->route('notes.index');//para ir al index
        return redirect()->route('notes.edit', $note->id)
            ->with('status','Nota creada');; //para ir a formulario de editcion
        //llama de nuevo alc ontrolador pero ahora al de edit, por eso le pasamos el id para que pueda
        //buscar dicho elemento y pintarlo
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //retornamos la vista show, y el metodo en automatico realiza la busqueda del elemento $note
        //cuando lo encuentra lo envia a la vista en compact 
        return Inertia::render('Notes/Show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return Inertia::render('Notes/Edit',compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //espera todos los datos que estan en el request
        //y la nota
        //validamos los datos requeridos, que vengan en el form
        //accion 1 validar
        $request->validate([
            'excerpt' => 'required',
            'content' => 'required',
        ]);
        //accion 2 actualizar
        //si cumple con la validación actualiza todos los datos que recibimos en el request
        $note->update($request->all());

        //accion 3 redirigir al index
        return redirect()->route('notes.index')
            ->with('status','Nota actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')
        ->with('status','Nota eliminada');
    }
}
