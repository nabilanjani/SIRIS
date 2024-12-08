<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Perkuliahan</title>
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
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
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
                <a href="/kaprodi/perkuliahan" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold active:font-bold">
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
        <div class="flex-1 p-6">
                        <!-- Top Bar -->
                        <div class="flex justify-between items-center mb-6">
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search..." class="w-full p-2 rounded-full bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none">
                    <i class="fas fa-search absolute top-2 right-4 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span>ARIS SUGIHARTO</span>
                        <i class="fas fa-user-circle text-2xl"></i>
                    </div>
                    <i class="fas fa-cog text-xl"></i>
                    <i class="fas fa-bell text-xl"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold mb-4">Pilih Program Studi</h1>

            <!-- Prodi Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="prodiList">
                @php
                $prodi = [
                    'Informatika', 
                    'Biologi', 
                    'Matematika', 
                    'Statistika', 
                    'Kimia', 
                    'Fisika', 
                    'Bioteknologi'
                ];
                @endphp

                @foreach($prodi as $namaProdi)
                <div class="bg-[rgba(255,255,255,0.2)] rounded-lg p-4 flex justify-between items-center hover:bg-[rgba(255,255,255,0.3)] transition">
                    <span>{{ $namaProdi }}</span>
                    <button 
                        onclick="showJadwal('{{ $namaProdi }}')" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm"
                    >
                        Lihat Jadwal
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Modal Jadwal -->
        <div 
            id="jadwalModal" 
            class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
            <div class="bg-[#1E2A78] rounded-lg w-3/4 max-h-[80vh] overflow-auto p-6 shadow-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h2 id="modalTitle" class="text-xl font-bold">Jadwal</h2>
                    <button onclick="closeJadwal()" class="text-white hover:text-gray-300">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <table class="w-full text-gray-300" id="jadwalTable">
                    <thead>
                        <tr class="bg-[#141B46] text-center">
                            <th class="p-2">Waktu</th>
                            <th class="p-2">Mata Kuliah</th>
                            <th class="p-2">Jenis</th>
                            <th class="p-2">SKS</th>
                            <th class="p-2">Kelas</th>
                            <th class="p-2">Dosen</th>
                        </tr>
                    </thead>
                    <tbody id="jadwalBody">
                        <!-- Jadwal akan dimasukkan di sini via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showJadwal(prodi) {
            const modal = document.getElementById('jadwalModal');
            const modalTitle = document.getElementById('modalTitle');
            const jadwalBody = document.getElementById('jadwalBody');

            // Set judul modal
            modalTitle.textContent = `Jadwal Perkuliahan - ${prodi}`;

            // Bersihkan isi tabel sebelumnya
            jadwalBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-400">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Memuat...
                    </td>
                </tr>
            `;

            // Tampilkan modal
            modal.classList.remove('hidden');

            // Kirim request AJAX untuk mendapatkan jadwal
            fetch(`/prodi/${prodi}/jadwal`)
                .then(response => response.json())
                .then(data => {
                    // Kosongkan isi tabel
                    jadwalBody.innerHTML = '';

                    // Jika tidak ada jadwal
                    if (data.length === 0) {
                        jadwalBody.innerHTML = `
                            <tr>
                                <td colspan="6" class="text-center p-4 text-gray-400">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    Tidak ada jadwal tersedia untuk ${prodi}
                                </td>
                            </tr>
                        `;
                        return;
                    }

                    // Tambahkan baris jadwal
                    data.forEach(item => {
                        const row = `
                            <tr class="text-center bg-[#2C3B7A] hover:bg-[#3143AC] transition">
                                <td class="p-2">${item.mulai} - ${item.selesai}</td>
                                <td class="p-2">${item.mata_kuliah}</td>
                                <td class="p-2">${item.jenis_mata_kuliah.charAt(0).toUpperCase() + item.jenis_mata_kuliah.slice(1)}</td>
                                <td class="p-2">${item.sks}</td>
                                <td class="p-2">${item.kelas}</td>
                                <td class="p-2">${item.dosen_pengampu}</td>
                            </tr>
                        `;
                        jadwalBody.innerHTML += row;
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    jadwalBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center p-4 text-red-400">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Gagal memuat jadwal. Silakan coba lagi.
                            </td>
                        </tr>
                    `;
                });
        }

        function closeJadwal() {
            const modal = document.getElementById('jadwalModal');
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>