<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Categories\CategoriesRepository; 
use App\Repository\Categories\CategoriesRepositoryInterface; 
use App\Repository\Articles\ArticleRepository; 
use App\Repository\Articles\ArticleRepositoryInterface; 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
       $this->app->bind(CategoriesRepositoryInterface::class, CategoriesRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
