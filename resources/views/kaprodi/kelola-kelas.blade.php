@extends('components.layout')

@section('content')
@if (session('success'))
<div class="bg-green-500 text-white p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-700">Daftar Kelas</h2>
            <div x-data="{ openCreateModal : false}" x-cloak class="">
                <!-- Button untuk membuka modal Tambah Kelas -->
                <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:underline" @click="openCreateModal = true">Buat Kelas</button>
                @include('form.tambah-kelas-modal', [
                'title' => 'Tambah Kelas',
                'dosen' => $dosen,
                'kelas' => null,
                'isEdit' => false
            ])
            </div>
        </div>

        <!-- Tabel Kelas -->
        <div class="flex h-full min-w-full flex-col justify-between overflow-x-auto shadow-lg px-4">
            <table class="min-w-full overflow-scroll bg-white leading-normal rounded-t-md">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border ">No</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border ">Nama Kelas</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border ">Dosen Wali</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border ">Kapasitas Kelas</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border ">Jumlah Mahasiswa</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border ">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelas as $item)
                    <tr class="gap-y-1">
                        <td class="px-2 py-1 text-center border ">{{ $loop->iteration }}</td>
                        <td class="px-2 py-1 text-center border ">{{ $item->name }}</td>
                        <td class="px-2 py-1 text-center border ">{{ $item->dosen->name ?? 'Belum Ditentukan' }}</td>
                        <td class="px-2 py-1 text-center border ">{{ $item->jumlah }}</td>
                        <td class="px-2 py-1 text-center border ">{{ $item->mahasiswa_count }}</td>
                        <td class="px-2 py-1 text-center border space-y-2">
                            <div x-data="{ openDetailModal: false, openAddModal: false}" x-cloak>
                                <button type="button" @click="openDetailModal = true" class="px-3 py-1 rounded-md mb-2 bg-yellow-600 text-white hover:underline">Detail</button>
                                @include('form.detail-kelas-modal', [
                                    'mahasiswa' => $mahasiswa[$item->id] ?? [],
                                    'kelas' => $item,
                                    'availableMahasiswa' => $availableMahasiswa,
                                ])
                            </div>
                            <div x-data="{ openCreateModal : false}" x-cloak>
                                <!-- Button untuk membuka modal Tambah Kelas -->
                                 <button class="bg-blue-600 text-white py-1 px-3 rounded-md hover:underline" @click="openCreateModal = true">Edit</button>
                                 @include('form.tambah-kelas-modal', [
                                     'title' => 'Tambah Kelas',
                                     'dosen' => $dosen,
                                     'kelas' => $item,
                                     'isEdit' => true
                                 ])
                             </div>
                            <div x-data="{ openDeleteModal : false}" x-cloak class="mb-4">
                                <!-- Button untuk membuka modal Tambah Kelas -->
                                <button type="button" class="bg-red-600 text-white py-1 px-3 rounded-md hover:underline" @click="openDeleteModal = true">Hapus</button>
                                    @include('form.hapus-modal', [
                                        'actionUrl' => route('kelas.destroy', $item->id),
                                        'modalTitle' => 'Hapus Kelas',
                                        'itemName' => $item->name,
                                 ])
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
