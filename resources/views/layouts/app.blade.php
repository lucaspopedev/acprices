<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @livewireStyles

    <title>AcPrices - Consulte o valor de ações</title>

</head>
<body>

    @isset($slot)
        {{ $slot }}
    @endisset

    @livewireScripts
</body>
</html>
