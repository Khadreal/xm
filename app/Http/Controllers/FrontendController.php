<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Mail\Notification;
use App\Models\CompanySymbol;
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

        $companyName = CompanySymbol::where('symbol', $request->input('symbol'))->first();

        Mail::to($request->input('email'))
            ->send(new Notification(
                $request->all(),
                $this->generateAttachment($data, $companyName->name),
                $companyName->name
            ));

        return view('historical-data', [
           'data' =>  $data
        ]);
    }

    private function generateAttachment(array $data, string $companyName)
    {
        $filepath = storage_path( 'logs/'. strtolower($companyName) . time() . '.csv');
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
