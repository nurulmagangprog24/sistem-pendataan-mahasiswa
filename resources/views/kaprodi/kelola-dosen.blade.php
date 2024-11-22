@extends('components.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-6 ">Daftar Dosen</h2>
    <div x-data="{ createDosenModal : false}" x-cloak class="mb-4">
        <!-- Button untuk membuka modal Tambah Dosen -->
        <button type="button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:underline" @click="createDosenModal = true">
            Tambah Dosen
        </button>
            @include('form.tambah-dosen-modal', [
                'title' => 'Tambah Dosen',
                'actionUrl' => route('dosen.store'),
                'dosen' => null,
                'kelas' => $kelas,
                'isEdit' => false
            ])
    </div>

    <div class="flex h-full min-w-full flex-col justify-between overflow-hidden rounded-lg shadow-lg">
        <table class="min-w-full overflow-scroll bg-white leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">No</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Kode Dosen</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">NIP</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Nama</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Kelas</th>
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $dsn)
            <tr>
                <td class="px-5 py-3">{{ $loop->iteration }}</td>
                <td class="px-5 py-3">{{ $dsn->kode_dosen }}</td>
                <td class="px-5 py-3">{{ $dsn->nip }}</td>
                <td class="px-5 py-3">{{ $dsn->name }}</td>
                <td class="px-5 py-3">{{ $dsn->kelas->name ?? '-' }}</td>
                <td class="px-5 py-3">
                    <div x-data="{ editDosenModal : false }" x-cloak class="mb-4">
                    <button type="button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:underline" @click="editDosenModal = true">Edit</button>
                    @include('form.edit-dosen-modal', [
                        'title' => 'Edit Dosen',
                        'actionUrl' => route('dosen.update', $dsn->id),
                        'dosen' => $dsn,
                        'kelas' => $kelas,
                        'isEdit' => true
                    ])
                    <div x-data="{ openDeleteModal : false}" x-cloak class="mb-4">
                        <!-- Button untuk membuka modal Tambah Kelas -->
                        <button type="button" class="bg-red-600 text-white py-2 px-4 rounded-md hover:underline" @click="openDeleteModal = true">Hapus</button>
                            @include('form.hapus-modal', [
                            'actionUrl' => route('dosen.destroy', $dsn->id),
                            'modalTitle' => 'Hapus Dosen',
                            'itemName' => $dsn->name,
                            'kelas' => $kelas,
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