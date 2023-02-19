<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function processSearch(SearchRequest $request)
    {

    }
}
