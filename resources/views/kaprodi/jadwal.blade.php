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
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-8">
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search..." class="w-full p-2 rounded-full bg-gray-700 text-white placeholder-gray-400">
                    <i class="fas fa-search absolute top-2 right-4 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <span>ARIS SUGIHARTO</span>
                    </div>
                    <i class="fas fa-cog text-2xl"></i>
                    <i class="fas fa-bell text-2xl"></i>
                </div>
            </div>
            <!-- Breadcrumb -->
            <div class="mb-8">
                <span class="text-gray-400">HOME / PERKULIAHAN / </span>
                <span class="text-yellow-400">JADWAL</span>
            </div>
            <!-- Content -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Jadwal Section -->
                <div>
                    <h2 class="text-xl font-bold mb-4">Jadwal</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/kaprodi/buatjadwalbaru" class="bg-orange-500 p-4 rounded-lg flex justify-between items-center hover:bg-orange-600">
                            <span>Buat Jadwal Baru</span>
                            <i class="fas fa-heart text-white"></i>
                        </a>
                        <a href="/kaprodi/lihatjadwal" class="bg-orange-500 p-4 rounded-lg flex justify-between items-center">
                            <span>Lihat Jadwal</span>
                            <i class="fas fa-heart text-white"></i>
                        </a>
                    </div>
                </div>
                <!-- Timeline Section -->
                <div class="col-span-2">
                    <h2 class="text-xl font-bold mb-4">Timeline</h2>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <div class="flex justify-between mb-4">
                            <div class="flex space-x-2">
                                <button class="bg-gray-600 px-4 py-2 rounded-full">All</button>
                                <button class="bg-gray-600 px-4 py-2 rounded-full">Sort by dates</button>
                            </div>
                            <span class="text-gray-400">2022</span>
                        </div>
                        <div class="flex justify-center items-center h-40">
                            <div class="text-center">
                                <i class="fas fa-tasks text-4xl mb-2"></i>
                                <p>No activities require action</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Recently Accessed Section -->
                <div class="col-span-3">
                    <h2 class="text-xl font-bold mb-4">Recently Accessed</h2>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <div class="flex justify-between mb-4">
                            <div class="flex space-x-2">
                                <button class="bg-gray-600 px-4 py-2 rounded-full">All</button>
                                <button class="bg-gray-600 px-4 py-2 rounded-full">Sort by dates</button>
                            </div>
                        </div>
                        <div class="flex justify-center items-center h-40">
                            <div class="text-center">
                                <i class="fas fa-tasks text-4xl mb-2"></i>
                                <p>No activities require action</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>