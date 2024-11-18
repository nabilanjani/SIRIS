<!-- resources/views/components/sidebar.blade.php -->
<div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-750 p-6">
    <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
    <ul class="space-y-6">
        <li class="flex items-center space-x-3">
            <i class="fas fa-home"></i>
            <a href="{{ route('dashboard') }}" class="hover:text-green-400">Dashboard</a>
        </li>
        <li class="flex items-center space-x-3">
            <i class="fas fa-file-alt"></i>
            <a  class="hover:text-green-400">IRS</a>
        </li>
        <li class="flex items-center space-x-3">
            <i class="fas fa-user-graduate"></i>
            <a  class="hover:text-green-400">Mahasiswa</a>
        </li>
        <li class="flex items-center space-x-3">
            <i class="fas fa-book"></i>
            <a href="{{ route('perkuliahan') }}" class="hover:text-green-400">Perkuliahan</a>
        </li>
        <li class="flex items-center space-x-3">
            <i class="fas fa-graduation-cap"></i>
            <a  class="hover:text-green-400">Manaj. Wisuda</a>
        </li>
        <li class="flex items-center space-x-3">
            <i class="fas fa-cog"></i>
            <a  class="hover:text-green-400">Settings</a>
        </li>
        <li class="flex items-center space-x-3">
            <i class="fas fa-sign-out-alt"></i>
            <a  class="hover:text-green-400">Log Out</a>
        </li>
    </ul>
</div>
