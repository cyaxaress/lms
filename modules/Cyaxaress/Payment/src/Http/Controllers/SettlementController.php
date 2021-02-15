<?php

namespace Cyaxaress\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view("Payment::settlements.create");
    }
}
