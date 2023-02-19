<?php

namespace App\XM;

use App\XM\Exception\InvalidException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class YahooFinanceHandler
{
    private string $baseEndpoint = 'https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data';
    private string $key = 'b5615839e7mshba66d6cb8a08d10p14ac48jsn3dc0fb85d738';

    public function getHistoricalData($data)
    {
        $startDate = date('Y-m-d', strtotime($data['start_date']));
        $endDate = date('Y-m-d', strtotime($data['end_date']));

        $args = [
            'symbol' => $data['symbol'] ?? 'AMRN',
            'region' => 'US',
        ];

        try{
            $req = Http::withHeaders([
                'X-RapidAPI-Key' => $this->key,
                'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com'
            ])->get($this->baseEndpoint, $args);
        } catch (\Exception $e) {
            throw new BadRequestException('Invalid request');
        }

        $jsonResponse = $req->json();

        /**
         * Hack to filter by date, api doesn't seems to support filter by date
         * range, tried using different approach but none work and can't find date option
         * on their doc (https://rapidapi.com/apidojo/api/yh-finance/)
         */
        $data = [];
        foreach ($jsonResponse['prices'] as $price) {
            $currentPriceDate = date('Y-m-d', $price['date']);
            if ($currentPriceDate >= $startDate && $currentPriceDate <= $endDate ) {
                $data[] = $price;
            }
        }

        return $data;
    }
}
