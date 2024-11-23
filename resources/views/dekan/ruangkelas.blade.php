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
                <a href="/dekan/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 font-bold hover:font-bold">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/dekan/perkuliahan" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold">
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
                        <span>KUSWORO ADI</span>
                    </div>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-bell"></i>
                </div>
            </div>

            <!-- Content -->
            <div>
                <h1 class="text-2xl font-bold mb-5">Persetujuan Ruangan</h1>
                <div class="flex space-x-5 mb-5">
                    <div>
                        <label for="departemen" class="block mb-2">Departemen</label>
                        <select id="departemen" class="p-2 rounded bg-gray-700 text-white">
                            <option>Informatika</option>
                            <option>Biologi</option>
                            <option>Fisika</option>
                            <option>Matematika</option>
                            <option>Statistika</option>
                            <option>Bioteknologi</option>
                            <option>Kimia</option>
                        </select>
                    </div>
                    <div>
                        <label for="prodi" class="block mb-2">Prodi</label>
                        <select id="prodi" class="p-2 rounded bg-gray-700 text-white">
                            <option>S1 Informatika</option>
                        </select>
                    </div>
                </div>
                <div class="bg-gray-700 p-5 rounded-lg">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-800">
                                <th class="p-3">No</th>
                                <th class="p-3">Kode Ruangan</th>
                                <th class="p-3">Kondisi</th>
                                <th class="p-3">Kapasitas</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-gray-600">
                                <td class="p-3">1</td>
                                <td class="p-3">A101</td>
                                <td class="p-3">Baik</td>
                                <td class="p-3">50</td>
                                <td class="p-3"><span class="bg-green-500 text-white p-1 rounded">Disetujui</span></td>
                                <td class="p-3">
                                    <button class="bg-red-500 text-white p-1 rounded">Tolak</button>
                                    <button class="bg-green-500 text-white p-1 rounded">Setuju</button>
                                </td>
                            </tr>
                            <tr class="bg-gray-600">
                                <td class="p-3">2</td>
                                <td class="p-3">A102</td>
                                <td class="p-3">Baik</td>
                                <td class="p-3">50</td>
                                <td class="p-3"><span class="bg-yellow-500 text-white p-1 rounded">Waiting</span></td>
                                <td class="p-3">
                                    <button class="bg-red-500 text-white p-1 rounded">Tolak</button>
                                    <button class="bg-green-500 text-white p-1 rounded">Setuju</button>
                                </td>
                            </tr>
                            <tr class="bg-gray-600">
                                <td class="p-3">3</td>
                                <td class="p-3">A103</td>
                                <td class="p-3">Baik</td>
                                <td class="p-3">50</td>
                                <td class="p-3"><span class="bg-green-500 text-white p-1 rounded">Disetujui</span></td>
                                <td class="p-3">
                                    <button class="bg-red-500 text-white p-1 rounded">Tolak</button>
                                    <button class="bg-green-500 text-white p-1 rounded">Setuju</button>
                                </td>
                            </tr>
                            <tr class="bg-gray-600">
                                <td class="p-3">4</td>
                                <td class="p-3">A104</td>
                                <td class="p-3">Baik</td>
                                <td class="p-3">50</td>
                                <td class="p-3"><span class="bg-green-500 text-white p-1 rounded">Disetujui</span></td>
                                <td class="p-3">
                                    <button class="bg-red-500 text-white p-1 rounded">Tolak</button>
                                    <button class="bg-green-500 text-white p-1 rounded">Setuju</button>
                                </td>
                            </tr>
                            <tr class="bg-gray-600">
                                <td class="p-3">5</td>
                                <td class="p-3">A201</td>
                                <td class="p-3">Baik</td>
                                <td class="p-3">50</td>
                                <td class="p-3"><span class="bg-yellow-500 text-white p-1 rounded">Waiting</span></td>
                                <td class="p-3">
                                    <button class="bg-red-500 text-white p-1 rounded">Tolak</button>
                                    <button class="bg-green-500 text-white p-1 rounded">Setuju</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between mt-5">
                        <button class="bg-red-500 text-white p-2 rounded">Tolak semua</button>
                        <button class="bg-green-500 text-white p-2 rounded">Setujui semua</button>
                    </div>
                    <div class="flex justify-center mt-5">
                        <button class="bg-gray-800 text-white p-2 rounded mx-1">Previous</button>
                        <button class="bg-blue-900 text-white p-2 rounded mx-1">1</button>
                        <button class="bg-gray-800 text-white p-2 rounded mx-1">2</button>
                        <button class="bg-gray-800 text-white p-2 rounded mx-1">3</button>
                        <button class="bg-gray-800 text-white p-2 rounded mx-1">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
