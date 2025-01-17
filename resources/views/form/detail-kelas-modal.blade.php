<div x-show="openDetailModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-5xl overflow-hidden">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-700">Daftar Mahasiswa Kelas {{ $kelas->name }}</h2>
            <button @click="openDetailModal = false" class="border border-slate-400 rounded px-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 hover:cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        @if ($kelas->mahasiswa->count() >= $kelas->jumlah)
            <div class="bg-red-600 text-white py-2 px-4 rounded flex mb-4">
                Kelas Penuh
            </div>
        @else
            <!-- Button untuk membuka modal Tambah Mahasiswa -->
            <div class="mb-4">
                <button @click="openAddModal = true"
                    class="bg-green-600 text-white py-2 px-4 rounded hover:underline">
                    Tambah Mahasiswa
                </button>
                @include('form.plot-mahasiswa-modal', [
                    'kelas' => $item,
                    'availableMahasiswa' => $availableMahasiswa,
                ])
            </div>
        @endif

        <div class="overflow-auto max-h-[75vh]">
            <table class="w-full table-auto bg-white border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">No</th>
                        <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">NIM</th>
                        <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Nama</th>
                        <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Kelas</th>
                        <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Tempat Lahir</th>
                        <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Tanggal Lahir</th>
                        <th class="px-4 py-2 bg-gray-200 text-gray-700 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $mhs->nim }}</td>
                            <td class="px-4 py-2">{{ $mhs->name }}</td>
                            <td class="px-4 py-2">{{ $mhs->kelas->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $mhs->tempat_lahir }}</td>
                            <td class="px-4 py-2">{{ $mhs->tanggal_lahir }}</td>
                            <td class="px-4 py-2">
                                <div x-data="{ openMoveModal: false, selectedMahasiswa: null }" x-cloak>
                                    <button type="button"
                                        class="bg-blue-600 text-white px-2 py-1 rounded-md hover:bg-blue-700"
                                        @click="openMoveModal = true">Pindahkan</button>
                                    @include('form.pindah-kelas-modal', [
                                        'allKelas' => $allKelas,
                                        'selectedMahasiswa' => $mhs->id,
                                    ])
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

