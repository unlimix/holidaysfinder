<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Holiday\Finder;

class IndexController extends Controller
{

    /**
     * @param Request $request
     * @param Finder $finder
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, Finder $finder)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'date' => 'required|date',
            ];

            $this->validate($request, $rules);

            return view('index.index', ['title' => $finder->getDayStatus($request)]);
        }

        return view('index.index', ['title' => '']);
    }

}
