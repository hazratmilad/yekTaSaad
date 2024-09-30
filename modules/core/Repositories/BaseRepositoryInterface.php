<?php

namespace Modules\core\Repositories;

interface BaseRepositoryInterface
{
    public function restore($id);

    public function find($id);

    public function create(array $request);

    public function getList(array $request);

    public function update($id, array $request);

    public function destroy($id);
}
