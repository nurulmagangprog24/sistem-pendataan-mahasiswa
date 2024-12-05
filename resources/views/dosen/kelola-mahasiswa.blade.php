@extends('components.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-6 ">Daftar Mahasiswa</h2>
    <div x-data="{ createMahasiswaModal : false}" x-cloak class="mb-4">
        <!-- Button untuk membuka modal Tambah Dosen -->
        <button type="button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:underline" @click="createMahasiswaModal = true">
            Tambah Mahasiswa
        </button>
            @include('form.tambah-mahasiswa-modal', [
                'title' => 'Tambah Mahasiswa',
                'actionUrl' => route('mahasiswa.store'),
                'mahasiswa' => null,
                'kelas' => $kelas,
                'isEdit' => false
            ])
    </div>

    <div class="flex h-full min-w-full flex-col justify-between overflow-hidden rounded-lg shadow-lg">
        <table class="min-w-full overflow-scroll bg-white leading-normal">
        <thead>
            <tr>
                <th class="px-3 py-1 bg-gray-200 text-gray-700 text-left">No</th>
                <th class="px-3 py-1 bg-gray-200 text-gray-700 text-left">NIM</th>
                <th class="px-3 py-1 bg-gray-200 text-gray-700 text-left">Nama</th>
                <th class="px-3 py-1 bg-gray-200 text-gray-700 text-left">Kelas</th>
                <th class="px-3 py-1 bg-gray-200 text-gray-700 text-left">Tempat Lahir</th>
                <th class="px-3 py-1 bg-gray-200 text-gray-700 text-left">Tanggal Lahir</th>
                <th class="px-3 py-1 bg-gray-200 text-gray-700 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
            <tr>
                <td class="px-3 py-1">{{ $loop->iteration }}</td>
                <td class="px-3 py-1">{{ $mhs->nim }}</td>
                <td class="px-3 py-1">{{ $mhs->name }}</td>
                <td class="px-3 py-1">{{ $mhs->kelas->name ?? '-' }}</td>
                <td class="px-3 py-1">{{ $mhs->tempat_lahir }}</td>
                <td class="px-3 py-1">{{ $mhs->tanggal_lahir }}</td>
                <td class="px-3 py-1">
                    <button type="button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:underline" onclick="openModal('editMahasiswa_{{ $mhs->id }}')">Edit</button>
                    @include('form.kelola-mahasiswa-modal', [
                        'modalId' => 'editMahasiswa_' . $mhs->id,
                        'title' => 'Edit Mahasiswa',
                        'actionUrl' => route('mahasiswa.update', $mhs->id),
                        'mahasiswa' => $mhs,
                        'kelas' => $kelas,
                        'isEdit' => true
                    ])
                    <div x-data="{ openDeleteModal : false}" class="mb-4">
                        <!-- Button untuk membuka modal Tambah Kelas -->
                        <button type="button" class="bg-red-600 text-white py-2 px-4 rounded-md" @click="openDeleteModal = true">Hapus</button>
                            @include('form.hapus-modal', [
                                'actionUrl' => route('mahasiswa.destroy', $mhs->id),
                                'modalTitle' => 'Hapus Mahasiswa',
                                'itemName' => $mhs->name,
                         ])
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection