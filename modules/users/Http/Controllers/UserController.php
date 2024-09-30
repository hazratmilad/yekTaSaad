<?php

namespace Modules\users\Http\Controllers;

use Modules\core\Http\Controllers\CrudController;
use Modules\users\Actions\CreateUser;
use Modules\users\Http\Requests\UserRequest;

class UserController extends CrudController
{
    public function store(UserRequest $request, CreateUser $createUser)
    {
        $token = $createUser($request);
        return $this->success($token);
    }
}
