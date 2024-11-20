<aside class="w-64 bg-blue-800 h-screen">
  <div class="p-6 m-2 text-center">
      <h1 class="text-2xl font-semibold text-white">Menu</h1>
  </div>
  <nav x-data="{ isOpen: false }">
      <ul class="p-4 ">
        <li class="mb-4">
          <a href="/dashboard" class="block py-2 px-4 text-white hover:bg-blue-600">
              Dashboard
          </a>
        </li>
        @if(Auth::user()->role == 'kaprodi')
        <li class="mb-4">
          <a href="{{ route('kelola-dosen') }}" class="block py-2 px-4 text-white hover:bg-blue-600">
              Kelola Dosen
          </a>
        </li>
        <li class="mb-4">
          <a href="{{ route('kelola-kelas') }}" class="block py-2 px-4 text-white hover:bg-blue-600">
            Kelola Kelas
          </a> 
        </li>
        <li class="mb-4">
          <a href="{{ route('kelola-mahasiswa') }}" class="block py-2 px-4 text-white hover:bg-blue-600">
            Kelola Mahasiswa
          </a> 
        </li>
        @elseif(Auth::user()->role == 'dosen wali')
        <li class="mb-4">
          <a href="{{ route('kelas') }}" class="block py-2 px-4 text-white hover:bg-blue-600">
            Kelola Mahasiswa
          </a> 
        </li>
        <li class="mb-4">
          <a href="{{ route('requests-list') }}" class="block py-2 px-4 text-white hover:bg-blue-600">
            Permintaan Perubahan Data
          </a> 
        </li>
        @elseif(Auth::user()->role == 'mahasiswa')
        <li class="mb-4">
          <a href="{{ route('profil') }}" class="block py-2 px-4 text-white hover:bg-blue-600">
            Profil Saya
          </a> 
        </li>
      @endif
      </ul>
  </nav>
</aside>
     
        

         {{-- <aside class="w-64 bg-blue-800 h-screen">
          <div class="p-6 m-2 text-center">
            <h1 class="text-2xl font-semibold text-white">Menu</h1>
          </div>
          <nav x-data="{ isOpen: false }">
            <ul class="p-4">
              <x-nav-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
              @if(Auth::user()->role == 'kaprodi')
                <x-nav-link href="{{ route('kelola-dosen') }}" :active="request()->is('kelola-dosen')">Kelola Dosen</x-nav-link>
                <x-nav-link href="{{ route('kelola-kelas') }}" :active="request()->is('kelola-kelas')">Kelola Kelas</x-nav-link>
                <x-nav-link href="{{ route('kelola-mahasiswa') }}" :active="request()->is('kelola-mahasiswa')">Kelola Mahasiswa</x-nav-link>
              @elseif(Auth::user()->role == 'dosen wali')
                <x-nav-link href="{{ route('kelas') }}" :active="request()->is('kelas')">Kelola Mahasiswa</x-nav-link>
                <x-nav-link href="{{ route('requests-list') }}" :active="request()->is('requests-list')">Permintaan Perubahan Data</x-nav-link>
              @elseif(Auth::user()->role == 'mahasiswa')
                <x-nav-link href="{{ route('profil') }}" :active="request()->is('profil')">Profil Saya</x-nav-link>
              @endif
            </ul>
          </nav>
        </aside> --}}
        