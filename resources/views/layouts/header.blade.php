<!-- resources/views/components/header.blade.php -->
<div class="flex items-center justify-between bg-gray-900 h-16">
    <!-- Search Bar - removed left padding, adjusted max width -->
    <div class="flex-1 max-w-2xl px-4">
        <div class="relative">
            <input type="text" 
                   placeholder="Search..." 
                   class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                <i class="fas fa-search text-gray-400"></i>
            </button>
        </div>
    </div>

    <!-- Right Side Icons -->
    <div class="flex items-center space-x-6">
        <!-- Notification Icon -->
        <div class="relative">
            <i class="fas fa-bell text-white cursor-pointer hover:text-green-400"></i>
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                3
            </span>
        </div>

        <!-- User Profile -->
        <div class="flex items-center space-x-3 cursor-pointer group">
            <span class="text-white group-hover:text-green-400">KUSWORO ADI</span>
            <img src="/api/placeholder/32/32" alt="Profile" class="w-8 h-8 rounded-full">
        </div>
    </div>
</div>

<!-- Optional: Dropdown menu for user profile -->
<div class="hidden absolute right-4 top-16 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Settings</a>
    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</a>
</div>