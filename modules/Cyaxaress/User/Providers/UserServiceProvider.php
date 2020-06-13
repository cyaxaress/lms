<?php


namespace Cyaxaress\User\Providers;


use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        dd('hello world');
    }
}
