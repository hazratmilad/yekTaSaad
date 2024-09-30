<?php

namespace Modules\core\Utils;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class PaginationHelper
{
    /**
     * @throws BindingResolutionException
     */
    public static function paginate(Collection $results, $showPerPage): LengthAwarePaginator
    {
        $pageNumber = Paginator::resolveCurrentPage();

        $totalPageNumber = $results->count();

        return self::paginator($results->forPage($pageNumber, $showPerPage), $totalPageNumber, $showPerPage, $pageNumber, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param Collection $items
     * @param int $total
     * @param int $perPage
     * @param int $currentPage
     * @param array $options
     * @return LengthAwarePaginator
     * @throws BindingResolutionException
     */
    public static function paginator(Collection $items, int $total, int $perPage, int $currentPage, array $options): LengthAwarePaginator
    {
        $compact = compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        );
        $compact['items'] = $compact['items']->values();
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, $compact);
    }
}
