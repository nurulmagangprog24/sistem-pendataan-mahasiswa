<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Halaman Dashboard</title>
</head>
<body class="bg-gray-100">
    <div class="flex">
      <x-sidebar></x-sidebar>
        <main class="flex-1">
          <x-header></x-header>
          <section>
            @yield('content')
          </section>
    </div>
</body>
</html>
