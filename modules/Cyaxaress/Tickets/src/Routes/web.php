<?php
Route::resource("tickets", "TicketController");
Route::post("tickets/{ticket}/reply", "TicketController@reply")->name("tickets.reply");
