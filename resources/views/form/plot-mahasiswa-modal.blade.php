<div x-show="openAddModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Tambah Mahasiswa ke Kelas {{ $kelas->name }}</h2>
    <form method="POST" action="{{ route('kelola-kelas.tambahMahasiswa', $kelas->id) }}">
      @csrf
      <label for="mahasiswa" class="block text-gray-700 mb-3">Pilih Mahasiswa</label>
      <select name="mahasiswa_id" id="mahasiswa" class="block w-full border-gray-300 rounded-md shadow-sm">
        @foreach ($availableMahasiswa as $mhs)
          <option value="{{ $mhs->id }}">{{ $mhs->name }} ({{ $mhs->nim }})</option>
        @endforeach
      </select>
      <div class="mt-4">
        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded">Tambah</button>
        <button @click="openAddModal = false" type="button" class="bg-gray-600 text-white py-2 px-4 rounded">Batal</button>
      </div>
    </form>
  </div>
</div>