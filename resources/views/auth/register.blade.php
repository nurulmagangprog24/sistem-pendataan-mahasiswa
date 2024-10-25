<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
  <div class="flex items-center justify-center h-screen bg-gray-100">
      <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
          <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
          <form method="POST" action="/register-proses">
              @csrf
               <!-- Role -->
              <div class="mb-4">
                  <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                  <select id="role" name="role" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                      <option value="">Select Role</option>
                      <option value="kaprodi">Kaprodi</option>
                      <option value="dosen">Dosen</option>
                      <option value="mahasiswa">Mahasiswa</option>
                  </select>
                  @error('role')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                  @enderror
              </div>
  
                <!-- Additional Fields for Kaprodi, Dosen, Mahasiswa -->
                <div id="additional-fields" class="hidden">
                  <!-- Kaprodi dan Dosen -->
                  <!-- Kode Dosen -->
                  <div id="kode_dosen_field" class="mb-3 hidden">
                      <label for="kode_dosen" class="block text-sm font-medium text-gray-700">Kode Dosen</label>
                      <input id="kode_dosen" type="text" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="kode_dosen">
                  </div>                               
                  <!-- NIP -->
                  <div id="nip_dosen_field" class="mb-3 hidden">
                      <label for="nip_dosen" class="block text-sm font-medium text-gray-700">NIP</label>
                      <input id="nip_dosen" type="text" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="nip_dosen">
                  </div>
            
                  <!-- Mahasiswa -->
                  <div id="nim_field" class="mb-3 hidden">
                      <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                      <input id="nim" type="text" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="nim">
                  </div>
                  <div class="flex gap-3">
                    <div id="tempat_lahir_field" class="mb-3 hidden">
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input id="tempat_lahir" type="text" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="tempat_lahir">
                    </div>
                    <div id="tanggal_lahir_field" class="mb-3 hidden">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input id="tanggal_lahir" type="date" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="tanggal_lahir">
                    </div>
                  </div>
              </div>
              
              <!-- Name -->
              <div class="mb-3">
                  <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                  <input id="nama" type="text" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="nama" value="{{ old('nama') }}" required autofocus>
                  @error('nama')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                  @enderror
              </div>
  
              <!-- Username -->
              <div class="mb-3">
                  <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                  <input id="username" type="text" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="username" value="{{ old('username') }}" required autofocus>
                  @error('username')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                  @enderror
              </div>
  
              <!-- Email Address -->
              <div class="mb-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input id="email" type="email" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="email" value="{{ old('email') }}" required>
                  @error('email')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                  @enderror
              </div>
  
              <!-- Password -->
              <div class="mb-5">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input id="password" type="password" class="w-full px-2 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" name="password" required>
                  @error('password')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                  @enderror
              </div>
  
              <div class="flex flex-col items-center justify-center gap-y-2">
                <button type="submit" class="w-4/5 rounded-full bg-blue-600 p-2 px-12 text-white">
                  Daftar
                </button>
                <div class="flex items-center gap-x-1 text-sm">
                  Sudah memiliki akun?
                  <div class="cursor-pointer text-blue-700">
                    <a href="/login">Login</a>
                  </div>
                </div>
              </div>
          </form>
      </div>
  </div>
  
  <script>
    document.getElementById('role').addEventListener('change', function () {
      const role = this.value;
  
      // Tampilkan semua field tambahan
      document.getElementById('additional-fields').classList.remove('hidden');
  
      // Akses elemen yang ingin ditampilkan atau disembunyikan
      const kodeDosenField = document.getElementById('kode_dosen_field');
      const nipDosenField = document.getElementById('nip_dosen_field');
      const nimField = document.getElementById('nim_field');
      const tempatLahirField = document.getElementById('tempat_lahir_field');
      const tanggalLahirField = document.getElementById('tanggal_lahir_field');
  
      if (role === 'kaprodi' || role === 'dosen') {
          // Tampilkan field Kode Dosen dan NIP Dosen
          kodeDosenField.classList.remove('hidden');
          nipDosenField.classList.remove('hidden');
  
          // Sembunyikan field NIM (untuk mahasiswa)
          nimField.classList.add('hidden');
          tempatLahirField.classList.add('hidden');
          tanggalLahirField.classList.add('hidden');
      } else if (role === 'mahasiswa') {
          // Tampilkan field NIM, Tempat Lahir, dan Tanggal Lahir
          nimField.classList.remove('hidden');
          tempatLahirField.classList.remove('hidden');
          tanggalLahirField.classList.remove('hidden');
  
          // Sembunyikan field Kode Dosen dan NIP Dosen
          kodeDosenField.classList.add('hidden');
          nipDosenField.classList.add('hidden');
      } else {
          // Jika role tidak terpilih, sembunyikan semua field tambahan
          document.getElementById('additional-fields').classList.add('hidden');
      }
  });
  
  </script>
</body>
</html>