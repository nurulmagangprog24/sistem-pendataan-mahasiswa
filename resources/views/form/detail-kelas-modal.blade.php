<div x-show="openDetailModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg ">  
  <h2 class="text-2xl font-bold text-gray-700 mb-6 ">Daftar Mahasiswa Kelas {{ $kelas->name }}</h2>
    <div class="mb-4">
        <!-- Button untuk membuka modal Tambah Mahasiswa -->
        {{-- <button class="bg-blue-600 text-white py-2 px-4 rounded">Tambah Mahasiswa</button> --}}
        <button @click="openDetailModal = false" class="bg-blue-600 text-white py-2 px-4 rounded">Tutup</button>
    </div>

    <div class="flex h-full min-w-full flex-col justify-between overflow-hidden rounded-lg shadow-lg">
        <table class="min-w-full overflow-scroll bg-white leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">No</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">NIM</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Nama</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Kelas</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Tempat Lahir</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
            <tr>
                <td class="px-5 py-3">{{ $loop->iteration }}</td>
                <td class="px-5 py-3">{{ $mhs->nim }}</td>
                <td class="px-5 py-3">{{ $mhs->name }}</td>
                <td class="px-5 py-3">{{ $mhs->kelas->name ?? '-' }}</td>
                <td class="px-5 py-3">{{ $mhs->tempat_lahir }}</td>
                <td class="px-5 py-3">{{ $mhs->tanggal_lahir }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>