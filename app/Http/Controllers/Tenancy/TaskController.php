<?php

namespace App\Http\Controllers\Tenancy;

use App\Http\Controllers\Controller;
use App\Models\Task;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tasks = Task::paginate();
        return view('tenancy.tasks.index',compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenancy.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Se validan las entradas
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image_url' => 'required|image',
        ]);


        // 1. se sube la imagen(el archico) al servidor, en la carpeta (tasks)
        // 2. y este regresa la url, donde esta hubicada esta imagen en el servidor
        $data['image_url'] = Storage::put('tasks', $request->file('image_url'));

        // y se gurada los datos en la tabla
        Task::create($data);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tenancy.tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tenancy.tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image_url' => 'nullable|image',
        ]);

        // Verificar si se ha mandado una imagen
        if ($request->hasFile('image_url')) {
            // Eliminar imagen anterior
            Storage::delete($task->image_url);
            // Subir nueva imagen
            $data['image_url'] = Storage::put('tasks', $request->file('image_url'));
        }

        $task->update($data);

        return redirect()->route('tasks.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Storage::delete($task->image_url);
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
