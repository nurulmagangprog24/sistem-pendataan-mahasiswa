@extends('components.layout')

@section('content')
    <div class="container mx-auto p-4 ">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-700">Daftar Dosen</h2>
            <div x-data="{ createDosenModal: false }" x-cloak>
                <!-- Button untuk membuka modal Tambah Dosen -->
                <button type="button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:cursor-pointer"
                    x-on:click="createDosenModal = !createDosenModal">
                    Tambah Dosen
                </button>
                @include('form.tambah-dosen-modal', [
                    'title' => 'Tambah Dosen',
                    'actionUrl' => route('dosen.store'),
                    'dosen' => null,
                    'kelas' => $kelas,
                    'isEdit' => false,
                ])
            </div>
        </div>

        <div class="flex min-w-full flex-col justify-between rounded-md overflow-hidden">
            <table class="min-w-full bg-white leading-normal">
                <thead class="bg-gray-200 text-center">
                    <tr>
                        <th class=" py-3 text-gray-700">No</th>
                        <th class=" py-3 text-gray-700">Kode Dosen</th>
                        <th class=" py-3 text-gray-700">NIP</th>
                        <th class=" py-3 text-gray-700">Nama</th>
                        <th class=" py-3 text-gray-700">Kelas</th>
                        <th class=" py-3 text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosen as $dsn)
                        <tr class="text-center px-2 py-3">
                            <td class=" py-3 ">{{ $loop->iteration }}</td>
                            <td class=" py-3 ">{{ $dsn->kode_dosen }}</td>
                            <td class=" py-3 ">{{ $dsn->nip }}</td>
                            <td class=" py-3 ">{{ $dsn->name }}</td>
                            <td class=" py-3 ">{{ $dsn->kelas->name ?? '-' }}</td>
                            <td class=" py-3 inline-flex gap-3">
                                <div x-data="{ editDosenModal: false }" x-cloak">
                                    <button type="button"
                                        class="bg-blue-600 text-white py-2 px-4 rounded-md hover:cursor-pointer"
                                        @click="editDosenModal = true">Edit</button>
                                    @include('form.edit-dosen-modal', [
                                        'title' => 'Edit Dosen',
                                        'actionUrl' => route('dosen.update', $dsn->id),
                                        'dosen' => $dsn,
                                        'kelas' => $kelas,
                                        'isEdit' => true,
                                    ])
                                </div>
                                <div x-data="{ openDeleteModal: false }" x-cloak">
                                    <!-- Button untuk membuka modal Tambah Kelas -->
                                    <button type="button"
                                        class="bg-red-600 text-white py-2 px-4 rounded-md hover:cursor-pointer"
                                        @click="openDeleteModal = true">Hapus</button>
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
