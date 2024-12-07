<div x-show="openMoveModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-2xl font-bold text-gray-700 mb-4">Pindahkan Mahasiswa</h2>
      <form method="POST" action="{{ route('kelola-kelas.pindahkanMahasiswa', ['kelas' => $kelas->id, 'mahasiswa' => $selectedMahasiswa]) }}">
          @csrf
          @method('PUT')
          <label for="kelas_id" class="block text-gray-700 mb-3">Pilih Kelas Tujuan</label>
          <select name="kelas_id" id="kelas_id" class="block w-full border-gray-300 rounded-md shadow-sm">
              @foreach ($allKelas as $kelasLain)
              @if ($kelasLain->id !== $kelas->id && $kelasLain->mahasiswa->count() < $kelasLain->jumlah)
              <option value="{{ $kelasLain->id }}">{{ $kelasLain->name }}</option>
              @endif
              @endforeach
          </select>
          <div class="mt-4">
              <button @click="openMoveModal = false" type="button" class="bg-gray-600 text-white py-2 px-4 rounded">
                  Batal
              </button>
              <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">
                  Pindahkan
              </button>
          </div>
      </form>
  </div>
</div>
