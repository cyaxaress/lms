<?php

namespace Cyaxaress\Comment\Providers;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
    }

    public function boot()
    {

    }
}
