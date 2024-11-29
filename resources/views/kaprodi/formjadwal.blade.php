<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-[#141B46] to-[#3143AC] text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-[rgba(255,255,255,0.3)] p-6">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold">SIRIS UNDIP</h1>
            </div>
            <nav class="space-y-4">
                <a href="/kaprodi/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-user-friends"></i>
                    <span>IRS</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-edit"></i>
                    <span>Mahasiswa</span>
                </a>
                <a href="/kaprodi/perkuliahan" class="flex items-center space-x-2text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold active:font-bold">
                    <i class="fas fa-book"></i>
                    <span>Perkuliahan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-cog"></i>
                    <span>Manaj. Wisuda</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>

                <!-- Logout-->
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="#" 
                class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>{{ __('Log Out') }}</span>
                </a>
            </nav>
        </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="relative w-1/3">
                <input type="text" class="w-full p-2 rounded-full bg-gray-700 text-gray-300 placeholder-gray-400" placeholder="Search...">
                <i class="fas fa-search absolute top-3 right-4 text-gray-400"></i>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span>ARIS SUGIHARTO</span>
                </div>
                <i class="fas fa-cog text-xl"></i>
                <i class="fas fa-bell text-xl"></i>
            </div>
        </div>

        <!-- Breadcrumbs -->
        <div class="flex items-center space-x-2 text-gray-400 mb-4">
            <a href="#" class="hover:text-white">HOME</a>
            <span>/</span>
            <a href="#" class="hover:text-white">PERKULIAHAN</a>
            <span>/</span>
            <a href="#" class="hover:text-white">JADWAL</a>
            <span>/</span>
            <span class="text-white">BUAT JADWAL BARU</span>
        </div>

        <!-- Title and Finalize Button -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Jadwal Baru</h1>
            <button class="bg-green-500 text-white px-4 py-2 rounded-full flex items-center space-x-2">
                <span>Finalisasi</span>
                <i class="fas fa-check"></i>
            </button>
        </div>

        <!-- Schedule Table -->
        <div class="bg-gray-700 rounded-lg p-4 relative">
            <table class="w-full text-center text-gray-300">
                <thead>
                    <tr>
                        <th class="py-2">Waktu</th>
                        <th class="py-2">Senin <i class="fas fa-plus-circle"></i></th>
                        <th class="py-2">Selasa <i class="fas fa-plus-circle"></i></th>
                        <th class="py-2">Rabu <i class="fas fa-plus-circle"></i></th>
                        <th class="py-2">Kamis <i class="fas fa-plus-circle"></i></th>
                        <th class="py-2">Jumat <i class="fas fa-plus-circle"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2">06.00</td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                    </tr>
                    <tr>
                        <td class="py-2">07.00</td>
                        <td class="py-2 relative">
                            <div class="bg-blue-900 text-white p-2 rounded-lg absolute top-0 left-0 w-full h-full">
                                <div>Proyek Perangkat Lunak</div>
                                <div class="text-yellow-400">WAJIB (KM2020)</div>
                                <div>(SMT 5) (3 SKS)</div>
                                <div>Kelas: <span class="text-yellow-400">C / 3/3 SKS</span></div>
                                <div>07:00 - 09:30</div>
                            </div>
                        </td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                    </tr>
                    <tr>
                        <td class="py-2">08.00</td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                    </tr>
                    <tr>
                        <td class="py-2">09.00</td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>

            <!-- Form -->
            <div class="absolute top-16 left-1/3 bg-blue-900 p-4 rounded-lg w-1/3">
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Mata kuliah</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Matkul</option>
                            @foreach ($mata_kuliah as $matkul)
                                <option value="{{ $matkul->kodemk }}">{{ $matkul->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Jenis mata kuliah</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Jenis MK</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Jenis pertemuan</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Jenis Pert</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Jenis kelas</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Jenis Kls</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Kelas</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Kelas</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>SKS</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih SKS</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>TA/Semester</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih TA/Sem</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Ruang kuliah</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Ruangan</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Dosen pengampu</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Dosen</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Koordinator</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Koor</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <span>Mulai</span>
                        <input type="time" class="bg-gray-700 text-white rounded px-2 py-1">
                    </div>
                    <div class="flex justify-between">
                        <span>Selesai</span>
                        <input type="time" class="bg-gray-700 text-white rounded px-2 py-1">
                    </div>
                    <div class="flex justify-between">
                        <span>Kuota</span>
                        <input type="number" class="bg-gray-700 text-white rounded px-2 py-1">
                    </div>
                    <div class="flex justify-between">
                        <span>Kurikulum</span>
                        <select class="bg-gray-700 text-white rounded px-2 py-1">
                            <option>Pilih Kurikulum</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <button class="bg-green-500 text-white px-4 py-2 rounded-full">Submit</button>
                    <button class="bg-orange-500 text-white px-4 py-2 rounded-full">Reset</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>