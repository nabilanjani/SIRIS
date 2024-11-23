<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa Perwalian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-gray-800 to-blue-900 text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="/pembimbingakademik/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/pembimbingakademik/perwalian" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold active:font-bold">
                    <i class="fas fa-user-friends"></i>
                    <span>Perwalian</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-edit"></i>
                    <span>Input Nilai</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-book"></i>
                    <span>Bimbingan & Ujian</span>
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
        <div class="flex-1 p-6 overflow-y-auto">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search..." class="w-full p-2 rounded-full bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none">
                    <i class="fas fa-search absolute top-2 right-4 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user"></i>
                        <span>{{$user->akademik?->nama ?? 'Tidak ditemukan' }}</span>
                    </div>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-bell"></i>
                </div>
            </div>
            <!-- Breadcrumb -->
            <!-- <div class="text-gray-400 mb-6">HOME / IRS</div> -->
            <!-- Content -->
            <div>
                <!-- <h1 class="text-2xl font-bold mb-4">Review IRS Mahasiswa</h1> -->
                <div class="mb-4">
                    <div class="mb-4 flex items-center">
                        <span class="mr-2 w-24">Angkatan :</span>
                        <select class="p-2 rounded bg-gray-700 text-gray-300 w-60">
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                        </select>
                    </div>
                    <div class="mb-4 flex items-center">
                        <span class="mr-2 w-24">Prodi :</span>
                        <select class="p-2 rounded bg-gray-700 text-gray-300 w-60">
                            <option>Informatika S1</option>
                        </select>
                    </div>
                    <button class="mb-2 px-4 py-2 bg-blue-600 rounded text-white">Filter Data</button>
                    <button class="px-4 py-2 bg-gray-600 rounded text-white">Reset Filter</button>
                </div>
                <div class="flex space-x-4 mb-4">
                    <button class="bg-red-500 text-white px-4 py-2 rounded">Belum IRS <br><strong>12</strong></button>
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded">IRS Belum Disetujui<br><strong>12</strong></button>
                    <button class="bg-green-500 text-white px-4 py-2 rounded">IRS Sudah Disetujui<br><strong>12</strong></button>
                </div>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-800 rounded-lg">
                        <thead>
                            <tr class="text-left text-gray-400">
                                <th class="p-4"></th>
                                <th class="p-4">Nama</th>
                                <th class="p-4">NIM</th>
                                <th class="p-4">Prodi</th>
                                <th class="p-4">Angkatan</th>
                                <th class="p-4">Jalur Masuk</th>
                                <th class="p-4">IP Lalu</th>
                                <th class="p-4">SKS Diambil</th>
                                <th class="p-4">Status IRS</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            <tr class="border-b border-gray-700">
                                <td class="p-4 flex items-center space-x-2">
                                <a href="/pembimbingakademik/halamanirsmhs" class="px-4 py-2 bg-blue-600 rounded text-white inline-block">
                                    <i class="fas fa-search"></i> 
                                </a>
                                </td>
                                <td class="p-4">AURA ARFANINSA AZ ZAHRA</td>
                                <td class="p-4">24060122130097</td>
                                <td class="p-4">S1 INFORMATIKA</td>
                                <td class="p-4">2022</td>
                                <td class="p-4">SBMPTN</td>
                                <td class="p-4">3.88</td>
                                <td class="p-4">85</td>
                                <td class="p-4">
                                    <span class="block px-2 py-1 bg-yellow-500 rounded text-white w-full text-center font-bold">Belum Disetujui</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>