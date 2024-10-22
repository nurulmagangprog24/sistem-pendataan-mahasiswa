<!-- Modal Tambah/Edit Kelas -->
<div id="{{ $modalId }}" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
              <form action="{{ $actionUrl }}" method="POST">
                  @csrf
                  @if($isEdit)
                      @method('PUT')
                  @endif
                  <div class="mt-2">
                      <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                      <input type="text" name="nama_kelas" id="nama_kelas" value="{{ $kelas->nama_kelas ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                  </div>
              </form>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
              <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal('{{ $modalId }}')">Batal</button>
          </div>
      </div>
  </div>
</div>
