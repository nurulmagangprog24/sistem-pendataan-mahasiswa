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
    <div class="flex h-screen w-full">
      <x-sidebar></x-sidebar>
        <main class="flex-1">
          <x-header></x-header>
          <section >
            @yield('content')
          </section>
        </main>
    </div>
</body>
</html>
