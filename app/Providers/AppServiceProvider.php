<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Models\sewa_crew;
use App\Policies\sewa_crewPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\SewaWidgetPolicy;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;

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
        //
        $this->registerPolicies();
        Gate::policy(sewa_crew::class, sewa_crewPolicy::class);
    }

    protected $policies = [
        // Mengaitkan policy dengan model atau widget
        User::class => SewaWidgetPolicy::class,
        User::class => UserPolicy::class, // Menambahkan mapping untuk UserPolicy
        sewa_crew::class => sewa_crewPolicy::class,
    ];
}
