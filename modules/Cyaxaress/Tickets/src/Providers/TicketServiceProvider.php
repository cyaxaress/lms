<?php
namespace Cyaxaress\Ticket\Providers;

use Cyaxaress\Ticket\Models\Reply;
use Cyaxaress\Ticket\Models\Ticket;
use Cyaxaress\Ticket\Policies\ReplyPolicy;
use Cyaxaress\Ticket\Policies\TicketPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider {
    public $namespace = "Cyaxaress\Ticket\Http\Controllers";
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views", "Tickets");
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/web.php');
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
        Gate::policy(Ticket::class, TicketPolicy::class);
        Gate::policy(Reply::class, ReplyPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.tickets', [
            "icon" => "i-tickets",
            "title" => "تیکت های پشتیبانی",
            "url" => route('tickets.index'),
        ]);
    }
}
