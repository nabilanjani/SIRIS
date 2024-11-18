<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-gray-800 to-blue-900 text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="/pembimbingakademik/dashboard" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/pembimbingakademik/perwalian" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
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
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="#" 
                class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search..." class="w-full p-2 rounded-full bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none">
                    <i class="fas fa-search absolute top-2 right-4 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-xl"></i>
                        <span>{{ $user->name }}</span>
                    </div>
                    <i class="fas fa-cog text-xl"></i>
                    <i class="fas fa-bell text-xl"></i>
                </div>
            </div>
            <!-- User Info -->
            <div class="bg-gray-700 p-6 rounded-lg mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gray-500 rounded-full"></div>
                    <div>
                        <div class="text-xl font-bold">{{ $user->name }}</div>
                        <div class="text-gray-400">NIP: 197905242009121003</div>
                        <div class="text-gray-400">LEKTOR | <span class="text-green-400">Informatika S1</span></div>
                    </div>
                </div>
            </div>
            <!-- Dashboard Content -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Timeline -->
                <div class="bg-gray-700 p-6 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-xl font-bold">Timeline</div>
                        <div class="flex space-x-2">
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">All</button>
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">Sort by dates</button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center h-48">
                        <i class="fas fa-tasks text-4xl text-gray-500 mb-4"></i>
                        <div class="text-gray-400">No activities require action</div>
                    </div>
                </div>
                <!-- Recently Accessed -->
                <div class="bg-gray-700 p-6 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-xl font-bold">Recently Accessed</div>
                        <div class="flex space-x-2">
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">All</button>
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-full">Sort by dates</button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center h-48">
                        <i class="fas fa-tasks text-4xl text-gray-500 mb-4"></i>
                        <div class="text-gray-400">No activities require action</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
