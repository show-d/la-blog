<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

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
        $cfUnixTimestamp = time();
        $cfRandom = time();
        //$cfIsAdmin = false;
        $cfAdminPath = env('ADMIN_PATH');
        $siteName = env('SITE_NAME');
        $cfYear = date('Y', time());


/*        if (Session::get('isAdmin')){
            $cfIsAdmin = true;

        }*/


        // 使用 View::composer 方法在所有视图中共享变量
        View::composer('*', function ($view) {
            // 获取会话中的变量
            $isAdmin = Session::get('isAdmin');
            $member = Session::get('member');

            // 共享变量到所有视图
            $view->with('cfIsAdmin', $isAdmin);
            $view->with('cfMember', $member);
        });


        View::share('cfUnixTimestamp', $cfUnixTimestamp);
        View::share('cfRandom', $cfRandom);
       // View::share('cfIsAdmin', $cfIsAdmin);
        View::share('cfAdminPath', $cfAdminPath);
        View::share('siteName', $siteName);
        View::share('cfYear', $cfYear);
    }
}
