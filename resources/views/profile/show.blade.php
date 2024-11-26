<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-[#141B46] to-[#3143AC] text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="/pembimbingakademik/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
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
        <div class="flex justify-center items-center mb-6">
            <h1 class="text-xl font-bold text-white-800">Informasi Profil</h1>
        </div>
        <!-- User Info -->
        <div class="bg-gradient-to-b from-gray-700 to-gray-600 p-6 rounded-lg mb-6 flex flex-col items-center">
        <!-- Foto Profil -->
        <div class="w-24 h-24 bg-gray-500 rounded-full overflow-hidden">
            <img src="{{ $user->profile_photo_url }}" alt="Foto Profil" class="w-full h-full object-cover">
        </div>
            <div class="mt-4 w-full md:w-3/3 mx-auto">
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('profile.edit') }}" 
                    class="text-base text-green-400 hover:text-green-700 flex items-center space-x-2 mb-4">
                        <i class="fas fa-edit"></i> 
                        <span>{{ __('Edit Profile') }}</span>
                    </a>
                </div>
                <div class="border border-gray-500 p-3 rounded-lg mb-4">
                    <h4 class="text-sm font-medium text-gray-400 italic">{{ __('Nama') }}</h4>
                    <p class="mt-1 text-lg text-white">{{ $user->name }}</p>
                </div>
                <div class="border border-gray-500 p-3 rounded-lg mb-4">
                    <h4 class="text-sm font-medium text-gray-400 italic">{{ __('NIDN') }}</h4>
                    <p class="mt-1 text-lg text-white">{{ $user->akademik?->nidn ?? '-' }}</p>
                </div>
                <div class="border border-gray-500 p-3 rounded-lg mb-4">
                    <h4 class="text-sm font-medium text-gray-400 italic">{{ __('Email') }}</h4>
                    <p class="mt-1 text-lg text-white">{{ $user->email }}</p>
                </div>
                <div class="border border-gray-500 p-3 rounded-lg mb-4">
                    <h4 class="text-sm font-medium text-gray-400 italic">{{ __('Tempat Lahir') }}</h4>
                    <p class="mt-1 text-lg text-white">{{ $user->akademik?->tempat_lahir ?? '-' }}</p>
                </div>
                <div class="border border-gray-500 p-3 rounded-lg mb-4">
                    <h4 class="text-sm font-medium text-gray-400 italic">{{ __('Tanggal Lahir') }}</h4>
                    <p class="mt-1 text-lg text-white">
                        {{ $user->akademik?->tanggal_lahir ? \Carbon\Carbon::parse($user->akademik->tanggal_lahir)->format('d F Y') : '-' }}
                    </p>
                </div>
                <div class="border border-gray-500 p-3 rounded-lg mb-4">
                    <h4 class="text-sm font-medium text-gray-400 italic">{{ __('Alamat') }}</h4>
                    <p class="mt-1 text-lg text-white">{{ $user->akademik?->alamat ?? '-' }}</p>
                </div>
                <div class="border border-gray-500 p-3 rounded-lg mb-4">
                    <h4 class="text-sm font-medium text-gray-400 italic">{{ __('No HP') }}</h4>
                    <p class="mt-1 text-lg text-white">{{ $user->akademik?->no_hp ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>           
</body>
</html>
