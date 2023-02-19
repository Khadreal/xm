<?php

namespace Database\Seeders;

use App\Models\CompanySymbol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CompanySymbolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(dirname(__FILE__) . '/json/company-symbols.json');

        $array = json_decode($json);

        foreach ($array as $item) {
            $item = (array) $item;

            $exists = CompanySymbol::where('symbol', Arr::get($item, 'Symbol'))->first();

            if (! $exists) {
                CompanySymbol::create([
                    'symbol' => $item['Symbol'],
                    'name' => $item['Company Name']
                ]);
            }
        }
    }
}
