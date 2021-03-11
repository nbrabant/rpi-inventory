<?php

namespace App\Infrastructure\Http\Controllers;

class Dashboard extends Controller
{
    public function getIndex()
    {
        return view('layout');
    }
}
