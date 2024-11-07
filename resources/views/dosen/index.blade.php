<!-- resources/views/dosen/index.blade.php -->
@extends('components.layout')

@section('content')
<div class="container">
    <h1>Daftar Dosen</h1>
    <a href="{{ route('dosen.create') }}" class="btn btn-primary">Tambah Dosen</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kode Dosen</th>
                <th>NIP</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->kode_dosen }}</td>
                    <td>{{ $item->nip }}</td>
                    {{-- <td>{{ $item->kelas->name }}</td> --}}
                    <td>
                        <a href="{{ route('dosen.edit', $item->id) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('dosen.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
