<?php

use Alikeshtkar\Tag\Http\Controllers\TagController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified'])->group(function (Router $router){
    $router->get('/tags', [TagController::class, 'index'])->name('tags.index');
    $router->post('/tags', [TagController::class, 'store'])->name('tags.store');
    $router->get('/tags/{edit}/edit', [TagController::class, 'edit'])->name('tags.edit');
    $router->patch('/tags/{edit}', [TagController::class, 'update'])->name('tags.update');
    $router->delete('/tags/{edit}', [TagController::class, 'destroy'])->name('tags.destroy');
});
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');
