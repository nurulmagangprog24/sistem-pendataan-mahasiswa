@extends('components.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Daftar Kelas</h2>
    <div class="mb-4">
        <a href="{{-- route('kaprodi.kelas.create') --}}" class="bg-blue-600 text-white px-4 py-2 rounded-md">
            Tambah Kelas
        </a>
    </div>

    <!-- Tabel Kelas -->
    <div class="flex h-full min-w-full flex-col justify-between overflow-hidden rounded-lg shadow-lg">
        <table class="min-w-full overflow-scroll bg-white leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">No</th>
                    <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Nama Kelas</th>
                    <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Jumlah Mahasiswa</th>
                    <th class="px-5 py-3 bg-gray-200 text-gray-700 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($kelas as $k) --}}
                <tr>
                    <td class="px-5 py-3">{{-- $index + 1 --}}</td>
                    <td class="px-5 py-3">{{-- $k->name --}}</td>
                    <td class="px-5 py-3">{{-- $k->jumlah }} / 10 --}}</td>
                    <td class="px-5 py-3">
                        <a href="{{-- route('kaprodi.kelas.edit', $k->id) --}}" class="px-5 py-2 rounded-md bg-blue-600 text-white hover:underline">Edit</a>
                        <form action="{{-- route('kaprodi.kelas.destroy', $k->id) --}}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 rounded bg-red-500 text-white hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
