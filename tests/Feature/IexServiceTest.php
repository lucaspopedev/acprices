<?php

namespace Tests\Feature;

use App\Services\IexService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class IexServiceTest extends TestCase
{

    public function test_if_iex_api_is_working()
    {
        $appleSymbol = 'AAPL';

        $response = Http::get(env('BASE_API_URL') . $appleSymbol . '/company?token=' . env('IEX_SECRET_KEY'));

        $this->assertSame(200, $response->status());
    }

    public function test_if_response_is_an_array()
    {
        $appleSymbol = 'AAPL';

        $response = Http::get(env('BASE_API_URL') . $appleSymbol . '/company?token=' . env('IEX_SECRET_KEY'));

        $this->assertTrue(Arr::accessible($response->json()));
    }

    public function test_if_iex_service_is_working()
    {
        $appleSymbol = 'AAPL';

        $service = new IexService($appleSymbol);
        $companyInfos = $service->getCompanyInfos($appleSymbol);

        $this->assertSame($appleSymbol, $companyInfos['symbol']);
    }
}
