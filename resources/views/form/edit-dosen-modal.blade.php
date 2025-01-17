<div x-show="editDosenModal" x-transition class="fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
      
      <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          
          <!-- form untuk edit data -->
            <form action="{{ $isEdit ? route('dosen.update', $dosen->id) : route('dosen.store')}}" method="POST">
              @csrf
              @if($isEdit)
                  @method('PUT')
              @endif
              <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                  <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">{{ $title }}</h3>
                  
                  <div class="mt-4 text-left">
                      <label for="kode_dosen" class="block text-sm font-medium text-gray-700">Kode Dosen</label>
                      <input type="text" name="kode_dosen" id="kode_dosen" value="{{ $dosen->kode_dosen ?? '' }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
                  </div>

                  <div class="mt-4 text-left">
                      <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                      <input type="text" name="nip" id="nip" value="{{ $dosen->nip ?? '' }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
                  </div>

                  <div class="mt-4 text-left">
                      <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                      <input type="text" name="name" id="name" value="{{ $dosen->name ?? '' }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
                  </div>
                  <div class="mt-4 text-left">
                      <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                      <select name="kelas_id" id="kelas_id" class="border border-gray-400 px-3 py-2 rounded-md w-full">
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->id }}" {{ (old('kelas_id') ?? ($dosen->kelas_id ?? '')) == $kls->id ? 'selected' : '' }}>{{ $kls->name }}</option>
                            @endforeach
                      </select>
                  </div>
              </div>

              <div class="px-4 py-3 gap-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 sm:w-auto sm:text-sm">
                      Simpan
                  </button>
                  <button type="button" @click="editDosenModal = false" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                      Batal
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>