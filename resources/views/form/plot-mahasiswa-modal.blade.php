{{-- <div x-show="openAddModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Tambah Mahasiswa ke Kelas {{ $kelas->name }}</h2>
    <form method="POST" action="{{ route('kelola-kelas.tambahMahasiswa', $kelas->id) }}">
      @csrf
      <label for="mahasiswa" class="block text-gray-700 mb-3">Pilih Mahasiswa</label>
      <div class="text-gray-500 mb-2 grid grid-cols-2 gap-4">
        <span class="font-bold">Nama</span>
        <span class="font-bold">NIM</span>
      </div>
      <select name="mahasiswa_id" id="mahasiswa" class="block w-full border-gray-300 rounded-md shadow-sm">
        @foreach ($availableMahasiswa as $mhs)
          <option value="{{ $mhs->id }}">{{ $mhs->name }} ({{ $mhs->nim }})</option>
        @endforeach
      </select>
      <div class="mt-4">
        <button @click="openAddModal = false" type="button" class="bg-gray-600 text-white py-2 px-4 rounded">Batal</button>
        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded">Tambah</button>
      </div>
    </form>
  </div>
</div> --}}

<div x-show="openAddModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Tambah Mahasiswa ke Kelas {{ $kelas->name }}</h2>
    <form method="POST" action="{{ route('kelola-kelas.tambahMahasiswa', $kelas->id) }}">
      @csrf
      <label for="mahasiswa" class="block text-gray-700 mb-3">Pilih Mahasiswa</label>
      <!-- Dropdown List -->
      <div x-data="{ open: false, selected: null }" class="relative">
        <button @click="open = !open" type="button" class="block w-full border-gray-300 rounded-md shadow-sm bg-white text-left py-2 px-3">
          <span x-text="selected ? selected.name + ' (' + selected.nim + ')' : 'Pilih Mahasiswa'"></span>
          <svg class="absolute right-3 top-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
        <div x-show="open" @click.outside="open = false" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
          <div class="grid grid-cols-2 text-gray-500 text-sm font-medium px-4 py-2 bg-gray-100">
            <span>Nama</span>
            <span>NIM</span>
          </div>
          <ul class="max-h-48 overflow-y-auto">
            @foreach ($availableMahasiswa as $mhs)
            <li @click="selected = { id: '{{ $mhs->id }}', name: '{{ $mhs->name }}', nim: '{{ $mhs->nim }}' }; open = false" 
                class="grid grid-cols-2 px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-700 text-sm">
              <span>{{ $mhs->name }}</span>
              <span>{{ $mhs->nim }}</span>
            </li>
            @endforeach
          </ul>
        </div>
        <!-- Hidden Input to Submit Selected Mahasiswa -->
        <input type="hidden" name="mahasiswa_id" :value="selected ? selected.id : ''">
      </div>
      <!-- Actions -->
      <div class="mt-4">
        <button @click="openAddModal = false" type="button" class="bg-gray-600 text-white py-2 px-4 rounded">Batal</button>
        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded">Tambah</button>
      </div>
    </form>
  </div>
</div>
