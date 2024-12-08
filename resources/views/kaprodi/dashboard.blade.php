<!DOCTYPE html>
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
        .content-container {
            height: calc(100vh - 2rem);
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-[#141B46] to-[#3143AC] text-white font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="/kaprodi/dashboard" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold active:font-bold">
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
                <a href="/kaprodi/perkuliahan" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
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
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar - Fixed -->
            <div class="p-8">
                <div class="flex justify-between items-center">
                    <div class="relative w-2/3">
                        <input type="text" class="w-full p-2 rounded-full bg-gradient-to-b from-gray-700 to-gray-600 text-white placeholder-white/70" placeholder="Search...">
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user"></i>
                            <span>{{ $user->name }}</span>
                        </div>
                        <i class="fas fa-cog"></i>
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto px-8 pb-8">
                <!-- Breadcrumb -->
                <div class="mb-6 text-gray-400">
                    <span>HOME / </span><span class="text-green-400">DASHBOARD</span>
                </div>

                <!-- Profile Card -->
                <div class="bg-gradient-to-b from-gray-700 to-gray-500 p-8 rounded-2xl mb-6">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-600 rounded-full mr-4"></div>
                        <div>
                            <span class="text-xl font-bold">{{ $user->name }}</span>
                            <p>NIP : 197108111997021004</p>
                            <p>KAPRODI | <span class="text-green-400">Informatika S1</span></p>
                        </div>
                    </div>
                    <div class="flex mt-6 space-x-4">
                        <button class="bg-green-500 text-white px-4 py-2 rounded-full">Dashboard</button>
                        <button class="bg-gray-700 text-white px-4 py-2 rounded-full">Biodata</button>
                        <button class="bg-gray-700 text-white px-4 py-2 rounded-full">Notifikasi</button>
                    </div>
                </div>

                <!-- Timeline and Recently Accessed Grid -->
                <div class="grid grid-cols-2 gap-8">
                    <!-- Timeline -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Timeline</h3>
                        <div class="bg-gradient-to-b from-gray-700 to-gray-500 p-8 rounded-2xl">
                            <div class="flex justify-between mb-4">
                                <button class="bg-gray-700 text-white px-4 py-2 rounded-full">All</button>
                                <button class="bg-gray-700 text-white px-4 py-2 rounded-full">Sort by dates</button>
                            </div>
                            <div class="flex flex-col items-center justify-center h-48">
                                <i class="fas fa-tasks text-4xl mb-4"></i>
                                <p>No activities require action</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recently Accessed -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Recently Accessed</h3>
                        <div class="bg-gradient-to-b from-gray-700 to-gray-500 p-8 rounded-2xl">
                            <div class="flex justify-between mb-4">
                                <button class="bg-gray-700 text-white px-4 py-2 rounded-full">All</button>
                                <button class="bg-gray-700 text-white px-4 py-2 rounded-full">Sort by dates</button>
                            </div>
                            <div class="flex flex-col items-center justify-center h-48">
                                <i class="fas fa-tasks text-4xl mb-4"></i>
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