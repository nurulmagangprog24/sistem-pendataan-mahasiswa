<div x-show="openEditModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-lg font-semibold text-gray-700">Edit Profil Mahasiswa</h3>
        <form action="{{ route('profile.update') }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $mahasiswa->name) }}" class="w-full px-4 py-2 border rounded-md">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- NIM -->
            <div class="mb-4">
                <label for="nim" class="block text-sm font-medium text-gray-600">NIM</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="w-full px-4 py-2 border rounded-md">
                @error('nim') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tempat Lahir -->
            <div class="mb-4">
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-600">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}" class="w-full px-4 py-2 border rounded-md">
                @error('tempat_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-600">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}" class="w-full px-4 py-2 border rounded-md">
                @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md">Simpan Perubahan</button>
        </form>
        <!-- Close Button -->
        <button @click="openEditModal = false" class="mt-4 text-red-500 hover:text-red-600">Tutup</button>
    </div>
</div>
