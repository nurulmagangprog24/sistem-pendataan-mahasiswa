<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-500">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Sistem Pendataan Mahasiswa</title>
</head>

<body class="h-full">
    <div class="flex min-h-full w-full">
        <x-sidebar></x-sidebar>
        <main class="flex-1 min-h-screen">
            <x-header></x-header>
            <section class="py-4 lg:py-8">
                {{-- @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-2" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-2" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif --}}

                @yield('content')
            </section>
        </main>
    </div>
</body>

</html>
