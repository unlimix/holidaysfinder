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
        $title = '';

        if ($request->isMethod(Request::METHOD_POST)) {
            $rules = [
                'date' => 'required|date',
            ];
            $messages = [
                'required' => 'The :attribute field is required.',
            ];
            $this->validate($request, $rules, $messages);

            $title = $finder->getDayStatus($request);
        }

        return view('index.index', ['title' => $title]);
    }

}
