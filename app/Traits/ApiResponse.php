<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse
{
    /**
     * Generates a standardized JSON response.
     *
     * @param  int  $code  HTTP status code
     * @param  string  $message  Response message
     * @param  array  $data  Response data
     * @param  array  $errors  Validation or processing errors
     * @param  LengthAwarePaginator|null  $paginator  Paginator for paginated results
     */
    public function getResponse(
        int $code = 200,
        string $message = 'success',
        array $data = [],
        array $errors = [],
        ?LengthAwarePaginator $paginator = null
    ): JsonResponse {
        // Create the base response structure
        $response = $this->createBaseResponse($code, $message, $errors);

        // Include data if it's provided
        if (! empty($data)) {
            $response['data'] = $data;

            // Include pagination data if paginator is provided
            if ($paginator instanceof LengthAwarePaginator) {
                $response['data'] = array_merge($response['data'], $this->getPaginationData($paginator));
            }
        }

        return response()->json($response, $code);
    }

    /**
     * Creates the base response structure.
     */
    private function createBaseResponse(int $code, string $message, array $errors): array
    {
        return [
            'result' => $this->determineResult($code),
            'code' => $code,
            'timestamp' => now()->toISOString(),
            'message' => $message,
            'errors' => ! empty($errors) ? $errors : null,
        ];
    }

    /**
     * Determines the result status based on the HTTP code.
     */
    private function determineResult(int $code): string
    {
        return ($code >= 200 && $code < 400) ? 'success' : 'failed';
    }

    /**
     * Extracts pagination data from the paginator.
     */
    private function getPaginationData(LengthAwarePaginator $paginator): array
    {
        return [
            'totalItems' => $paginator->total(),
            'itemsPerPage' => $paginator->count(),
            'totalPages' => $paginator->lastPage(),
            'currentPage' => $paginator->currentPage(),
        ];
    }
}
