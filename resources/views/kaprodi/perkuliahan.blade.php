<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perkuliahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-[#141B46] to-[#3143AC] text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
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
                <a href="/kaprodi/perkuliahan" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold active:font-bold">
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
                <!-- Logout -->
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
                        <span>ARIS SUGIHARTO</span>
                        <i class="fas fa-user-circle text-2xl"></i>
                    </div>
                    <i class="fas fa-cog text-xl"></i>
                    <i class="fas fa-bell text-xl"></i>
                </div>
            </div>
            <!-- Breadcrumb -->
            <div class="text-gray-400 mb-6">HOME / <span class="text-white">PERKULIAHAN</span></div>
            <!-- Content -->
            <div>
                <h1 class="text-2xl font-bold mb-4">Perkuliahan</h1>
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <a href="/kaprodi/jadwal" class="bg-green-500 p-6 rounded-lg relative">
                        <span class="absolute top-2 right-2 text-white"><i class="fas fa-heart"></i></span>
                        <div class="text-white text-lg">Jadwal</div>
                    </a>
                    <a href="/kaprodi/kelolamatkul" class="bg-green-500 p-6 rounded-lg relative">
                        <span class="absolute top-2 right-2 text-white"><i class="fas fa-heart"></i></span>
                        <div class="text-white text-lg">Mata Kuliah</div>
                    </a>
                    <a href="/kaprodi/irs" class="bg-green-500 p-6 rounded-lg relative">
                        <span class="absolute top-2 right-2 text-white"><i class="fas fa-heart"></i></span>
                        <div class="text-white text-lg">IRS</div>
                    </a>
                </div>
                <!-- Timeline and Recent Activities -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-b from-gray-700 to-gray-500 p-6 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">All</button>
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">Sort by dates <i class="fas fa-chevron-down"></i></button>
                        </div>
                        <div class="flex flex-col items-center justify-center h-32">
                            <i class="fas fa-tasks text-4xl text-gray-500 mb-2"></i>
                            <div class="text-gray-400">No activities require action</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-b from-gray-700 to-gray-500 p-6 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">All</button>
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">Sort by dates <i class="fas fa-chevron-down"></i></button>
                        </div>
                        <div class="flex flex-col items-center justify-center h-32">
                            <i class="fas fa-tasks text-4xl text-gray-500 mb-2"></i>
                            <div class="text-gray-400">No activities require action</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>