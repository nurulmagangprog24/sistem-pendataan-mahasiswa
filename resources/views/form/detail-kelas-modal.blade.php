<div x-show="openDetailModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg ">  
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-700 ">Daftar Mahasiswa Kelas {{ $kelas->name }}</h2>
            <button @click="openDetailModal = false" class="border border-slate-400 rounded px-2">
                <i class="fa-solid fa-x hover:cursor-pointer"></i>
            </button>
        </div>
        <!-- Button untuk membuka modal Tambah Mahasiswa -->
        <div class="min-w-full">
            <button @click="openAddModal = true" class="bg-green-600 text-white py-2 px-4 rounded flex mb-4 hover:underline">Tambah Mahasiswa</button>
            @include('form.plot-mahasiswa-modal', [
                'kelas' => $item,
                'availableMahasiswa' => $availableMahasiswa,
            ])
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