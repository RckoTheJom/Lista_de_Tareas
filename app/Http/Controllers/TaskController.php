<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //Listar las tareas 
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    //Crear Nuevas tareas
    public function store(Request $request)
    {
    //validacion
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'completed' => 'boolean',
    ]);

    $task = Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'completed' => $request->has('completed') ? true : false, 
    ]);

    //Responder con la tarea creada
    return redirect('/tasks'); 
    }


    //Actualizar una tarea 
    public function update(Request $request, $id)
    {
        //validacion
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed' => 'boolean',
        ]);
    
        // Buscar la tarea por id
        $task = Task::findOrFail($id);
    
        // Actualizar la tarea
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->has('completed') ? true : false, // Si el checkbox está marcado, será true
        ]);
    
        // Redirigir a la lista de tareas con un mensaje
        return redirect('/tasks')->with('success', 'Tarea actualizada correctamente');
    }
    //Eliminar Una Tarea 
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect('/tasks')->with('message', 'Tarea eliminada');
    }
    
}
