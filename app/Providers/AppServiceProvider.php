<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated; // Importation l-mohimma

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
    public function boot(): void
    {
        // Hna ghadi n-faksiw l-mouchkil dyal Redirect
        RedirectIfAuthenticated::redirectUsing(fn () => route('admin.dashboard'));
    }
}