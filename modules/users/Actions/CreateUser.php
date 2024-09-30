<?php

namespace Modules\users\Actions;

use Illuminate\Http\Request;
use Modules\users\Repository\UserRepositoryInterface;

class CreateUser
{
    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        return $this->repository->create($request->all());
    }
}
