<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use View;
use App\Notification;
use App\Match;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view::composer('*', function($view) {
            if(!Auth::guest()) { 
                $not = count(Notification::where('user_id', Auth::User()->id)->where('new', true)->get());
                $pend = count(Match::where(function($query) {
                                $query->where('user1_id', Auth::User()->id)->where('user1_done', '!=', 10);
                            })->orWhere(function($query) {
                                $query->where('user2_id', Auth::User()->id)->where('user2_done', '!=', 10);
                            })->get());
                $view->with('not', $not)->with('pend', $pend);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
