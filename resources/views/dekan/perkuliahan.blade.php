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
            <div class="grid grid-cols-3 gap-6">
                <!-- Jadwal Section -->
                <div>
                    <h2 class="text-xl font-bold mb-4">Perkuliahan</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/dekan/ruangkelas" class="bg-orange-500 p-4 rounded-lg relative">
                            <span class="absolute top-2 right-2 text-white"><i class="fas fa-heart"></i></span>
                            <span>Ruang Kelas</span>
                        </a>
                        <a href="/dekan/persetujuanjadwal" class="bg-orange-500 p-4 rounded-lg relative">
                            <span class="absolute top-2 right-2 text-white"><i class="fas fa-heart"></i></span>
                            <span>Lihat Jadwal</span>
                        </a>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="col-span-2">
                    <h2 class="text-xl font-bold mb-4">Timeline</h2>
                    <div class="bg-gray-700 p-6 rounded-lg">
                        <div class="flex justify-between mb-4">
                            <button class="bg-gray-800 px-4 py-2 rounded-full">All</button>
                            <button class="bg-gray-800 px-4 py-2 rounded-full">Sort by dates <i class="fas fa-chevron-down"></i></button>
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
                    <div class="bg-gray-700 p-6 rounded-lg">
                        <div class="flex justify-between mb-4">
                            <button class="bg-gray-800 px-4 py-2 rounded-full">All</button>
                            <button class="bg-gray-800 px-4 py-2 rounded-full">Sort by dates <i class="fas fa-chevron-down"></i></button>
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
