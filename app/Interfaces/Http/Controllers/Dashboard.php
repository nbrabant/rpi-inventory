<?php

namespace App\Interfaces\Http\Controllers;

class Dashboard extends Controller
{
    public function getIndex()
    {
        return view('layout');
    }
}
