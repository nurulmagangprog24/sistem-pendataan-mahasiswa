@extends('components.layout')

@section('content')
<div class="container m-3 px-5">
    <h2 class="text-3xl font-bold text-gray-700 mb-6">Dashboard</h2>
    <div class="grid grid-cols-5 sm:grid-cols-3 md:grid-cols-2 gap-6">
            <!-- Kaprodi Widgets -->
            <div class="bg-slate-300 p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Jumlah Dosen</h2>
                <p class="text-gray-600">{{ $jumlahDosen }} Dosen</p>
                <a href="/kelola-dosen" class="block mt-4 text-blue-500 hover:underline">Lihat Detail</a>
            </div>
            <div class="bg-slate-300 p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Jumlah Kelas</h2>
                <p class="text-gray-600">{{ $jumlahKelas }} Kelas</p>
                <a href="/kelola-dosen" class="block mt-4 text-blue-500 hover:underline">Lihat Detail</a>
            </div>
    </div>
</div>
@endsection
