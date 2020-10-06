<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Place;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if(DB::table('settings')->exists()){
            $langs=explode(',',env('APP_LANGS'));
            $settings = Settings::all();
            $pages = Page::all();
            $categories = Category::all();
            $countPlaces = Place::with(['owner' => function ($q) {
                $q->accepted(1);
            }])->count();
            view()->share(compact('settings', 'pages', 'categories', 'countPlaces','langs'));

        }
           }
}
