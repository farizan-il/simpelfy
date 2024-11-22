<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    public function index(Request $request)
    {
        return view('gondowangi.comingsoon', [
            'title' => 'Coming Soon'
        ]);
    }
}
