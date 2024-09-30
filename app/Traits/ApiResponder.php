<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponder
{
    public array $mergeArray = [];

    public function success(mixed $data = null, int $code = 200, string $message = null, array $headers = []): JsonResponse
    {
        return $this->createResponse(true, $code, $message ?? __('messages.executed_successfully'), $data, $headers);
    }

    public function error(string $message = null, int $code = 400, mixed $data = null, array $headers = []): JsonResponse
    {
        return $this->createResponse(false, $code, $message ?? __('errors.unexpected_error_occurred'), $data, $headers);
    }

    private function createResponse(bool $success, int $code, ?string $message = null, mixed $data = null, array $headers = []): JsonResponse
    {
        $result = [
            'success' => $success,
            'message' => $message,
            'result' => $this->formatData($data),
        ];
        return response()->json($result, $code, $headers);
    }

    private function formatData(mixed $data)
    {
        if ($data instanceof ResourceCollection) {
            if ($data->resource instanceof LengthAwarePaginator) {
                return $this->formatPaginatedData($data->resource);
            }
        }

        if ($data instanceof LengthAwarePaginator) {
            return $this->formatPaginatedData($data);
        }

        return $data;
    }

    private function formatPaginatedData(LengthAwarePaginator $data): array
    {
        $result = [
            'meta' => [
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'total' => $data->total(),
                    'page_size' => $data->perPage(),
                    'has_more' => $data->hasMorePages(),
                    'next_page_url' => $data->nextPageUrl(),
                    'previous_page_url' => $data->previousPageUrl(),
                    'links' => $data->linkCollection()
                ],
            ],
            'items' => $data->items()
        ];
        return array_merge($result, $this->mergeArray);
    }

    public function setMergeArray($mergeArray): void
    {
        $this->mergeArray = $mergeArray;
    }
}
