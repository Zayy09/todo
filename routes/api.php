<?php

use Illuminate\Support\Facades\Route;

Route::get('/todos', function () {
    return response()->json([
        'status' => true,
        'message' => 'Data Todo',
        'data' => [
            [
                'id' => 1,
                'task' => 'Belajar Laravel'
            ],
            [
                'id' => 2,
                'task' => 'Integrasi WorkOS'
            ]
        ]
    ]);
});