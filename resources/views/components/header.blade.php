<header class="w-full bg-blue-600 shadow-md py-4 px-6 flex justify-between items-center">
  {{-- <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"> --}}
    {{-- </div> --}}
    <div class="flex flex-col space-y-4">
      <h1 class="text-white text-2xl font-bold">Sistem Pendataan Mahasiswa</h1>
      <h2 class="text-white">Hi, {{-- Auth::user()->username --}}</h2>
    </div>
    <a href="/logout" class="text-white bg-red-500 px-3 py-2 rounded-md hover:bg-red-600">
        Logout
    </a>
</header>
