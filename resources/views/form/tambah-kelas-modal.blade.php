<!-- Modal Tambah/Edit Kelas -->
<div id="{{ $modalId }}" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
              
        <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
                    <div class="mt-4 text-left">
                      <label for="name" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                      <input type="text" name="name" id="name" value="{{ $kelas->name ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mt-4 text-left">
                      <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Mahasiswa</label>
                      <input type="text" name="jumlah" id="jumlah" value="{{ $kelas->jumlah ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" onclick="closeModal('{{ $modalId }}')" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
      
        
  <script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }
  
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
  </script>
  
  