<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\PixelsLeft;
use Auth;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
        View::share('pixels_left', PixelsLeft::all()->first());
        
        view()->composer('template.header', function ($view) 
        {

            if(Auth::check()):
                $view->with(['userinfo' => 'true', 'username' => Auth::user()->name]);    
            else:
                $view->with('userinfo', 'false' );    
            endif;
        });  


    }

    public function register()
    {
        //
    }
}