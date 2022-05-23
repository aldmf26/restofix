<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(Request $request)
    {
        $data = [
            'title' => 'Welcome',
            'logout' => $request->session()->get('logout'),
        ];

        return view('welcome', $data);
    }
}
