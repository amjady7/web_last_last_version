<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * Show the client dashboard.
     */
    public function index()
    {
        return view('client.dashboard');
    }
} 