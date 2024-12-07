@extends('components.layout')

@section('content')
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-2" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-2" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-700 ">Daftar Mahasiswa</h2>
            @if (Auth::user()->role == 'dosen wali')
            <div x-data="{ createMahasiswaModal: false }" x-cloak>
                <!-- Button untuk membuka modal Tambah Dosen -->
                @if ($kelasDosen && $kelasDosen->mahasiswa->count() >= $kelasDosen->jumlah)
                    <div class="bg-gray-400 text-white py-2 px-4 rounded-md" disabled>
                        Kelas telah mencapai maksimum kapasitas
                    </div>
                @elseif (!$kelasDosen)
                    <div class="bg-gray-400 text-white py-2 px-4 rounded-md" disabled>
                        Maaf, Anda belum memiliki kelas
                    </div>
                @else
                    <button type="button" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:cursor-pointer"
                        @click="createMahasiswaModal = true">
                        Tambah Mahasiswa
                    </button>
                    @include('form.tambah-mahasiswa-modal', [
                        'title' => 'Tambah Mahasiswa',
                        'actionUrl' => route('mahasiswa.store'),
                        'mahasiswa' => null,
                        'kelas' => $kelas,
                        'isEdit' => false,
                    ])
                @endif
            </div>
            @endif
        </div>

        <div class="flex h-full min-w-full flex-col justify-between overflow-hidden rounded-md">
            <table class="min-w-full bg-white leading-normal">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-2 py-1 text-gray-700 text-left">No</th>
                        <th class="px-2 py-1 text-gray-700 text-left">NIM</th>
                        <th class="px-2 py-1 text-gray-700 text-left">Nama</th>
                        <th class="px-2 py-1 text-gray-700 text-left">Kelas</th>
                        <th class="px-2 py-1 text-gray-700 text-left">Tempat Lahir</th>
                        <th class="px-2 py-1 text-gray-700 text-left">Tanggal Lahir</th>
                        <th class="px-2 py-1 text-gray-700 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        <tr>
                            <td class="px-2 py-3">{{ $loop->iteration }}</td>
                            <td class="px-2 py-3">{{ $mhs->nim }}</td>
                            <td class="px-2 py-3">{{ $mhs->name }}</td>
                            <td class="px-2 py-3">{{ $mhs->kelas->name ?? '-' }}</td>
                            <td class="px-2 py-3">{{ $mhs->tempat_lahir }}</td>
                            <td class="px-2 py-3">{{ $mhs->tanggal_lahir }}</td>
                            <td class="px-2 py-3 inline-flex gap-3 items-center justify-center">
                                <div x-data="{ openEditMahasiswaModal: false }" x-cloak>
                                    <!-- Button untuk membuka modal Edit Mahasiswa -->
                                    <button type="button"
                                        class="bg-blue-600 text-white py-2 px-4 rounded-md hover:cursor-pointer"
                                        @click="openEditMahasiswaModal = true">Edit</button>
                                    @include('form.kelola-mahasiswa-modal', [
                                        'title' => 'Edit Mahasiswa',
                                        'actionUrl' => route('mahasiswa.update', $mhs->id),
                                        'mahasiswa' => $mhs,
                                        'kelas' => $kelas,
                                        'isEdit' => true,
                                    ])
                                </div>
                                {{-- <div x-data="{ openDeleteModal: false }" x-cloak>
                                    <button type="button"
                                        class="bg-red-600 text-white py-2 px-4 rounded-md hover:cursor-pointer"
                                        @click="openDeleteModal = true">Hapus</button>
                                    @include('form.hapus-modal', [
                                        'actionUrl' => route('mahasiswa.destroy', $mhs->id),
                                        'modalTitle' => 'Hapus Mahasiswa',
                                        'itemName' => $mhs->name,
                                    ])
                                </div> --}}
                                <div x-data="{ openRemoveModal: false }" x-cloak>
                                    <!-- Button untuk membuka modal Keluarkan Mahasiswa -->
                                    <button type="button"
                                        class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:cursor-pointer"
                                        @click="openRemoveModal = true">
                                        Keluarkan
                                    </button>
                                    @include('form.removeFromClass-modal', [
                                        'actionUrl' => route('mahasiswa.remove', $mhs->id),
                                        'mahasiswaName' => $mhs->name,
                                    ])
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
