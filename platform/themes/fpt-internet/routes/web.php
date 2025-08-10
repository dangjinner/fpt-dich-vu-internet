<?php

use Illuminate\Support\Facades\Route;
use Theme\FptInternet\Http\Controllers\FptInternetController;

// Custom routes
// You can delete this route group if you don't need to add your custom routes.
Route::group(['controller' => FptInternetController::class, 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        // Add your custom route here
        Route::post('/register-service', [FptInternetController::class, 'registerService'])
            ->name('register-service');

        Route::get('/thank-you', [FptInternetController::class, 'thankYou'])
            ->name('thank-you');
    });
});

Theme::routes();
