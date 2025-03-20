<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class TaskController extends Controller
{
    /**
     * Listar todas las tareas.
     */
    public function index()
    {
        try {
            $tasks = Task::all();
            return response()->json($tasks, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al listar las tareas', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Crear una nueva tarea.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|in:pending,in_progress,completed',
            ]);

            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json($task, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear la tarea', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Mostrar el detalle de una tarea.
     */
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json($task, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tarea no encontrada'], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al mostrar la tarea', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Actualizar una tarea existente.
     */
    public function update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);

            $request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'status' => 'sometimes|in:pending,in_progress,completed',
            ]);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            return response()->json($task, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tarea no encontrada'], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al actualizar la tarea', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Eliminar una tarea.
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json(['message' => 'Tarea eliminada'], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tarea no encontrada'], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al eliminar la tarea', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
