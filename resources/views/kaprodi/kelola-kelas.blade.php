@extends('components.layout')

@section('content')
    @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
    {{-- @elseif ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ $error }}
        </div> --}}
    @endif
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-2xl font-bold text-gray-700">Daftar Kelas</h2>
            <div x-data="{ openCreateModal : false}" x-cloak >
                <!-- Button untuk membuka modal Tambah Kelas -->
                <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:cursor-pointer" @click="openCreateModal = true">Buat Kelas</button>
                @include('form.tambah-kelas-modal', [
                'title' => 'Tambah Kelas',
                'dosen' => $dosen,
                'kelas' => null,
                'isEdit' => false
            ])
            </div>
        </div>

        <div class="flex max-w flex-col justify-between rounded-md overflow-hidden mx-4">
            <table class="max-w bg-white leading-normal">
                <thead class="bg-gray-200 text-center">
                    <tr>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border w-1/12">No</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border w-1/6 ">Nama Kelas</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border w-1/6 ">Dosen Wali</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border w-1/8 ">Kapasitas Kelas</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border w-1/8 ">Jumlah Mahasiswa</th>
                        <th class="px-2 py-2 text-gray-700 text-center whitespace-normal break-words border w-1/4">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($kelas as $item)
                    <tr class="gap-y-1">
                        <td class="px-2 py-1 text-center">{{ $loop->iteration }}</td>
                        <td class="px-2 py-1 text-center truncate max-w-xs">{{ $item->name }}</td>
                        <td class="px-2 py-1 text-center truncate max-w-xs">{{ $item->dosen->name ?? 'Belum Ditentukan' }}</td>
                        <td class="px-2 py-1 text-center">{{ $item->jumlah }}</td>
                        <td class="px-2 py-1 text-center">{{ $item->mahasiswa_count }}</td>
                        <td class="px-2 py-1 text-center inline-flex space-x-2 justify-center">
                            <div x-data="{ openDetailModal: false, openAddModal: false }" x-cloak class="flex space-x-2">
                                <button type="button" @click="openDetailModal = true" class="bg-yellow-600 text-white py-1 px-3 rounded-md hover:cursor-pointer">Detail</button>
                                @include('form.detail-kelas-modal', [
                                    'mahasiswa' => $mahasiswa[$item->id] ?? [],
                                    'kelas' => $item,
                                    'availableMahasiswa' => $availableMahasiswa,
                                ])
                            </div>
                            <div x-data="{ openCreateModal : false}" x-cloak class="flex space-x-2">
                                <!-- Button untuk membuka modal Tambah Kelas -->
                                 <button type="button" @click="openCreateModal = true" class="bg-blue-600 text-white py-1 px-3 rounded-md hover:cursor-pointer">Edit</button>
                                 @include('form.tambah-kelas-modal', [
                                     'title' => 'Tambah Kelas',
                                     'dosen' => $dosen,
                                     'kelas' => $item,
                                     'isEdit' => true
                                 ])
                            </div>
                            <div x-data="{ openDeleteModal : false}" x-cloak class="flex space-x-2">
                                <!-- Button untuk membuka modal Tambah Kelas -->
                                <button type="button" @click="openDeleteModal = true" class="bg-red-600 text-white py-1 px-3 rounded-md hover:cursor-pointer">Hapus</button>
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