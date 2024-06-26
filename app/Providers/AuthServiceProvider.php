<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isMyProfile', function ($user, $profileUser) {
            return $user->id === $profileUser->id;
        });
        Gate::define('isMyPost', function ($user, $post) {
            return $user->id === $post->user_id;
        });
        Gate::define('update', function ($user, $post) {
            return $user->id === $post->user_id;
        });
        Gate::define('delete', function ($user, $post) {
            return $user->id === $post->user_id;
        });
        Gate::define('add-to-library', function ($user, $post) {
            return $user->id !== $post->user_id;
        });
        Gate::define('isMyReply', function ($user, $reply) {
            return $user->id === $reply->user_id;
        });
        Gate::define('isLogin', function ($user) {
            return Auth::check();
        });


        //
    }
}
