<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



// Routes protégées
// Route::middleware('auth:sanctum')->group(function () {
//         Route::prefix('reviews')->middleware(['verified', 'reliable'])->group(function () {
//         Route::get('/{id}', [ReviewController::class, 'show']);
//         Route::post('/', [ReviewController::class, 'store']);
//         Route::put('/{id}', [ReviewController::class, 'update']);
//         Route::delete('/{id}', [ReviewController::class, 'destroy']);
//     });




// });