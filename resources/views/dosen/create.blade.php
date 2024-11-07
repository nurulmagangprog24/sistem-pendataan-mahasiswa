<!-- resources/views/dosen/create.blade.php -->
@extends('components.layout')

@section('content')
<div class="container">
    <h1>Tambah Dosen</h1>
    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf

        <label for="name">Nama Dosen:</label>
        <input type="text" name="name" id="name" class="border border-gray-400 p-2 rounded w-full" required>

        <label for="kode_dosen" class="mt-2">Kode Dosen:</label>
        <input type="number" name="kode_dosen" id="kode_dosen" class="border border-gray-400 p-2 rounded w-full" required>

        <label for="nip" class="mt-2">NIP:</label>
        <input type="number" name="nip" id="nip" class="border border-gray-400 p-2 rounded w-full" required>

        <label for="kelas_id" class="mt-2">Kelas:</label>
        <select name="kelas_id" id="kelas_id" class="border border-gray-400 p-2 rounded w-full">
            <option value="">Pilih Kelas</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-4">Tambah Dosen</button>
    </form>
</div>
@endsection
