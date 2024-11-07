@extends('components.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-6 ">Daftar Dosen</h2>
    <div class="mb-4">
        <!-- Button untuk membuka modal Tambah Dosen -->
        <button class="bg-blue-600 text-white py-2 px-4 rounded" onclick="openModal('createDosenModal')">Tambah Dosen</button>
        @include('form.tambah-dosen-modal', [
            'modalId' => 'createDosenModal',
            'title' => 'Tambah Dosen',
            'actionUrl' => route('dosen.store'),
            'dosen' => null,
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
                {{-- <td class="px-5 py-3">{{ $dsn->kelas->name }}</td> --}}
                <td class="px-5 py-3">
                    <a href="{{-- route('kaprodi.dosen.edit', $d->id) --}}" class="px-5 py-2 rounded-md bg-blue-600 text-white hover:underline">Edit</a>
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