<?php

namespace App\Providers;

use Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    public function boot(): void
    {
        Gate::define('isAdmin', function ($usuario) {
            return $usuario->role === 'admin';
        });

        Gate::define('isProfessor', function ($usuario) {
            return $usuario->role === 'professor' || $usuario->role === 'admin';
        });

        Gate::define('isAluno', function ($usuario) {
            return $usuario->role === 'aluno' || $usuario->role === 'admin';
        });
    }
}
