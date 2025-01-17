@extends('components.layout')

@section('content')
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded" role="alert">
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
    <div class="w-full xl h-screen grid grid-cols gap-5 px-4 lg:px-8 lg:grid-cols-2">
        <div class="max-h-fit col-span bg-slate-300 shadow-md rounded-lg p-4 lg:p-8 lg:col-span-1">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Profil Pengguna</h2>


            <div class="mb-4">
                <label class="block text-gray-600 font-medium mb-1">Nama</label>
                <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $user->username }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-600 font-medium mb-1">Email</label>
                <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $user->email }}</p>
            </div>

            @if (Auth::user()->role === 'kaprodi' || Auth::user()->role === 'dosen wali')
                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-1">NIP</label>
                    <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $kaprodi->nip ?? $dosen->nip }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-1">Kode dosen</label>
                    <p class="w-full px-4 py-2 border rounded-md bg-gray-100">
                        {{ $kaprodi->kode_dosen ?? $dosen->kode_dosen }}</p>
                </div>
                <div x-data="{ openEditModal: false }" x-cloak>
                    <button type="button"
                        class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-md"
                        @click="openEditModal = true">
                        Edit Data
                    </button>
                    @include('form.edit-data-modal')
                </div>
            @elseif(Auth::user()->role === 'mahasiswa')
                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-1">NIM</label>
                    <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $mahasiswa->nim }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-1">Tempat Lahir</label>
                    <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $mahasiswa->tempat_lahir }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-1">Tanggal Lahir</label>
                    <p class="w-full px-4 py-2 border rounded-md bg-gray-100">{{ $mahasiswa->tanggal_lahir }}</p>
                </div>

                @if ($mahasiswa->edit)
                    <div x-data="{ openEditModal: false }">
                        <button type="button"
                            class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-md"
                            @click="openEditModal = true">
                            Edit Data
                        </button>
                        @include('form.edit-data-modal', ['mahasiswa' => $mahasiswa])
                    </div>
                @elseif($mahasiswa->kelas)
                    <div x-data="{ openRequestModal: false }">
                        <button type="button"
                            class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md"
                            @click="openRequestModal = true">
                            Request Edit ke Dosen
                        </button>
                        @include('form.request-edit', [
                            'modalId' => 'requestEdit',
                            'title' => 'Request Edit Data',
                            'actionUrl' => route('request.store'),
                            'kelas' => $kelas,
                            'isEdit' => false,
                        ])
                    </div>
                    @else
                <div class="mt-6 w-full bg-yellow-500 text-white font-semibold py-2 rounded-md text-center">
                        Anda Belum terdaftar di kelas.
                    </div>
                @endif
            @endif
        </div>
        <div class="max-h-fit col-span bg-slate-300 shadow-md rounded-lg p-4 lg:p-8 lg:col-span-1">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Reset Password</h2>

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Current Password
                    </label>
                    <input type="password" name="current_password"
                        class="w-full px-4 py-2 rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Your current password" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" name="new_password"
                        class="w-full px-4 py-2 rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="New password" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Confirm New Password
                    </label>
                    <input type="password" name="new_password_confirmation"
                        class="w-full px-4 py-2 rounded-md bg-gray-100 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Confirm new password" />
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
@endsection