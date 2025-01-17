<div x-show="openEditMahasiswaModal" x-transition class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <!-- form untuk edit data -->
                <form action="{{ $isEdit ? route('mahasiswa.update', $mahasiswa->id) : route('mahasiswa.store') }}"
                    method="POST">
                    @csrf
                    @if ($isEdit)
                        @method('PUT')
                    @endif
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</h3>

                        <div class="mt-4 text-left">
                            <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
                        </div>

                        <div class="mt-4 text-left">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $mahasiswa->name ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
                        </div>
                        @if (Auth::user()->role == 'kaprodi')
                            <div class="mt-4 text-left">
                                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select name="kelas_id" id="kelas_id"
                                    class="border border-gray-400 px-3 py-2 rounded-md w-full">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id }}"
                                            {{ (old('kelas_id') ?? ($mahasiswa->kelas_id ?? '')) == $kls->id ? 'selected' : '' }}>
                                            {{ $kls->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="mt-4 text-left">
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat
                                Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                value="{{ $mahasiswa->tempat_lahir ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
                        </div>

                        <div class="mt-4 text-left">
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal
                                Lahir</label>
                            <input type="text" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ $mahasiswa->tanggal_lahir ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="px-4 py-3 gap-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 sm:w-auto sm:text-sm">
                            Simpan
                        </button>
                        <button type="button" @click="openEditMahasiswaModal = false"}
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>