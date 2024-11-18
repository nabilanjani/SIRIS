<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
HEAD
    <title>Perkuliahan</title>
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
=======
    <title>SIRIS UNDIP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-blue-900 to-blue-700 text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-800 to-gray-700 p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">SIRIS UNDIP</h1>
            </div>
            <nav class="space-y-4">
                <a href="#" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-file-alt"></i>
                    <span>IRS</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-user-graduate"></i>
                    <span>Mahasiswa</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-book"></i>
                    <span>Perkuliahan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Manaj. Wisuda</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-white">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
>>>>>>> 7be0a87e84e3a4ef73abe1da8d9347fe18fd27c3
                </a>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-1/3">
                    <input type="text" class="w-full p-2 rounded-full bg-gray-700 text-white placeholder-gray-400" placeholder="Search...">
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
            <div class="mb-6">
                <span>HOME / PERKULIAHAN</span>
            </div>
            <!-- Content -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Perkuliahan Section -->
                <div class="col-span-2">
                    <h2 class="text-xl font-bold mb-4">Perkuliahan</h2>
                    <div class="grid grid-cols-3 gap-4">
<<<<<<< HEAD
                        <a href="/kaprodi/jadwal" class="bg-green-500 p-4 rounded-lg flex items-center justify-between hover:bg-green-600">
                            <span>Jadwal</span>
                            <i class="fas fa-heart text-white"></i>
                        </a>
                        <a href="/kaprodi/mata-kuliah" class="bg-green-500 p-4 rounded-lg flex items-center justify-between hover:bg-green-600">
                            <span>Mata Kuliah</span>
                            <i class="fas fa-heart text-white"></i>
                        </a>
                        <a href="/kaprodi/irs" class="bg-green-500 p-4 rounded-lg flex items-center justify-between hover:bg-green-600">
                            <span>IRS</span>
                            <i class="fas fa-heart text-white"></i>
                        </a>
                        <div class="bg-green-500 p-4 rounded-lg flex items-center justify-between">
                            <span>Jadwal</span>
                            <i class="fas fa-heart text-white"></i>
                        </div>
                        <div class="bg-green-500 p-4 rounded-lg flex items-center justify-between">
                            <span>Mata Kuliah</span>
                            <i class="fas fa-heart text-white"></i>
                        </div>
                        <div class="bg-green-500 p-4 rounded-lg flex items-center justify-between">
                            <span>IRS</span>
                            <i class="fas fa-heart text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- Recently Accessed Section -->
                <div>
                    <h2 class="text-xl font-bold mb-4">Recently Accessed</h2>
                    <div class="flex space-x-2 mb-4">
                        <button class="bg-gray-700 p-2 rounded-full">All</button>
                        <button class="bg-gray-700 p-2 rounded-full">Sort by dates</button>
                    </div>
                    <div class="bg-gray-700 p-4 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-tasks text-2xl mb-2"></i>
                            <p>No activities require action</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Timeline Section -->
            <div class="mt-6">
                <h2 class="text-xl font-bold mb-4">Timeline</h2>
                <div class="flex space-x-2 mb-4">
                    <button class="bg-gray-700 p-2 rounded-full">All</button>
                    <button class="bg-gray-700 p-2 rounded-full">Sort by dates</button>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-tasks text-2xl mb-2"></i>
                        <p>No activities require action</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>