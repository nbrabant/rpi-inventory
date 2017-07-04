<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function getIndex()
    {
        return view('layout');
    }

    public function getBuildJs()
    {
        // return response()->download(base_path('public/build/private.built.js'));
    }

    public function getBuildJsMap()
    {
        // return response()->download(base_path('public/build/private.built.js'));
    }
}
