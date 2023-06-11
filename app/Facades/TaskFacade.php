<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\TaskService;
use App\Exceptions\ApiException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

class TaskFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TaskService::class;
    }
    
    public static function getAllTasks()
    {
        return static::getFacadeRoot()->getAllTasks();
    }

    public static function createTask(array $data)
    {
        return static::getFacadeRoot()->createTask($data);
    }

    public static function getTaskById($id)
    {
        $task = static::getFacadeRoot()->getTaskById($id);
        
        if (!$task) {
            throw new NotFoundHttpException('Failed to find task', null, Response::HTTP_NOT_FOUND);
        }
        
        return $task;
    }

    public static function updateTask($id, array $data)
    {
        $task = static::getFacadeRoot()->getTaskById($id);
        
        if (!$task) {
            throw new NotFoundHttpException('Failed to find task', null, Response::HTTP_NOT_FOUND);
        }
        
        return static::getFacadeRoot()->updateTask($task, $data);
    }

    public static function deleteTask($id)
    {
        $task = static::getFacadeRoot()->getTaskById($id);
        
        if (!$task) {
            throw new NotFoundHttpException('Failed to find task', null, Response::HTTP_NOT_FOUND);
        }
        
        static::getFacadeRoot()->deleteTask($task);
        
        return true;
    }
}
