<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CartCountController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Run storage:link command
        if (!file_exists(storage_path('app/public'))) {
            Artisan::call('storage:link');
        }

        // Cart Count functionality
        View::composer('*', function ($view) {
            $cartCountController = new CartCountController();
            $userId = Auth::id();
            $totalCount = 0;

            if ($userId) {
                // Fetch the count only if the user is authenticated
                $totalCount = $cartCountController->getCartItemCount($userId);
            }

            $view->with('totalCount', $totalCount);
        });
    }
}
