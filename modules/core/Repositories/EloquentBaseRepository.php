<?php

namespace Modules\core\Repositories;
abstract class EloquentBaseRepository
{
    protected string $model;
    public function destroy($id): void
    {
        $where = ['id' => $id];
        if (method_exists($this->model, 'findWhere')) {
            $where = array_merge($where, $this->model::findWhere());
        }

        try {
            $row = $this->model::where($where)->withTrashed()->firstOrFail();
        } catch (\Exception $exception) {
            $row = $this->model::where($where)->firstOrFail();
        }

        if ($row->deleted_at === null) {
            $row->delete();
        } else {
            $row->forceDelete();
        }
    }

    public function restore($id): void
    {
        $where = ['id' => $id];
        $row = $this->model::withTrashed()->where($where)->firstOrFail();
        $row->restore();
    }
}
