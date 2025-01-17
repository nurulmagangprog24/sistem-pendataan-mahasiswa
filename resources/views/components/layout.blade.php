<!DOCTYPE html>
<html lang="en">

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
        <main class="flex-1 min-h-screen bg-gray-100">
            <x-header></x-header>
            <section class="py-4 lg:py-8">
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-4 my-2 rounded-md" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @yield('content')
            </section>
        </main>
    </div>
</body>

</html>
