<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Menor Lance Único</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center selection:bg-[#F7931A] selection:text-white">
            <div class="relative w-full h-svh max-w-2xl px-6 flex flex-col justify-between lg:max-w-7xl">
                <header class="flex text-center pt-2">
                    <div class="flex lg:justify-between lg:col-start-2">
                        <svg width="67px" height="67px" viewBox="0.004 0 64 64" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M63.04 39.741c-4.274 17.143-21.638 27.575-38.783 23.301C7.12 58.768-3.313 41.404.962 24.262 5.234 7.117 22.597-3.317 39.737.957c17.144 4.274 27.576 21.64 23.302 38.784z"
                                fill="#F7931A" />
                            <path
                                d="M46.11 27.441c.636-4.258-2.606-6.547-7.039-8.074l1.438-5.768-3.512-.875-1.4 5.616c-.922-.23-1.87-.447-2.812-.662l1.41-5.653-3.509-.875-1.439 5.766c-.764-.174-1.514-.346-2.242-.527l.004-.018-4.842-1.209-.934 3.75s2.605.597 2.55.634c1.422.355 1.68 1.296 1.636 2.042l-1.638 6.571c.098.025.225.061.365.117l-.37-.092-2.297 9.205c-.174.432-.615 1.08-1.609.834.035.051-2.552-.637-2.552-.637l-1.743 4.02 4.57 1.139c.85.213 1.683.436 2.502.646l-1.453 5.835 3.507.875 1.44-5.772c.957.26 1.887.5 2.797.726L27.504 50.8l3.511.875 1.453-5.823c5.987 1.133 10.49.676 12.383-4.738 1.527-4.36-.075-6.875-3.225-8.516 2.294-.531 4.022-2.04 4.483-5.157zM38.087 38.69c-1.086 4.36-8.426 2.004-10.807 1.412l1.928-7.729c2.38.594 10.011 1.77 8.88 6.317zm1.085-11.312c-.99 3.966-7.1 1.951-9.083 1.457l1.748-7.01c1.983.494 8.367 1.416 7.335 5.553z"
                                fill="#FFFFFF" />
                        </svg>
                    </div>
                    @if (Route::has('login'))
                        <nav class="mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Painel
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Iniciar sessão
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Cadastrar-se
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <main>
                    <canvas class="w-full h-[75vh]" id="bitcoinChart" width="100%" height="100%"></canvas>
                    <script>
                        fetch('https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=1')
                            .then(response => response.json())
                            .then(data => {
                                const labels = data.prices.map(price => new Date(price[0]).toLocaleTimeString());
                                const prices = data.prices.map(price => price[1]);

                                const ctx = document.getElementById('bitcoinChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Preço do Bitcoin (USD)',
                                            data: prices,
                                            borderColor: '#F7931A',
                                            backgroundColor: 'rgba(247, 147, 26, 0.2)',
                                            borderWidth: 1,
                                        }],
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: {
                                            x: {
                                                type: 'category',
                                                title: {
                                                    display: true,
                                                    text: 'Hora',
                                                },
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Preço (USD)',
                                                },
                                            },
                                        },
                                    },
                                });
                            })
                            .catch(error => console.error('Erro ao carregar os dados do Bitcoin:', error));
                    </script>
                </main>

                <footer class="py-5 text-center text-sm text-black dark:text-white/70">
                    &copy; BetoFoxNet_Info 2015 - {{ date('Y') }}
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
