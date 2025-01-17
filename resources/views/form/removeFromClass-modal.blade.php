<div x-show="openRemoveModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-lg font-bold mb-4">Keluarkan Mahasiswa</h2>
        <p>Apakah Anda yakin ingin mengeluarkan {{ $mhs->name }} dari kelas?</p>
        <div class="mt-4 flex gap-2 justify-end">
            <button @click="openRemoveModal = false" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <form action="{{ route('mahasiswa.remove', $mhs->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">Keluarkan</button>
            </form>
        </div>
    </div>
</div>
