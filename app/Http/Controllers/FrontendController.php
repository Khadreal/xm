<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\XM\YahooFinanceHandler;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function processSearch(SearchRequest $request)
    {
        $data = ( new YahooFinanceHandler())->getHistoricalData($request);

        return view('historical-data', [
           'data' =>  $data
        ]);
    }

    private function processEmail()
    {

    }
}
