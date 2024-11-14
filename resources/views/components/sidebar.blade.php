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
          <a href="{{ route('kelola-mahasiswa') }}" class="block py-2 px-4 text-white hover:bg-blue-600">
            Kelola Mahasiswa
          </a> 
        </li>
        <li class="mb-4">
          <a href="#" class="block py-2 px-4 text-white hover:bg-blue-600">
            Permintaan Perubahan Data
          </a> 
        </li>
        @elseif(Auth::user()->role == 'mahasiswa')
        <li class="mb-4">
          <a href="/profil" class="block py-2 px-4 text-white hover:bg-blue-600">
            Profil Saya
          </a> 
        </li>
        <li class="mb-4">
          <a href="#" class="block py-2 px-4 text-white hover:bg-blue-600">
            Ajukan Perubahan Data
          </a> 
        </li>
      @endif
      </ul>
  </nav>
</aside>
     
        