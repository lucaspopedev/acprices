<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IexService
{

    /**
     * Método responsável por construir a classe com o símbolo.
     *
     */
    public function __construct(private string $symbol) {}

    /**
     * Método responsável por buscar informações gerais da empresa e retorna-as em um array.
     *
     * @param string
     * @return array
     */
    public function getCompanyInfos(): array|null
    {
            $response = Http::get(env('BASE_API_URL') . $this->symbol . '/company?token=' . env('IEX_SECRET_KEY'));

            return $response->json();
    }

    /**
     * Método responsável por buscar informações de ações da empresa e retorna-as em um array.
     *
     * @param string
     * @return array|bool
     */
    public function getActionInfos(): array|null
    {
            $response = Http::get(env('BASE_API_URL') . $this->symbol . '/quote?token=' . env('IEX_SECRET_KEY'));

            return $response->json();
    }

}
