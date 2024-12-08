<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Kuliah</title>
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

            <!-- Main Content -->
            <div id="prodiSelection" class="flex-1 p-6">
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
                            type="button" 
                            data-prodi="{{ $namaProdi }}" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm prodi-button">
                            Kelola Mata Kuliah
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Container Utama -->
            <div id="kelolaForm" class="hidden flex flex-col gap-6 p-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Mata Kuliah</h1>

                <!-- Form dan Tabel Container -->
                <div class="grid lg:grid-cols-2 gap-6">
                    <!-- Form Kelola Mata Kuliah -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                        <form action="{{ isset($mataKuliah) ? route('kaprodi.kelolamatkul.update', $mataKuliah->kodemk) : route('kaprodi.kelolamatkul.store') }}" method="POST">
                            @csrf
                            @if (isset($mataKuliah))
                                @method('PUT')
                            @endif

                            <div class="space-y-4">
                                <div>
                                    <label for="prodi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Program Studi</label>
                                    <input 
                                        type="text" 
                                        id="prodi" 
                                        name="prodi" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm 
                                            bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200 
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                        readonly required>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <label for="kodeProdi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kode Prodi</label>
                                        <input 
                                            type="text" 
                                            id="kodeProdi" 
                                            name="kodeProdi" 
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm 
                                                bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200 
                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            readonly required>
                                    </div>

                                    <div class="flex-1">
                                        <label for="kodemkText" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kode Mata Kuliah</label>
                                        <input 
                                            type="text" 
                                            id="kodemkText" 
                                            name="kodemkText" 
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm 
                                                bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200 
                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required>
                                    </div>
                                </div>

                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Mata Kuliah</label>
                                    <input 
                                        type="text" 
                                        id="nama" 
                                        name="nama" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm 
                                            bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                        required>
                                </div>
    
                                <div>
                                    <label for="sks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SKS</label>
                                    <input 
                                        type="number" 
                                        id="sks" 
                                        name="sks" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm 
                                            bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                        required>
                                </div>
    
                                <div>
                                    <label for="semester" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                                    <input 
                                        type="text" 
                                        id="semester" 
                                        name="semester" 
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm 
                                            bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                        required>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 
                                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                        transition-colors duration-200">
                                    {{ isset($mataKuliah) ? 'Update' : 'Simpan' }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Mata Kuliah -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Daftar Mata Kuliah</h2>
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <table class="w-full">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode MK</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">SKS</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Smt</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse ($mata_kuliah as $mk)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $mk->kodemk }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $mk->nama }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $mk->sks }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $mk->semester }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                            <a href="javascript:void(0);" onclick="openEditModal('{{ $mk->kodemk }}', '{{ $mk->nama }}', '{{ $mk->sks }}', '{{ $mk->semester }}')" class="text-yellow-400 dark:text-yellow-400 hover:underline">Edit</a>
                                            <a href="{{ route('kaprodi.kelolamatkul.destroy', $mk->kodemk) }}" class="text-red-600 dark:text-red-600 hover:underline" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $mk->kodemk }}').submit(); }">Delete</a>
                                            
                                            <form id="delete-form-{{ $mk->kodemk }}" action="{{ route('kaprodi.kelolamatkul.destroy', $mk->kodemk) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada mata kuliah tersedia.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal for Editing Mata Kuliah -->
                    <div id="editModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-500 bg-opacity-70 transition-all">
                        <div class="bg-[rgb(215,215,215)] p-8 rounded-lg shadow-lg max-w-md w-full space-y-6">
                            <h3 class="text-2xl font-semibold text-gray-800 ">Edit Mata Kuliah</h3>
                            
                            <form id="editForm" action="{{ route('kaprodi.kelolamatkul.update', ':kodemk') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('POST') <!-- Change the method to PUT for updates -->
                                
                                <input type="hidden" id="kodemk" name="kodemk">
                                
                                <div class="mb-4">
                                    <label for="nama" class="block text-sm text-gray-600">Nama Mata Kuliah</label>
                                    <input type="text" id="nama" name="nama" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="sks" class="block text-sm text-gray-600 ">SKS</label>
                                    <input type="number" id="sks" name="sks" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="semester" class="block text-sm text-gray-600 ">Semester</label>
                                    <input type="text" id="semester" name="semester" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                                </div>
                                
                                <div class="flex justify-end space-x-4">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
                                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>
                                </div>
                            </form>
                            
                            <button onclick="closeEditModal()" class="absolute top-4 right-4 text-gray-600 dark:text-white hover:text-red-500 transition duration-300">X</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
            

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Prodi-to-KodeMK mapping
        const kodeProdiMap = {
            'Informatika': 'PAIK',
            'Biologi': 'PAB',
            'Matematika': 'PAM',
            'Statistika': 'PAS',
            'Kimia': 'PAK',
            'Fisika': 'PAF',
            'Bioteknologi': 'PABT',
        };
    
        // Event listener for prodi buttons
        document.querySelectorAll('.prodi-button').forEach(button => {
            button.addEventListener('click', function () {
                const selectedProdi = this.dataset.prodi; // Mengambil nama prodi
                const kodeProdi = kodeProdiMap[selectedProdi]; // Menentukan kode prodi berdasarkan mapping
    
                // Set Program Studi dan Kode Prodi di form
                document.getElementById('prodi').value = selectedProdi; // Set Program Studi
                document.getElementById('kodeProdi').value = kodeProdi; // Set Kode Prodi
    
                // Debugging: Check values
                console.log('Selected Prodi:', selectedProdi);
                console.log('Generated Kode Prodi:', kodeProdi);
    
                // Hide Prodi Selection and show Form
                const prodiSelection = document.getElementById('prodiSelection');
                const kelolaForm = document.getElementById('kelolaForm');
    
                if (prodiSelection && kelolaForm) {
                    prodiSelection.classList.add('hidden');
                    kelolaForm.classList.remove('hidden');
                } else {
                    console.error('Error: Elements not found!');
                }
            });
        });
    
        // Fungsi untuk submit form kelola mata kuliah
        function submitKelolaMatkul(event) {
            if (event) {
                event.preventDefault(); // Mencegah form dari submit otomatis
            }
    
            const form = document.getElementById('kelolaMatkulForm'); // Pastikan id form benar
            const formData = new FormData(form);
    
            // Validasi form
            if (!validateForm(form)) {
                console.log('Validasi form gagal');
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: 'Harap isi semua data dengan benar.',
                    confirmButtonText: 'OK'
                });
                return;
            }
    
            // Kirim data ke server menggunakan fetch
            fetch('{{ isset($mataKuliah) ? route('kaprodi.kelolamatkul.update', $mataKuliah->kodemk) : route('kaprodi.kelolamatkul.store') }}', {
                method: '{{ isset($mataKuliah) ? "PUT" : "POST" }}',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => {
                // Periksa apakah response adalah sukses
                if (!response.ok) {
                    throw new Error('Server response error');
                }
                return response.json(); // Ubah response menjadi JSON
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Jika berhasil
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message || 'Data mata kuliah berhasil disimpan.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        form.reset(); // Reset form setelah berhasil
                        loadTable(); // Fungsi untuk reload tabel jika diperlukan
                    });
                } else {
                    // Jika gagal
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat menyimpan data.',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Menangani error jika ada masalah di fetch atau server
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan pada server. Harap coba lagi nanti.',
                    confirmButtonText: 'Tutup'
                });
            });
        }

        {{--  document.addEventListener('DOMContentLoaded', function() {
            // Function to open the edit modal
            window.openEditModal = function(kodemk, nama, sks, semester) {
                // Get the modal and form elements
                const modal = document.getElementById('editModal');
                const form = document.getElementById('editForm');
                
                // Populate form fields
                document.getElementById('kodemk').value = kodemk;
                document.getElementById('nama').value = nama;
                document.getElementById('sks').value = sks;
                document.getElementById('semester').value = semester;
                
                // Update form action dynamically
                form.action = form.action.replace(':kodemk', kodemk);
                
                // Show the modal
                modal.classList.remove('hidden');
            }
        
            // Function to close the edit modal
            window.closeEditModal = function() {
                const modal = document.getElementById('editModal');
                modal.classList.add('hidden');
                
                // Reset form and action
                const form = document.getElementById('editForm');
                form.reset();
                form.action = form.action.replace(/\/\d+$/, '/:kodemk');
            }
        
            // Optional: Close modal when clicking outside the modal content
            document.getElementById('editModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeEditModal();
                }
            });
        
            // Optional: Handle form submission with AJAX (recommended for better UX)
            document.getElementById('editForm').addEventListener('submit', function(event) {
                event.preventDefault();
                
                const form = event.target;
                const formData = new FormData(form);
        
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the table row or reload the page
                        alert('Mata Kuliah berhasil diupdate');
                        location.reload(); // Or update the specific row dynamically
                    } else {
                        // Handle errors
                        alert('Gagal mengupdate Mata Kuliah: ' + (data.message || 'Terjadi kesalahan'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim data');
                })
                .finally(() => {
                    closeEditModal();
                });
            });
        });  --}}

        // Modal Edit Functionality (moved outside and merged)
    const editModal = document.getElementById('editModal');
    
    // Function to open the edit modal
    window.openEditModal = function(kodemk, nama, sks, semester) {
        const form = document.getElementById('editForm');
        
        // Populate form fields
        document.getElementById('kodemk').value = kodemk;
        document.getElementById('nama').value = nama;
        document.getElementById('sks').value = sks;
        document.getElementById('semester').value = semester;
        
        // Update form action dynamically
        form.action = form.action.replace(':kodemk', kodemk);
        
        // Show the modal
        editModal.classList.remove('hidden');
    }

    // Function to close the edit modal
    window.closeEditModal = function() {
        editModal.classList.add('hidden');
        
        // Reset form and action
        const form = document.getElementById('editForm');
        form.reset();
        form.action = form.action.replace(/\/\d+$/, '/:kodemk');
    }

    // Close modal when clicking outside the modal content
    if (editModal) {
        editModal.addEventListener('click', function(event) {
            if (event.target === this) {
                closeEditModal();
            }
        });
    }

    // Handle form submission with AJAX
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);
    
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Mata Kuliah berhasil diupdate',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal mengupdate Mata Kuliah',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan saat mengirim data',
                    confirmButtonText: 'Tutup'
                });
            })
            .finally(() => {
                closeEditModal();
            });
        });
    }
    
        // Fungsi validasi sederhana untuk memastikan semua input terisi
        function validateForm(form) {
            const inputs = form.querySelectorAll('input[required]');
            for (let input of inputs) {
                if (!input.value.trim()) {
                    return false;
                }
            }
            return true;
        }
    
        // Menambahkan event listener untuk form submit
        const form = document.getElementById('kelolaMatkulForm');
        if (form) {
            form.addEventListener('submit', submitKelolaMatkul);
        }
    
    
        // Fungsi untuk load tabel mata kuliah (mungkin perlu ditambahkan sesuai kebutuhan)
        function loadTable() {
            // Tambahkan logika untuk me-refresh atau mengambil ulang data tabel jika diperlukan
        }
    });
    
    {{--  function submitForm(event) {
        if (event) {
            event.preventDefault();
        }
    
        const form = document.getElementById('jadwalForm');
        
        if (!validateForm()) {
            console.log('Validasi form gagal');
            return;
        }
    
        const formData = new FormData(form);
    
        fetch('/kaprodi/buatjadwalbaru/store', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData,
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message, 
                    confirmButtonText: 'OK'
                }).then(() => {
                    toggleForm('jadwalForm');
                    loadTable();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Konflik Jadwal',
                    text: data.message || 'Gagal menambahkan data.',
                    confirmButtonText: 'Coba Lagi'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Tangani error khusus untuk konflik jadwal
            if (error.response && error.response.status === 400) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Konflik Jadwal',
                    text: 'Maaf, jadwal bertabrakan dengan jadwal yang sudah ada.',
                    confirmButtonText: 'Tutup'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan saat menambahkan data.',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    }  --}}
    
</script>

