<?php

namespace App\Providers;

use App\Models\category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('admin_request', function (User $user) {
            return $user->role->name === 'admin';
        });

        Gate::define('category', function (User $user,category $category) {
            return $user->role->name === 'admin' || $category->staff_id == $user->id;
        });

        Gate::define('sub_category', function (User $user, SubCategory $sub_category) {
            return $user->role->name === 'admin' || $sub_category->staff_id == $user->id;
        });

        Gate::define('product', function (User $user, Product $product) {
            return $user->role->name === 'admin' || $product->staff_id == $user->id;
        });

    }
}
