@extends('components.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-3xl font-bold text-gray-700 ml-3">Dashboard</h2>
    <div class="mt-6 p-2 grid grid-cols-3 gap-3 md:grid-cols-3 md:p-4 overflow-hidden">
    {{-- <div class="grid grid-cols-3 gap-6 m-8"> --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Mahasiswa di Bimbingan</h2>
                <p class="text-gray-600">{{ $jumlahMahasiswa }} Mahasiswa</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Permintaan Perubahan Data</h2>
                <p class="text-gray-600">{{ $jumlahPermintaan }} Permintaan Edit</p>
            </div>
    </div>
</div>
@endsection
