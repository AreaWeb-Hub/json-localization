<?php

use Illuminate\Http\JsonResponse;

function responseOk(): JsonResponse
{
    return response()->json([
        'status' => 'success'
    ]);
}

function authUserId(): ?int
{
    return auth()->id();
}
