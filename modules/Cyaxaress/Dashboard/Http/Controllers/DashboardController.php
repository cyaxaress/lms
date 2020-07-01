<?php

namespace Cyaxaress\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        return view('Dashboard::index');
    }
}
