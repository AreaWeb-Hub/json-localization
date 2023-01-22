<?php

use Illuminate\Http\JsonResponse;

function responseOk(): JsonResponse
{
    return response()->json([
        'status' => 'success'
    ]);
}
function responseCreated(): JsonResponse
{
    return response()->json([
        'status' => 'success'
    ], 201);
}

function authUserId(): ?int
{
    return auth()->id();
}
