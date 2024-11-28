<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-blue-900 to-blue-700 text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="/bagianakademik/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 font-bold hover:font-bold">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/bagianakademik/perkuliahanba" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold">
                    <i class="fas fa-user-friends"></i>
                    <span>Perkuliahan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 ">
                    <i class="fas fa-edit"></i>
                    <span>Mahasiswa</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 ">
                    <i class="fas fa-book"></i>
                    <span>Manaj. Wisuda</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 ">
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
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-8">
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search..." class="w-full p-2 pl-10 rounded-full bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user"></i>
                        <span>AHMAD BRIAN</span>
                    </div>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-bell"></i>
                </div>
            </div>

             <!-- Title and Button 
             <div class="text-sm text-gray-400 mb-4">
                HOME / <span class="text-green-400">PERKULIAHAN</span> / <span class="text-yellow-400">JADWAL</span> / <span class="text-blue-400">LIHAT JADWAL</span>
            </div>
            -->
            <h1 class="text-2xl font-bold mb-6">Atur Ruangan Program Studi</h1>
            <div class="mb-6">
                <div class="flex space-x-4 mb-4">
                    <div>
                        <label for="programstudi" class="block text-gray-300">Program Studi</label>
                        <select id="programstudi" class="bg-gray-700 text-white rounded px-4 py-2">
                            <option>S1 Informatika</option>
                        </select>
                    </div>
                </div>
                <button class="bg-green-500 text-white px-4 py-2 rounded-full flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Ruangan</span>
                </button>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400">
                            <th class="py-2">No</th>
                            <th class="py-2">Kode Ruangan</th>
                            <th class="py-2">Kondisi</th>
                            <th class="py-2">Kapasitas</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        <tr class="border-b border-gray-700">
                            <td class="py-2">1</td>
                            <td class="py-2">A101</td>
                            <td class="py-2">Baik</td>
                            <td class="py-2">50</td>
                            <td class="py-2"><span class="bg-green-500 text-white px-2 py-1 rounded-full">Disetujui</span></td>
                            <td class="py-2 flex space-x-2">
                                <button class="bg-gray-600 text-white px-4 py-1 rounded">Edit</button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-2">2</td>
                            <td class="py-2">A102</td>
                            <td class="py-2">Baik</td>
                            <td class="py-2">50</td>
                            <td class="py-2"><span class="bg-yellow-500 text-white px-2 py-1 rounded-full">Waiting</span></td>
                            <td class="py-2 flex space-x-2">
                                <button class="bg-gray-600 text-white px-4 py-1 rounded">Edit</button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-2">3</td>
                            <td class="py-2">A103</td>
                            <td class="py-2">Baik</td>
                            <td class="py-2">50</td>
                            <td class="py-2"><span class="bg-green-500 text-white px-2 py-1 rounded-full">Disetujui</span></td>
                            <td class="py-2 flex space-x-2">
                                <button class="bg-gray-600 text-white px-4 py-1 rounded">Edit</button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-2">4</td>
                            <td class="py-2">A104</td>
                            <td class="py-2">Baik</td>
                            <td class="py-2">50</td>
                            <td class="py-2"><span class="bg-green-500 text-white px-2 py-1 rounded-full">Disetujui</span></td>
                            <td class="py-2 flex space-x-2">
                                <button class="bg-gray-600 text-white px-4 py-1 rounded">Edit</button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2">5</td>
                            <td class="py-2">A201</td>
                            <td class="py-2">Baik</td>
                            <td class="py-2">50</td>
                            <td class="py-2"><span class="bg-yellow-500 text-white px-2 py-1 rounded-full">Waiting</span></td>
                            <td class="py-2 flex space-x-2">
                                <button class="bg-gray-600 text-white px-4 py-1 rounded">Edit</button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end mt-4 space-x-2">
                    <button class="bg-gray-600 text-white px-4 py-1 rounded">Previous</button>
                    <button class="bg-gray-600 text-white px-4 py-1 rounded">1</button>
                    <button class="bg-gray-600 text-white px-4 py-1 rounded">2</button>
                    <button class="bg-gray-600 text-white px-4 py-1 rounded">3</button>
                    <button class="bg-gray-600 text-white px-4 py-1 rounded">Next</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>