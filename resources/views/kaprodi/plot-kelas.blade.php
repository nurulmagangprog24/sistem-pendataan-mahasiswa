@extends('components.layout')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Plotting Mahasiswa dan Dosen ke Kelas</h2>

    <form action="{{-- route('kelas.storePlot', $kelas->id) --}}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="dosen_id" class="block text-gray-700">Pilih Dosen</label>
            <select id="dosen_id" name="dosen_id" class="w-full px-3 py-2 border rounded-md">
                {{-- @foreach ($dosen as $d)
                <option value="{{ $d->id }}" {{ $kelas->dosen_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach --}}
            </select>
        </div>

        <div class="mb-4">
            <label for="mahasiswa_ids" class="block text-gray-700">Pilih Mahasiswa</label>
            <select id="mahasiswa_ids" name="mahasiswa_ids[]" class="w-full px-3 py-2 border rounded-md" multiple>
                {{-- @foreach ($mahasiswa as $m)
                <option value="{{ $m->id }}" {{ in_array($m->id, $kelas->mahasiswa->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $m->name }}</option>
                @endforeach --}}
            </select>
        </div>

        <button type="submit" class="bg-red-700 text-white py-2 px-4 rounded">Simpan Plotting</button>
    </form>
</div>
@endsection
