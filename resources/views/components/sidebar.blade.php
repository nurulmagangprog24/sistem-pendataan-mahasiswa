<div x-data="{ open: false }" class="bg-blue-800 shadow-md min-h-full">
    <div class="container flex justify-between items-center p-4">
        <button @click="open = !open" class="sm:hidden text-white">
            <div class="w-6 h-6 relative">
                <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </button>
        <aside class="hidden sm:flex">
            <div class="flex flex-col h-full items-center">
                <div class="flex items-center my-3">
                    <div class="shrink-0">
                        <img class="size-10 rounded-full"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base/5 font-medium text-white">{{ Auth::user()->username }}</div>
                        <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <nav class="mt-4 w-full">
                    <ul>
                        <li class="mb-4">
                            <a href="/dashboard"
                                class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                                Dashboard
                            </a>
                        </li>
                        @if (Auth::user()->role == 'kaprodi')
                            <li class="mb-4">
                                <a href="{{ route('kelola-dosen') }}"
                                    class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                                    Kelola Dosen
                                </a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('kelola-kelas') }}"
                                    class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                                    Kelola Kelas
                                </a>
                            </li>
                            {{-- <li class="mb-4">
                <a href="{{ route('kelola-mahasiswa') }}" class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                  Kelola Mahasiswa
                </a> 
              </li> --}}
                        @elseif(Auth::user()->role == 'dosen wali')
                            <li class="mb-4">
                                <a href="{{ route('mahasiswa-kelas') }}"
                                    class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                                    Kelola Mahasiswa
                                </a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('requests-list') }}"
                                    class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                                    Permintaan Perubahan Data
                                </a>
                            </li>
                        @elseif(Auth::user()->role == 'mahasiswa')
                            <li class="mb-4">
                                <a href="{{ route('profil') }}"
                                    class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                                    Profil Saya
                                </a>
                            </li>
                        @endif
                        <div class="my-8 border border-white w-full"></div>
                        @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen wali')
                            <li class="mb-4">
                                <a href="{{ route('profil') }}"
                                    class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                                    Profil Saya
                                </a>
                            </li>
                        @endif
                        <li class="mt-4">
                            <a href="/logout"
                                class="block rounded-md px-4 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
    </div>
    <aside x-show="open" x-transition:enter="transform ease-out duration-300 transition-translate-opacity"
        x-transition:enter-start="translate-y-10 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform ease-in duration-300 transition-translate-opacity"
        x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-10 opacity-0"
        class="sm:hidden">
        <nav>
            <ul class="p-4">
                <li class="mb-4">
                    <a href="/dashboard" class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                        Dashboard
                    </a>
                </li>
                @if (Auth::user()->role == 'kaprodi')
                    <li class="mb-4">
                        <a href="{{ route('kelola-dosen') }}"
                            class="block py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-600">
                            Kelola Dosen
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('kelola-kelas') }}"
                            class="block py-2 px-4 text-white hover:bg-blue-600">
                            Kelola Kelas
                        </a>
                    </li>
                    {{-- <li class="mb-4">
                        <a href="{{ route('kelola-mahasiswa') }}"
                            class="block py-2 px-4 text-white hover:bg-blue-600">
                            Kelola Mahasiswa
                        </a>
                    </li> --}}
                @elseif(Auth::user()->role == 'dosen wali')
                    <li class="mb-4">
                        <a href="{{ route('mahasiswa-kelas') }}"
                            class="block py-2 px-4 text-white hover:bg-blue-600">
                            Kelola Mahasiswa
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('requests-list') }}"
                            class="block py-2 px-4 text-white hover:bg-blue-600">
                            Permintaan Perubahan Data
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'mahasiswa')
                    <li class="mb-4">
                        <a href="{{ route('profil') }}"
                            class="block py-2 px-4 text-white hover:bg-blue-600">
                            Profil Saya
                        </a>
                    </li>
                @endif
                <div class="mt-8 border border-white w-full"></div>
                <li class="mt-4">
                    <a href="/logout"
                        class="block rounded-md px-4 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Sign
                        out</a>
                </li>
            </ul>
        </nav>
    </aside>
</div>
