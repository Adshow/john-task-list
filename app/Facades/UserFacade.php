<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\UserService;
use App\Exceptions\ApiException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserService::class;
    }

    public static function createUser($data)
    {
        return static::getFacadeRoot()->createUser($data);
    }

    public static function getUserById($id)
    {
        $user = static::getFacadeRoot()->getUserById($id);

        if (!$user) {
            throw new NotFoundHttpException('User not found', null, Response::HTTP_NOT_FOUND);
        }

        return $user;
    }

    public static function updateUser($id, $data)
    {
        $user = static::getFacadeRoot()->getUserById($id);

        if (!$user) {
            throw new NotFoundHttpException('User not found', null, Response::HTTP_NOT_FOUND);
        }

        return static::getFacadeRoot()->updateUser($user, $data);
    }

    public static function deleteUser($id)
    {
        $user = static::getFacadeRoot()->getUserById($id);

        if (!$user) {
            throw new NotFoundHttpException('User not found', null, Response::HTTP_NOT_FOUND);
        }

        return static::getFacadeRoot()->deleteUser($user);
    }
}
