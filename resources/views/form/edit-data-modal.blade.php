<div x-show="openEditModal" x-transition class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">
        <h3 class="text-xl font-semibold mb-4">Edit Profil</h3>

        <!-- Form Start -->
        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md"
                    value="{{ old('username', $user->username) }}">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="text" id="email" name="email" class="w-full px-4 py-2 border rounded-md"
                value="{{ old('email', $user->email) }}">
            </div>
            
            <!-- NIP Field for Kaprodi/Dosen -->
            @if (isset($kaprodi) || isset($dosen))
            <div class="mb-4">
                <label for="nip" class="block text-gray-700 font-medium mb-1">NIP</label>
                <input type="text" id="nip" name="nip" class="w-full px-4 py-2 border rounded-md"
                value="{{ old('nip', $kaprodi->nip ?? $dosen->nip) }}">
            </div>
            <div class="mb-4">
                <label for="kode_dosen" class="block text-gray-700 font-medium mb-1">Kode Dosen</label>
                <input type="text" id="kode_dosen" name="kode_dosen" class="w-full px-4 py-2 border rounded-md"
                value="{{ old('kode_dosen', $kaprodi->kode_dosen ?? $dosen->kode_dosen) }}">
            </div>
            @endif
            
            <!-- NIM Field for Mahasiswa -->
            @if (isset($mahasiswa))
                <div class="mb-4">
                    <label for="nim" class="block text-gray-700 font-medium mb-1">NIM</label>
                    <input type="text" id="nim" name="nim" class="w-full px-4 py-2 border rounded-md"
                        value="{{ old('nim', $mahasiswa->nim) }}">
                </div>
                <!-- Place of Birth -->
                <div class="mb-4">
                    <label for="tempat_lahir" class="block text-gray-700 font-medium mb-1">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="w-full px-4 py-2 border rounded-md"
                    value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir ?? '') }}">
                </div>
                
                <!-- Date of Birth -->
                <div class="mb-4">
                    <label for="tanggal_lahir" class="block text-gray-700 font-medium mb-1">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="w-full px-4 py-2 border rounded-md"
                    value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ?? '') }}">
                </div>
            @endif

            <div class="flex justify-end mt-4">
                <button type="button" class="bg-red-400 text-white px-4 py-2 rounded-md" @click="openEditModal = false">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2">Simpan</button>
            </div>
        </form>
    </div>
</div>
