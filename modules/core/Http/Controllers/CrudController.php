<?php

namespace Modules\core\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\core\Repositories\BaseRepositoryInterface;

class CrudController extends Controller
{
    protected BaseRepositoryInterface $repository;

    public function destroy($id)
    {
        $this->repository->destroy($id);
        return $this->success();
    }

    public function restore($id)
    {
        $this->repository->restore($id);
        return $this->success();
    }
}
