@extends('components.layout')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-8 mt-10">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Profil Pengguna</h2>

    <!-- Flash Message Jika Request Ditolak -->
    @if(session('request_rejected'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            {{ session('request_rejected') }}
        </div>
    @endif

    <!-- Profile Picture -->
    {{-- <div class="mb-4 text-center">
        <img src="{{ asset('images/profile-placeholder.png') }}" alt="Foto Profil" class="w-32 h-32 rounded-full mx-auto mb-4">
        <p class="text-sm text-gray-500 mt-2">Gambar Profil Anda sebaiknya memiliki rasio 1:1 dan berukuran tidak lebih dari 2MB.</p>
    </div> --}}

    <!-- Nama Lengkap -->
    <div class="mb-4">
        <label class="block text-gray-600 font-medium mb-1">Nama Lengkap</label>
        <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $mahasiswa->name }}</p>
    </div>

    <!-- NIM -->
    <div class="mb-4">
        <label class="block text-gray-600 font-medium mb-1">NIM</label>
        <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $mahasiswa->nim }}</p>
    </div>

    <!-- Tempat Lahir -->
    <div class="mb-4">
        <label class="block text-gray-600 font-medium mb-1">Tempat Lahir</label>
        <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $mahasiswa->tempat_lahir }}</p>
    </div>

    <!-- Tanggal Lahir -->
    <div class="mb-4">
        <label class="block text-gray-600 font-medium mb-1">Tanggal Lahir</label>
        <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $mahasiswa->tanggal_lahir }}</p>
    </div>

    @if ($mahasiswa->edit)
        <div x-data="{ openEditModal: false }">
            <button type="button" class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-md" @click="openEditModal = true">
                Edit Data
            </button>
            @include('form.edit-data-modal', [
                'mahasiswa' => $mahasiswa
            ])
    </div>
    @else
        <!-- If student is not allowed to edit, show the "Request Edit" button -->
        <div x-data="{ openRequestModal: false }">
            <button type="button" class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md" @click="openRequestModal = true">
                Request Edit ke Dosen
            </button> 
            @include('form.request-edit', [
                'modalId' => 'requestEdit',
                'title' => 'Request Edit Data',
                'actionUrl' => route('request.store'),
                'kelas' => $kelas,
                'isEdit' => false
            ])
        </div>
    @endif
  </form>
</div>
@endsection
