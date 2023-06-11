<?php

namespace App\Http\Controllers;

use App\Facades\TaskFacade;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = TaskFacade::getAllTasks();

        return response()->json($tasks);
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $taskData = $request->validated();
        $task = TaskFacade::createTask($taskData);

        return response()->json($task, Response::HTTP_CREATED);
    }

    public function show($id): JsonResponse
    {
        $task = TaskFacade::getTaskById($id);

        return response()->json($task);
    }

    public function update(TaskRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $task = TaskFacade::getTaskById($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        $updatedTask = TaskFacade::updateTask($id, $data);

        return response()->json($updatedTask);
    }

    public function destroy($id): JsonResponse
    {
        $task = TaskFacade::getTaskById($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        TaskFacade::deleteTask($id);

        return response()->json(['message' => 'Task deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
