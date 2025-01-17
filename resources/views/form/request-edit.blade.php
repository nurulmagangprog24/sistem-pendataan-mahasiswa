<!-- Modal request edit data-->
<div x-show="openRequestModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black bg-opacity-50">
    <div class="align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      
      <!-- Form Request -->
      <form method="POST" action="{{ route('request.store') }}" class="space-y-4">
        @csrf
        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</h3>
            <div class="mt-4 text-left">
              <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
              <input type="hidden" name="kelas_id" value="{{ $kelas->id }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
              <input type="text" value="{{ $kelas->name }}" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm" readonly>
            </div>

            <div class="mt-4 text-left">
              <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
              <textarea id="keterangan" name="keterangan" class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm" required></textarea>
            </div>

            <div class="flex justify-end space-x-4 mt-4">
              <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md" @click="openRequestModal = false">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Submit Request</button>
            </div>
        </div>
      </form>
    </div>
</div> 
