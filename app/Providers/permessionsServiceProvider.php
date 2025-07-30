<?php

namespace App\Providers;

use App\Models\permessions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class permessionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        permessions::get()->map(function ($permession) {


            Gate::define($permession->name, function ($user) use ($permession) {

                return $user->hasPermessionTo($permession);

            });
            
        });
    }
}
