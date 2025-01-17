@extends('components.layout')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Daftar Permintaan Edit Data Mahasiswa</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex h-full min-w-full flex-col justify-between overflow-hidden rounded-lg shadow-lg">
        <table class="min-w-full overflow-scroll bg-white leading-normal">
            <thead>
                <tr>
                    <th class="bg-gray-200 text-gray-700 text-left px-4 py-2">No</th>
                    <th class="bg-gray-200 text-gray-700 text-left px-4 py-2">Nama </th>
                    <th class="bg-gray-200 text-gray-700 text-left px-4 py-2">Kelas</th>
                    <th class="bg-gray-200 text-gray-700 text-left px-4 py-2">Keterangan</th>
                    <th class="bg-gray-200 text-gray-700 text-left px-4 py-2">Tanggal</th>
                    <th class="bg-gray-200 text-gray-700 text-left px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @forelse($requests as $index => $request)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $request->mahasiswa->name }}</td>
                        <td class="px-4 py-2">{{ $request->kelas->name }}</td>
                        <td class="px-4 py-2">{{ $request->keterangan }}</td>
                        <td class="px-4 py-2">{{ $request->created_at->format('d-m-Y H:i') }}</td>
                        <td class="px-4 py-2 inline-flex gap-3">
                            <form action="{{ route('requests.approve', $request->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white py-2 px-3 rounded hover:bg-green-600">
                                    Setujui
                                </button>
                            </form>
                            <form action="{{ route('requests.reject', $request->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">Tidak ada permintaan edit</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

