<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="/kaprodi/perkuliahan" class="flex items-center space-x-2 text-white py-2 px-4 font-bold">
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
                <a href="#" 
                   class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>{{ __('Log Out') }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-1/3">
                    <input type="text" class="w-full p-2 rounded-full bg-gray-700 text-gray-300 placeholder-gray-400" placeholder="Search...">
                    <i class="fas fa-search absolute top-2 right-4 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <span>ARIS SUGIHARTO</span>
                    </div>
                    <i class="fas fa-cog text-xl"></i>
                    <i class="fas fa-bell text-xl"></i>
                </div>
            </div>

            <!-- Breadcrumb -->
            <div class="text-sm text-gray-400 mb-4">
                HOME / PERKULIAHAN / JADWAL / <span class="text-yellow-500">BUAT JADWAL BARU</span>
            </div>

            <!-- Schedule Table -->
            <div>
                <h1 class="text-2xl font-bold mb-4">Jadwal Baru</h1>
                <div class="bg-gray-700 rounded-lg overflow-hidden">
                    <table class="w-full text-gray-300">
                        <thead>
                            <tr class="bg-gray-800">
                                <th class="p-2">Waktu</th>
                                <th class="p-2">Senin <button onclick="toggleForm()" class="text-yellow-400 hover:text-yellow-600"><i class="fas fa-plus-circle"></i></button></th>
                                <th class="p-2">Selasa <button onclick="toggleForm()" class="text-yellow-400 hover:text-yellow-600"><i class="fas fa-plus-circle"></i></button></th>
                                <th class="p-2">Rabu <button onclick="toggleForm()" class="text-yellow-400 hover:text-yellow-600"><i class="fas fa-plus-circle"></i></button></th>
                                <th class="p-2">Kamis <button onclick="toggleForm()" class="text-yellow-400 hover:text-yellow-600"><i class="fas fa-plus-circle"></i></button></th>
                                <th class="p-2">Jumat <button onclick="toggleForm()" class="text-yellow-400 hover:text-yellow-600"><i class="fas fa-plus-circle"></i></button></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Tambahkan baris waktu sesuai kebutuhan -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up Form for Adding Schedule -->
    <div id="jadwalForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-[#1E255E] p-6 rounded-lg w-1/2">
            <h2 class="text-2xl font-bold mb-4 text-white">Form Pengisian Jadwal</h2>
            <div class="grid grid-cols-2 gap-4">
                <!-- Form Fields -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Mata kuliah</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Matkul</option>
                        @foreach ($mata_kuliah as $matkul)
                                <option value="{{ $matkul->kodemk }}">{{ $matkul->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Jenis mata kuliah</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Jenis MK</option>
                    </select>
                </div>
                <!-- Additional Fields -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Jenis pertemuan</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Jenis Pert</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Jenis kelas</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Jenis Kls</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Kelas</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Kelas</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">SKS</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih SKS</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">TA/Semester</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih TA/Sem</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Ruang kuliah</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Ruangan</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Dosen pengampu</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Dosen</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Koordinator</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Koor</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Mulai</label>
                    <span class="text-white">:</span>
                    <input type="text" class="bg-gray-600 text-white rounded px-2 py-1" placeholder="-- : --">
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Selesai</label>
                    <span class="text-white">:</span>
                    <input type="text" class="bg-gray-600 text-white rounded px-2 py-1" placeholder="-- : --">
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Kuota</label>
                    <span class="text-white">:</span>
                    <input type="text" class="bg-gray-600 text-white rounded px-2 py-1">
                </div>
                <div class="grid grid-cols-3 gap-4 items-center">
                    <label class="text-white">Kurikulum</label>
                    <span class="text-white">:</span>
                    <select class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Kurikulum</option>
                    </select>
                </div>
                <div class="col-span-2 flex justify-between mt-4">
                    <button class="bg-green-500 text-white rounded px-4 py-2" onclick="submitForm()">Submit</button>
                    <button class="bg-red-500 text-white rounded px-4 py-2" onclick="resetForm()">Reset</button>
                    <button class="text-white px-4 py-2" onclick="toggleForm()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('jadwalForm');
            form.classList.toggle('hidden');
        }

        function submitForm() {
            toggleForm();
            alert("Jadwal berhasil ditambahkan!");
        }

        function resetForm() {
            document.getElementById('jadwalForm').reset();
        }
    </script>
</body>
</html>