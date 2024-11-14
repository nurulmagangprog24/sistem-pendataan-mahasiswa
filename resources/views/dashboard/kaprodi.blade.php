@extends('components.layout')

@section('content')
{{-- <div class="container mx-auto px-5"> --}}
    {{-- <h1 class="text-3xl font-bold text-gray-700 mb-6">Dashboard</h1> --}}
    <div class="grid grid-cols-3 gap-6 m-8">
            <!-- Kaprodi Widgets -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Jumlah Dosen</h2>
                <p class="text-gray-600">{{ $jumlahDosen }} Dosen</p>
                <a href="/kelola-dosen" class="block mt-4 text-blue-500 hover:underline">Lihat Detail</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Jumlah Kelas</h2>
                <p class="text-gray-600">{{ $jumlahKelas }} Kelas</p>
                <a href="/kelola-dosen" class="block mt-4 text-blue-500 hover:underline">Lihat Detail</a>
            </div>
    </div>
</div>
@endsection
