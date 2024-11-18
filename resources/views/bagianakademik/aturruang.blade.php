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
        <!-- Title and Button -->
        <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-bold">Atur Ruangan</h1>
                <button class="bg-green-500 text-white px-4 py-2 rounded-full flex items-center">
                    <i class="fas fa-plus mr-2"></i>Buat Ruangan
                </button>
            </div>
            <!-- Search Bar -->
            <div class="relative mb-5">
            <input type="text" placeholder="Cari ruangan..." class="w-full p-2 pl-10 rounded-full bg-gray-700 text-gray-300 focus:outline-none">
            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
            <!-- Table -->
            <div class="bg-gray-700 rounded-lg p-5">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-800 text-gray-300">
                            <th class="p-3">No</th>
                            <th class="p-3">Kode Ruangan</th>
                            <th class="p-3">Kondisi</th>
                            <th class="p-3">Kapasitas</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-600">
                            <td class="p-3">1</td>
                            <td class="p-3">A101</td>
                            <td class="p-3">Baik</td>
                            <td class="p-3">50</td>
                            <td class="p-3">
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded-full mr-2">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-full">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="p-3">2</td>
                            <td class="p-3">A102</td>
                            <td class="p-3">Baik</td>
                            <td class="p-3">50</td>
                            <td class="p-3">
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded-full mr-2">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-full">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="p-3">3</td>
                            <td class="p-3">A103</td>
                            <td class="p-3">Baik</td>
                            <td class="p-3">50</td>
                            <td class="p-3">
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded-full mr-2">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-full">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="p-3">4</td>
                            <td class="p-3">A104</td>
                            <td class="p-3">Baik</td>
                            <td class="p-3">50</td>
                            <td class="p-3">
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded-full mr-2">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-full">Hapus</button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-600">
                            <td class="p-3">5</td>
                            <td class="p-3">A201</td>
                            <td class="p-3">Baik</td>
                            <td class="p-3">50</td>
                            <td class="p-3">
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded-full mr-2">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-full">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="flex justify-between items-center mt-5">
                    <span>Previous</span>
                    <div class="flex space-x-2">
                        <button class="bg-blue-900 text-white px-3 py-1 rounded-full">1</button>
                        <button class="bg-gray-600 text-white px-3 py-1 rounded-full">2</button>
                        <button class="bg-gray-600 text-white px-3 py-1 rounded-full">3</button>
                    </div>
                    <span>Next</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>