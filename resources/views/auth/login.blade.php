<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Pendataan Mahasiswa</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="password" required>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" name="remember">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember Me</label>
                </div>

                <div class="flex flex-col items-center justify-center gap-y-2">
                    <button type="submit" class="w-full rounded-md bg-blue-600 p-2 px-12 text-white">
                        <a href="">Masuk</a>
                    </button>
                    <div class="flex items-center gap-x-1 text-sm">
                        Belum memiliki akun?
                        <div class="cursor-pointer text-blue-700">
                            <a href="/register">Daftar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
