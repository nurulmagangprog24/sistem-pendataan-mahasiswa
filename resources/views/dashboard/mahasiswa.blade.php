@extends('components.layout')

@section('content')
    {{-- <div class="container mx-auto px-5"> --}}
    {{-- <h1 class="text-3xl font-bold text-gray-700 mb-6">Dashboard</h1> --}}
    <div class="grid grid-cols-3 gap-6 m-8">
        <!-- Mahasiswa Widgets -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-700">Profil Saya</h2>
            <p class="text-gray-600">{{ Auth::user()->username }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-700">Permintaan Perubahan Data</h2>
            <p class="text-gray-600">{{ $status }}</p>
        </div>
    </div>
    </div>
@endsection
