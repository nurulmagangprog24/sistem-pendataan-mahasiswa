<!-- resources/views/kelas/create.blade.php -->
@extends('components.layout')

@section('content')
<div class="container">
    <h1>Tambah Kelas</h1>
    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <label for="name">Nama Kelas:</label>
        <input type="text" name="name" id="name" class="border border-gray-400 p-2 rounded">
        
        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" class="border border-gray-400 p-2 rounded">

        <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-2">Tambah Kelas</button>
    </form>
</div>
@endsection
