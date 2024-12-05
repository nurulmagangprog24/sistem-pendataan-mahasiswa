<form method="POST" action="{{ route('profile.update') }}" class="p-4 max-w-md mx-auto bg-white rounded-lg shadow-md">
  @csrf
  <div>
      <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
      <input type="text" name="name" id="name" value="{{ $mahasiswa->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
  </div>
  <div>
      <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Place of Birth</label>
      <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
  </div>
  <div>
      <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Date of Birth</label>
      <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
  </div>
  <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 rounded-lg">Save Changes</button>
</form>
