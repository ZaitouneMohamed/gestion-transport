<?php

namespace App\Providers;

use App\Models\Camion;
use App\Models\Chaufeur;
use App\Models\Consomation;
use App\Models\Papier;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('gazole.layouts.master', function ($view) {
            $cachedCounts = [
                'chauffeur' => Cache::rememberForever('chauffeur_count', function () {
                    return Chaufeur::count();
                }),
                'camion' => Cache::rememberForever('camion_count', function () {
                    return Camion::count();
                }),
                'papier' => Cache::rememberForever('papier_count', function () {
                    return Papier::count();
                }),
                'station' => Cache::rememberForever('station_count', function () {
                    return Station::count();
                }),
                'consomation' => Cache::rememberForever('consomation_count', function () {
                    return Consomation::count();
                }),

            ];
            $view->with('cachedCounts', $cachedCounts);
        });
        View::composer('gazole.index', function ($view) {
            $Counts = [
                'camion_aej_count' => Cache::rememberForever('camion_aej_count', function () {
                    return Camion::Active()->Aej()->count();
                }),
                'active_chauffeurs' => Cache::rememberForever('active_chauffeurs', function () {
                    return Chaufeur::Active()->count();
                }),
                'station_count_index' => Cache::rememberForever('station_count_index', function () {
                    return Station::count();
                }),
                'consomationsCountIndex' => Cache::rememberForever('consomationsCountIndex', function () {
                    return Consomation::whereMonth('date', Carbon::now()->month)->count();
                }),

            ];
            $view->with('Counts', $Counts);
        });
        View::composer('components.notifications', function ($view) {
            $latest_notifications = Auth::user()->notifications();

            $view->with('latest_notifications', $latest_notifications); // Send variable directly
        });

    }
}
