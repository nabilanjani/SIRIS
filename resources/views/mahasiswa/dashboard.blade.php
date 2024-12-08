<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h3>
        <body class="bg-gradient-to-b from-blue-900 to-blue-700 min-h-screen flex flex-col items-center">
            <div class="w-full max-w-6xl p-4">
                <!-- Top Navigation -->
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-circle text-white text-2xl"></i>
                            <span class="text-white">Halo! {{ $mahasiswa->first()->nama }}</span>
                        </div>
                        <i class="fas fa-cog text-white text-xl"></i>
                        <i class="fas fa-bell text-white text-xl"></i>
                    </div>
                    <div class="relative w-1/3">
                        <input type="text" placeholder="Search..." class="w-full py-2 px-4 rounded-full bg-gray-200 text-gray-700 focus:outline-none">
                        <i class="fas fa-search absolute top-2 right-4 text-gray-500"></i>
                    </div>
                </div>
        
                <div class="flex">
                    <!-- Sidebar -->
                    <div class="w-1/4 space-y-4">
                        <button onclick="window.location.href='{{ route('mahasiswa.herreg') }}';" class="w-full h-1/5 py-4 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-lg text-lg font-semibold">
                            Her-Registrasi
                        </button>
                        <button onclick="window.location.href='{{ route('mahasiswa.akademik') }}';" class="w-full h-1/5 py-4 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-lg text-lg font-semibold">
                            Akademik
                        </button>
                        <button class="w-full h-1/5 py-4 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-lg text-lg font-semibold">Jadwal Kuliah</button>
                        <button class="w-full h-1/5 py-4 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-lg text-lg font-semibold">Kalender Akademik</button>
                    </div>
        
                    <!-- Main Content -->
                    <div class="w-3/4 pl-8">
                        <div class="bg-gradient-to-r from-gray-400 to-gray-500 p-6 rounded-lg mb-8">
                            <div class="flex items-center space-x-4 mb-4">
                                <i class="fas fa-user-circle text-white text-4xl"></i>
                                <div>
                                    <h1 class="text-white text-2xl font-bold">{{ $mahasiswa->first()->nama }}</h1>
                                    <p class="text-white">{{ $mahasiswa->first()->nim }} | {{ $mahasiswa->first()->jurusan }} S1</p>
                                </div>
                            </div>
                            <div class="bg-blue-900 p-4 rounded-lg">
                                <h2 class="text-white text-xl font-bold mb-4"><i class="fas fa-graduation-cap"></i> Status Akademik</h2>
                                <p class="text-white mb-1"><i class="fas fa-user"></i> Dosen Wali: Adhe Setya Pramayoga, M. T.</p>
                                <p class="text-white mb-4">(NIP: 199112092024061001)</p>
                                <div class="flex space-x-4">
                                    <div class="bg-white p-4 rounded-lg text-center">
                                        <p class="font-semibold">Semester Akademik</p>
                                        <p>2024/2024</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg text-center">
                                        <p class="font-semibold">Semester Studi</p>
                                        <p>{{ $mahasiswa->first()->semester }}</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg text-center border-2 border-red-500">
                                        <p class="font-semibold text-red-500">Status Akademik</p>
                                        <p class="text-red-500">Belum Her-Reg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="bg-gradient-to-r from-gray-400 to-gray-500 p-6 rounded-lg">
                            <h2 class="text-white text-xl font-bold mb-4"><i class="fas fa-trophy"></i> Capaian Akademik</h2>
                            <div class="flex space-x-4">
                                <div class="bg-white p-4 rounded-lg text-center flex-1">
                                    <p class="font-semibold">IPk</p>
                                    <p>4.00</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg text-center flex-1">
                                    <p class="font-semibold">SKSk</p>
                                    <p>87</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </x-slot>
</x-app-layout>