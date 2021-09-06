<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Services\IexService;
use Livewire\Component;

class AcPrices extends Component
{
    public $symbol;
    public $companyInfos;
    public $actionInfos;

    /**
     * Validações do campo de símbolo.
     */
    protected array $rules = [
        "symbol" => 'required|min:2'
    ];

    /**
     * Tradução das mensagens de validação.
     */
    protected array $messages = [
        "symbol.required" => "Este campo é obrigatório!",
        "symbol.min" => "É preciso de no mínimo dois caracteres!"
    ];

    public function execute()
    {
        // Aplica a validação do campo de símbolo.
        $this->validate();

        // Instância do serviço de consumo da api do IEX (https://iexcloud.io/docs/api/)
        $iex = new IexService($this->symbol);

        // Se a empresa não existir no banco de dados, realiza a requisição a api e cadastra a empresa.
        if (!$this->checkIfCompanyExists($this->symbol)) {

            $this->companyInfos = $iex->getCompanyInfos();
            $this->storeNewCompany($this->symbol);

        }

        $this->companyInfos = Company::query()->where('symbol', '=', $this->symbol)->get()->first();

        $this->actionInfos = $iex->getActionInfos();

        // Retorna um erro ao usuário caso a símbolo da empresa seja inválido.
        if (is_null($this->companyInfos)) {
            $this->addError('error', 'Símbolo inválido!');
        }

    }

    /**
     * Método responsável por cadastrar as informações da empresa no banco de dados.
     *
     */
    private function storeNewCompany($symbol)
    {
        Company::query()->create([
            'symbol' => $this->companyInfos['symbol'],
            'name' => $this->companyInfos["companyName"],
            'website' => $this->companyInfos["website"],
            'exchange' => $this->companyInfos["exchange"],
            'sector' => $this->companyInfos["sector"],
            'companyName' => $this->companyInfos["companyName"],
        ]);
    }

    /**
     * Método responsável por conferir se a empresa já está cadastrada no banco de dados.
     *
     * @return bool
     */
    private function checkIfCompanyExists($symbol): bool
    {
        $checkIfExists = Company::query()->where('symbol', '=', $symbol)->get()->first();

        if (!$checkIfExists) {
            return false;
        }

        return true;
    }

    public function render()
    {
        return view('livewire.ac-prices');
    }

}
