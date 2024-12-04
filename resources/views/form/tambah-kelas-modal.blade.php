<!-- Modal Tambah/Edit Kelas -->
<div x-show="openCreateModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
    <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ $isEdit ? route('kelas.update', $kelas->id) : route('kelas.store') }}" method="POST">
                @csrf 
                @if($isEdit)
                    @method('PUT')
                @endif
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
                    <div class="mt-4 text-left">
                      <label for="name" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                      <input type="text" name="name" id="name" value="{{ $kelas->name ?? '' }}" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mt-4 text-left">
                      <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Kapasitas</label>
                      <input type="text" name="jumlah" id="jumlah" value="{{ $kelas->jumlah ?? '' }}" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mt-4 text-left">
                        <label for="dosen_id" class="block text-sm font-medium text-gray-700">Pilih Dosen</label>
                        <select name="dosen_id" id="dosen_id" class="border border-gray-400 px-3 py-2 rounded-md w-full">
                          <option value="" disabled selected>-- Pilih Dosen --</option>
                          @foreach($dosen as $dsn)
                          <option value="{{ $dsn->id }}" {{ isset($kelas) && $kelas->dosen_id == $dsn->id ? 'selected' : '' }}>
                            {{ $dsn->name }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    <div class="bg-gray-50 px-4 py-3 gap-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" @click="openCreateModal = false" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>  
  