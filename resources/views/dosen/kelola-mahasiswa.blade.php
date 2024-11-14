@extends('components.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-6 ">Daftar Mahasiswa</h2>
    <div class="mb-4">
        <!-- Button untuk membuka modal Tambah Mahasiswa -->
        <button class="bg-blue-600 text-white py-2 px-4 rounded">Tambah Mahasiswa</button>
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
                <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Aksi</th>
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
                <td class="px-5 py-3">
                    <button type="button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:underline" onclick="openModal('editMahasiswa_{{ $mhs->id }}')">Edit</button>
                    @include('form.kelola-mahasiswa-modal', [
                        'modalId' => 'editMahasiswa_' . $mhs->id,
                        'title' => 'Edit Mahasiswa',
                        'actionUrl' => route('mahasiswa.update', $mhs->id),
                        'mahasiswa' => $mhs,
                        'kelas' => $kelas,
                        'isEdit' => true
                    ])
                    <form action="{{-- route('kaprodi.dosen.destroy', $d->id) --}}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1.5 rounded bg-red-500 text-white hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection