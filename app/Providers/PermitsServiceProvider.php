<?php

namespace App\Providers;

use App\Permit;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermitsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            Permit::get()->map(function ($permit) {
                Gate::define($permit->slug, function ($user) use ($permit) {
                    return $user->hasPermitTo($permit);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        //Blade directives
        Blade::directive('role', function ($role) {
             return "if(auth()->check() && auth()->user()->hasRole({$role})) :"; //return this if statement inside php tag
        });

        Blade::directive('endrole', function ($role) {
             return "endif;"; //return this endif statement inside php tag
        });
    }
}
