<?php
Route::group(["middleware" => ["auth"]], function (Illuminate\Routing\Router $router){
    $router->get("/notifications/mark-as-read", "NotificationController@markAllAsRead")
        ->name("notifications.markAllAsRead");
});
