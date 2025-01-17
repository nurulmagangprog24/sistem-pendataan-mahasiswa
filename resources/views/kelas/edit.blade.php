<!-- resources/views/kelas/edit.blade.php -->
@extends('components.layout')

@section('content')
<div class="container">
    <h1>Edit Kelas</h1>
    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nama Kelas:</label>
        <input type="text" name="name" id="name" value="{{ $kelas->name }}" class="border border-gray-400 p-2 rounded">

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" value="{{ $kelas->jumlah }}" class="border border-gray-400 p-2 rounded">

        <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-2">Simpan Perubahan</button>
    </form>

    <h2 class="mt-4">Plotting Dosen dan Mahasiswa ke Kelas</h2>
    <form action="{{ route('kelas.plot', $kelas->id) }}" method="POST">
        @csrf
        <div class="mt-4">
            <label for="dosen_ids">Pilih Dosen:</label>
            <select name="dosen_ids[]" id="dosen_ids" multiple class="border border-gray-400 p-2 rounded w-full">
                @foreach ($dosen as $d)
                    <option value="{{ $d->id }}" @if($kelas->dosen->contains($d->id)) selected @endif>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label for="mahasiswa_ids">Pilih Mahasiswa:</label>
            <select name="mahasiswa_ids[]" id="mahasiswa_ids" multiple class="border border-gray-400 p-2 rounded w-full">
                @foreach ($mahasiswa as $m)
                    <option value="{{ $m->id }}" @if($kelas->mahasiswa->contains($m->id)) selected @endif>{{ $m->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white p-2 rounded mt-4">Perbarui Plotting</button>
    </form>
</div>
@endsection
