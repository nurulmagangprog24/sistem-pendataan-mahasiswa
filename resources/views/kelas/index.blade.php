<!-- resources/views/kelas/index.blade.php -->
@extends('components.layout')

@section('content')
<div class="container">
    <h1>Daftar Kelas</h1>
    <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Jumlah</th>
                {{-- <th>Dosen</th>
                <th>Mahasiswa</th>
                <th>Aksi</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->jumlah }}</td>
                    {{-- <td>
                        @foreach ($item->dosen as $d)
                            {{ $d->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->mahasiswa as $m)
                            {{ $m->name }}<br>
                        @endforeach
                    </td> --}}
                    <td>
                        <a href="{{ route('kelas.edit', $item->id) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form> |
                        <a href="{{ route('kelas.edit', $item->id) }}" class="text-green-500">Plotting</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
