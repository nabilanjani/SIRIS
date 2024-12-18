<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Perkuliahan - Atur Ruang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-blue-900 to-blue-700 text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="/bagianakademik/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white font-bold">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/bagianakademik/perkuliahanba" class="flex items-center space-x-2 text-gray-400 hover:text-white font-bold">
                    <i class="fas fa-user-friends"></i>
                    <span>Perkuliahan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white">
                    <i class="fas fa-edit"></i>
                    <span>Mahasiswa</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white">
                    <i class="fas fa-book"></i>
                    <span>Manaj. Wisuda</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
                    @csrf
                </form>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-8">
                <div></div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user"></i>
                        <span>AWANG KURNIA</span>
                    </div>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-bell"></i>
                </div>
            </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Title and Button -->
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-bold">Atur Ruangan Program Studi</h1>
                <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" 
                onclick="openModal()">
                <i class="fas fa-plus mr-2"></i>Tambah Ruang
                </button>
            </div>

            <!-- Search Bar -->
            <div class="relative mb-5">
                <form action="{{ route('ruang.search') }}" method="GET">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}" 
                        placeholder="Cari ruangan..."
                        class="w-full p-2 pl-10 rounded-full bg-gray-700 text-gray-300 focus:outline-none"
                    >
                </form>
            </div>

            <!-- Tambah Ruang Modal -->
            <div id="myModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-gray-800 rounded-lg p-6 w-1/3">
                    <h3 class="text-lg font-bold mb-4">Form Input Ruangan</h3>
                    <form action="{{ route('ruang.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="kode_ruang" class="block text-sm mb-1">Kode Ruang</label>
                            <input type="text" id="kode_ruang" name="kode_ruang" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none" required maxlength="4">
                        </div>
                        <div class="mb-4">
                            <label for="kapasitas" class="block text-sm mb-1">Kapasitas</label>
                            <input type="number" id="kapasitas" name="kapasitas" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none" required max="999">
                        </div>
                        <div class="mb-4">
                            <label for="prodi" class="block text-sm mb-1">Program Studi</label>
                            <select id="prodi" name="prodi" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none" required>
                                <option value="">Pilih Program Studi</option>
                            </select>

                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded mr-2" onclick="closeModal()">Close</button>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-gray-700 rounded-lg p-5">
                <table class="w-full table-auto text-left text-gray-300">
                    <thead>
                        <tr class="bg-gray-800">
                            <th class="p-3">No</th>
                            <th class="p-3">Kode Ruangan</th>
                            <th class="p-3">Kapasitas</th>
                            <th class="p-3">Program Studi</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ruangan as $index => $ruang)
                        <tr class="border-b border-gray-600">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $ruang->kode_ruang }}</td>
                            <td class="p-3">{{ $ruang->kapasitas }}</td>
                            <td class="p-3">{{ $ruang->programStudi->id_prodi }}</td>
                            <td class="p-3">{{ $ruang->status }}</td>
                            <td class="p-3">
                                <a href="{{ route('ruang.edit', $ruang->id) }}" class="text-blue-400 hover:text-blue-300 mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('ruang.destroy', $ruang->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('myModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('myModal').classList.add('hidden');
        }
    </script>
</body>
</html>