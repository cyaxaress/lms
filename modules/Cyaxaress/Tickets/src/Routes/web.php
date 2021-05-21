<?php
Route::resource("tickets", "TicketController");
Route::post("tickets/{ticket}/reply", "TicketController@reply")->name("tickets.reply");
Route::get("tickets/{ticket}/close", "TicketController@close")->name("tickets.close");
