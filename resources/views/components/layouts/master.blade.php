<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>একতা যুব সংঘ MPL — মজমপুর প্রিমিয়ার লীগ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pitch: '#1F5C3F',
                        pitchdark: '#0F2E22',
                        pitchdeep: '#0A2018',
                        gold: '#E8A33D',
                        goldlight: '#F4C67A',
                        cream: '#FBF3E1',
                        creamdark: '#F1E6CB',
                        maroon: '#A32B1F',
                        ink: '#14251D',
                    },
                    fontFamily: {
                        display: ['"Baloo Da 2"', 'sans-serif'],
                        body: ['"Hind Siliguri"', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-cream text-ink">
    <x-ui.notice />
    <x-layouts.header />
    <main>
        {{ $slot }}
    </main>

    <x-layouts.footer />

    <script>
        function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>
</body>

</html>