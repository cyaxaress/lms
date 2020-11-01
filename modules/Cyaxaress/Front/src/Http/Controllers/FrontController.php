<?php
namespace Cyaxaress\Front\Http\Controllers;

class FrontController
{
    public function index()
    {
        return view('Front::index');
    }
}
