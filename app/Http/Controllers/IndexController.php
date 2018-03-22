<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index.index', ['msg' => 'Hello World!']);
    }

    public function find(Request $request)
    {
        return view('index.index', ['msg' => $request->date]);
    }
}
