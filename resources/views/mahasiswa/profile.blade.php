@extends('components.layout')

{{-- @section('content')
<div class="max-w-lg mx-auto bg-white shadow-md p-5">
    <h2 class="text-2xl font-semibold text-gray-700 ">Profil Pengguna</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Profile Picture -->
        <div class="mb-4 text-center">
            <img src="{{ asset('images/profile-placeholder.png') }}" alt="Foto Profil" class="w-32 h-32 rounded-full mx-auto mb-4">
            <label class="block">
                <input type="file" name="profile_picture" class="hidden">
                <span class="bg-blue-500 text-white px-4 py-2 rounded-md cursor-pointer">Pilih Foto</span>
            </label>
            <p class="text-sm text-gray-500 mt-2">Gambar Profil Anda sebaiknya memiliki rasio 1:1 dan berukuran tidak lebih dari 2MB.</p>
        </div>

        <!-- Nama Lengkap -->
        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-1">Nama Lengkap *</label>
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-1">Username *</label>
            <input type="text" name="username" placeholder="Username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email (Disabled) -->
        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" disabled class="w-full px-4 py-2 border rounded-md bg-gray-100 text-gray-500">
            <p class="text-sm text-gray-500 mt-1">Anda dapat mengubah alamat email melalui menu Akun.</p>
        </div>

        <!-- Headline -->
        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-1">Headline</label>
            <input type="text" name="headline" placeholder="Contoh: Product Engineer at Dicoding Indonesia" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-sm text-gray-500 mt-1">Dapat diisi dengan title atau jabatan utama Anda.</p>
        </div>

        <!-- Tentang Saya -->
        <div class="mb-4">
            <label class="block text-gray-600 font-medium mb-1">Tentang Saya</label>
            <textarea name="tentang_saya" placeholder="Tuliskan cerita singkat tentang diri Anda." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <!-- Tombol Simpan Perubahan -->
        <button type="submit" class="w-full bg-blue-500 text-white font-medium py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan Perubahan</button>
    </form>
</div>
@endsection --}}

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-8 mt-10">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Profil Pengguna</h2>

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

    <div x-data="{ open: false }">
    <button type="button" class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md" @click="open = true" <!--onclick="openModal('requestEdit') -->">
        Request Edit ke Dosen
    </button>
    
    @include('form.request-edit', [
        'modalId' => 'requestEdit',
        'title' => 'Request Edit Data',
        'actionUrl' => route('request.store'),
        'kelas' => $kelas,
        'isEdit' => false
    ])
    

  </form>
</div>
@endsection
