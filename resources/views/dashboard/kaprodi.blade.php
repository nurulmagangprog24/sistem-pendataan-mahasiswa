@extends('components.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-3xl font-bold text-gray-700 ml-3">Dashboard</h2>
    <div class="mt-6 p-2 grid grid-cols-2 gap-3 md:grid-cols-3 md:p-4 overflow-hidden">
            <!-- Kaprodi Widgets -->
            <div class="h-15 bg-slate-300 aspect-video p-4 rounded-lg shadow-md md:aspect-auto ">
                <h2 class="text-xl font-semibold text-gray-700">Jumlah Dosen</h2>
                <p class="text-gray-600">{{ $jumlahDosen }} Dosen</p>
                <a href="{{ route('kelola-dosen') }}" class="block mt-4 text-blue-500 hover:underline">Lihat Detail</a>
            </div>
            <div class="h-15 bg-slate-300 aspect-video p-4 rounded-lg shadow-md md:aspect-auto ">
                <h2 class="text-xl font-semibold text-gray-700">Jumlah Kelas</h2>
                <p class="text-gray-600">{{ $jumlahKelas }} Kelas</p>
                <a href="{{ route('kelola-kelas') }}" class="block mt-4 text-blue-500 hover:underline">Lihat Detail</a>
            </div>
    </div>
</div>
@endsection
