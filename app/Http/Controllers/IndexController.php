<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Holiday\Finder;
use App\Helpers\Holiday\HolidaysData;

class IndexController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $holidayFinder = new Finder(new HolidaysData());
        return view('index.index', ['title' => $holidayFinder->getDayStatus($request)]);
    }

}
