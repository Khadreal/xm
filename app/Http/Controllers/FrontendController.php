<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Mail\Notification;
use App\XM\YahooFinanceHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function processSearch(SearchRequest $request)
    {
        $data = ( new YahooFinanceHandler())->getHistoricalData($request);

        Mail::to($request->input('email'))
            ->queue(new Notification($request, $this->generateAttachment($data)));

        return view('historical-data', [
           'data' =>  $data
        ]);
    }

    private function generateAttachment($data)
    {
        $filepath = storage_path( time() . '.csv');
        $file = fopen($filepath, 'wb' );

        fputcsv($file, ['Date', 'Open', 'High', 'Low',
            'Close', 'Volume'
        ]);

        foreach ($data as $history) {
            fputcsv($file, [
                $history['date'],
                $history['open'],
                $history['high'],
                $history['low'],
                $history['close'],
                $history['volume']
            ]);
        }

        return $filepath;
    }
}
