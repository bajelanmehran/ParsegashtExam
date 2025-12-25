<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{

    protected function toJson($result = []): JsonResponse
    {
        return response()->json($result);
    }

    protected function hasError(string $message)
    {
        return $this->toJson([
            'success' => false,
            'message' => $message
        ]);
    }
}
