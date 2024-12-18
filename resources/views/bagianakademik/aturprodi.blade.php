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
                <a href="/bagianakademik/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 font-bold">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/bagianakademik/perkuliahanba" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4 font-bold">
                    <i class="fas fa-user-friends"></i>
                    <span>Perkuliahan</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-edit"></i>
                    <span>Mahasiswa</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-book"></i>
                    <span>Manaj. Wisuda</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4" 
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

            <!-- Title -->
            <h1 class="text-2xl font-bold mb-6">Program Studi</h1>

            <!-- Add Button -->
            <div class="mb-6">
                <button class="bg-green-500 text-white px-4 py-2 rounded-full flex items-center space-x-2" onclick="toggleModal('modaltambahprodi')">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Program Studi</span>
                </button>
            </div>

            <!-- Table -->
            <div class="bg-gray-800 rounded-lg p-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400">
                            <th class="py-2">No</th>
                            <th class="py-2">Nama Program Studi</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @forelse ($prodi as $index => $ps)
                        <tr class="border-b border-gray-700">
                            <td class="p-3">{{ $index + $prodi->firstItem() }}</td>
                            <td class="p-3">{{ $ps->nama }}</td>
                            <td class="p-3">
                                <!-- Edit Button -->
                                <button class="bg-yellow-500 text-white px-4 py-2 rounded-full flex items-center space-x-2" onclick="toggleModal('modaleditprodi')">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </button>

                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-400">Tidak ada data program studi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $prodi->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Program Studi -->
    <div id="modaltambahprodi" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-2xl font-bold mb-4">Tambah Program Studi</h2>
            <form action="{{ route('tambahprodi') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama Program Studi</label>
                    <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border rounded-lg mt-2" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-full" onclick="toggleModal('modaltambahprodi')">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-full">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Program Studi -->
    <div id="modaleditprodi" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-2xl font-bold mb-4">Edit Program Studi</h2>
            <form action="{{ route('editprodi', ['id_prodi' => $ps->id_prodi]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="nama" class="block text-gray-700">Nama Program Studi</label>
        <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border rounded-lg mt-2" value="{{ $ps->nama }}" required>
    </div>
    <div class="flex justify-end space-x-4">
        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-full" onclick="toggleModal('modaleditprodi')">Batal</button>
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-full">Perbarui</button>
    </div>
</form>

        </div>
    </div>

    <script>
        // Function to toggle modals
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>

