<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\rolepermission;
use App\Models\notification;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

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

        $notification=notification::all();
        view()->share('data6',$notification);

        $permission=Permission::all();
        view()->share('data7',$permission);


        view()->composer('*', function($view)
        {
            if (Auth::check()) {
             $rolepermissions = RolePermission::with('permission')->where('role_id', Auth::user()->role)->get();
             $view->with('currentUser', Auth::user())
            ->with('rolePermissions', $rolepermissions);
            }else {
            $view->with('currentUser', null);
            }
        });
    }
}
