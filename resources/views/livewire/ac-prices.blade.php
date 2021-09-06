
    <div class="flex min-h-screen flex-col items-center justify-center" style="background: linear-gradient(to bottom,#0047bb,#440099)">
    <div class="flex flex-col md:w-1/3 bg-white p-4 rounded-md items-center shadow">
        <h1 class="uppercase font-semibold">Consulte uma ação</h1>

        <input
            wire:model.debounce.500ms="symbol"
            name="symbol"
            autocomplete="off"
            placeholder="Exemplo: AAPL"
            type="text"
            class="w-full border-2 border-gray-50 rounded-md p-2 my-8 focus:outline-none focus:ring-1 focus:ring-blue-700 focus:border-transparent hover:ring-blue-700"
        />

        <button
            wire:click="execute"
            class="flex flex-col lg:flex-row items-center bg-blue-200 hover:bg-blue-100 p-4 border-gray-50 rounded-md uppercase shadow-sm "
            wire:loading.attr="disabled"
        >
            <div class="flex flex-row" id="btnContent">
                <span class="mr-2 font-semibold">Consultar</span>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            @include("components.spinner", ["action" => "execute"])

        </button>
    </div>

    @isset($companyInfos["symbol"])
        <div class="transition-all flex-col md:w-1/3 bg-white p-4 rounded-md items-start mt-8">
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Nome:</h3>
                <p>{{ $companyInfos["companyName"] ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Último preço:</h3>
                <p>US$ {{ number_format($actionInfos["latestPrice"],2,",",".") ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Alta:</h3>
                <p>US$ {{ number_format($actionInfos["high"],2,",",".") ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Baixa:</h3>
                <p>US$ {{ number_format($actionInfos["low"],2,",",".") ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Moeda:</h3>
                <p>{{ $actionInfos["currency"] ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Símbolo:</h3>
                <p>{{ $companyInfos["symbol"] ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Website:</h3>
                <p>{{ $companyInfos["website"] ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Exchange:</h3>
                <p>{{ $companyInfos["exchange"] ?? "" }} </p>
            </div>
            <div class="flex flex-row items-center">
                <h3 class="font-bold mr-2">Setor:</h3>
                <p>{{ $companyInfos["sector"] ?? "" }} </p>
            </div>
        </div>
    @endisset

    @include("livewire.validations.global-validation")

</div>
