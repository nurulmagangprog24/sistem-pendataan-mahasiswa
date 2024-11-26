@extends('components.layout')

@section('content')
<div class="w-full h-screen overflow-y-auto ">
    <div class="max-w-lg mx-auto bg-slate-300 shadow-md rounded-lg p-8 mt-10">
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
    </div>
    <div class="max-w-lg mx-auto bg-slate-300 shadow-md rounded-lg p-8 mt-10">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Reset Password</h2>
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Current Password
                </label>
                <input type="password" name="current_password" class="w-full px-4 py-2 rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Your current password"/>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="new_password" class="w-full px-4 py-2 rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="New password"/>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Confirm New Password
                </label>
                <input type="password" name="new_password_confirmation" class="w-full px-4 py-2 rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Confirm new password"/>
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
                Reset Password
            </button>
        </form>
    </div>    
</div>
@endsection
