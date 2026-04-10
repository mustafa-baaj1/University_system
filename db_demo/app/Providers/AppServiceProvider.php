<?php

namespace App\Providers;

use App\Http\Controllers\Api\DepController;
use App\Policies\DepartmentPolicy;
use App\Policies\DepPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.tailwind');

        Gate::define("post_owner",function($user,$post){
        return $user->id === $post->user_id;
    });


    }
}
