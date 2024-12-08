<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Perkuliahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-blue-900 to-gray-800 text-white font-sans">
    <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 active:font-bold">
                <a href="/dekan/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/dekan/perkuliahan" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold active:font-bold">
                    <i class="fas fa-edit"></i>
                    <span>Perkuliahan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-book"></i>
                    <span>Manajemen Wisuda</span>
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

            <!-- Main Sections -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Jadwal Section -->
                <div class="col-span-1 bg-gray-800 p-6 rounded-lg">
                    <h2 class="text-xl font-bold mb-4">Perkuliahan</h2>
                    <div class="space-y-4">
                        <a href="/dekan/ruangkelas" class="block bg-orange-500 p-4 rounded-lg text-center text-white hover:bg-orange-600">
                            Ruang Kelas
                        </a>
                        <a href="/dekan/persetujuanjadwal" class="block bg-orange-500 p-4 rounded-lg text-center text-white hover:bg-orange-600">
                            Lihat Jadwal
                        </a>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="col-span-2 bg-gray-800 p-6 rounded-lg">
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
            </div>

            <!-- Recently Accessed Section -->
            <div class="mt-6 bg-gray-800 p-6 rounded-lg">
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
</body>

</html>
