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

            <!-- Title and Button -->
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-bold">Atur Ruangan Program Studi</h1>
                <button type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full flex items-center" 
                    onclick="toggleModal('modaltambahruang')"
                >
                    <i class="fas fa-plus mr-2"></i>Buat Ruangan
                </button>
            </div>

            <!-- Search Bar -->
            <div class="relative mb-5">
                <form action="{{ route('ruang.cari') }}" method="GET">
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

            <!-- Alert Success -->
            @if(session('success'))
                <div class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white p-4 mb-4 rounded shadow-lg w-1/3 text-center z-50 animate-fadeInOut flex items-center justify-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-red-500 text-white p-4 mb-4 rounded shadow-lg w-1/3 text-center z-50 animate-fadeInOut flex items-center justify-center">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tailwind CSS Animation (Fade In and Fade Out) -->
            <style>
                @keyframes fadeInOut {
                    0% {
                        opacity: 1;
                        transform: translateY(0);
                    }
                    80% {
                        opacity: 1;
                        transform: translateY(0);
                    }
                    100% {
                        opacity: 0;
                        transform: translateY(-20px);
                    }
                }

                .animate-fadeInOut {
                    animation: fadeInOut 5s forwards;
                }
            </style>

            <!-- Table -->
            <div class=" bg-gray-700 rounded-lg p-5">
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
                    @if ($ruang_kuliah->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-gray-400">Tidak ada data ditemukan.</td>
                    </tr>
                    @endif
            
                    <tbody>
                        @foreach($ruang_kuliah as $index => $rk)
                        <tr class="border-b border-gray-600">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $rk->kode_ruang }}</td>
                            <td class="p-3">{{ $rk->kapasitas }}</td>
                            <td class="p-3">{{ $rk->programStudi->nama ?? 'Tidak ada Program Studi' }}</td> <!-- Nama Program Studi -->
                            <td class="p-3 flex items-center justify-start space-x-4">  
                                <span class="badge rounded-full 
                                    {{ $rk->status == 1 ? 'bg-green-500' : ($rk->status == 2 ? 'bg-red-500' : 'bg-yellow-400') }} 
                                    text-white py-1 px-3"
                                >
                                    {{ $rk->status == 1 ? 'Diterima' : ($rk->status == 2 ? 'Ditolak' : 'Menunggu') }}
                                </span>
                            </td>
                            <td>
                                <button 
                                    type="button" 
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-1 rounded-full" 
                                    onclick="toggleModal('modaleditruang{{ $rk->kode_ruang }}')"
                                >
                                    Edit
                                </button>
                                <form action="{{ route('ruang.hapus', $rk->kode_ruang) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            onclick="hapusRuang('{{ $rk->kode_ruang }}')" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full">
                                        Delete
                                    </button>
                                </form>
                                
                                <!-- Modal Edit Ruangan -->
                                    <div id="modaleditruang{{ $rk->kode_ruang }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                        <div class="bg-gray-800 rounded-lg w-1/3">
                                            <!-- Modal Header -->
                                            <div class="flex justify-between items-center bg-gray-900 text-white px-6 py-4 rounded-t-lg">
                                                <h5 class="text-lg font-bold">Form Edit Ruangan</h5>
                                                <button class="text-white hover:text-gray-400" onclick="toggleModal('modaleditruang{{ $rk->kode_ruang }}')">&times;</button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="p-6">
                                                <!-- Form Edit Ruangan -->
                                                <form id="formeditruang{{ $rk->kode_ruang }}" action="{{ route('ruang.edit', $rk->kode_ruang) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') <!-- Menandakan bahwa ini adalah permintaan PUT -->
                                                    <div class="mb-4">
                                                        <label for="kode_ruang" class="block text-sm mb-1">Kode Ruang</label>
                                                        <input type="text" id="kode_ruang" name="kode_ruang" value="{{ $rk->kode_ruang }}" class="w-full p-2 rounded bg-gray-700 text-gray-300" readonly>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="kapasitas" class="block text-sm mb-1">Kapasitas</label>
                                                        <input type="number" id="kapasitas" name="kapasitas" value="{{ $rk->kapasitas }}" class="w-full p-2 rounded bg-gray-700 text-gray-300" required>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="id_prodi" class="block text-sm mb-1">Program Studi</label>
                                                        <select id="prodi" name="id_prodi" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none" required>
                                                            <option value="">Pilih Program Studi</option>
                                                            @foreach($prodi as $prodi)
                                                                <option value="{{ $prodi->id_prodi }}" {{ $rk->id_prodi == $prodi->id_prodi ? 'selected' : '' }}>{{ $prodi->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="flex justify-end">
                                                        <button type="button" onclick="submitEditForm('{{ $rk->kode_ruang }}')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Ruangan -->
    <div id="modaltambahruang" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-gray-800 rounded-lg p-6 w-1/3">
            <h3 class="text-lg font-bold mb-4">Form Input Ruangan</h3>
            <!-- Form Tambah Ruangan -->
            <form action="/ruang/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="kode_ruang" class="block text-sm mb-1">Kode Ruang</label>
                    <input type="text" id="kode_ruang" name="kode_ruang" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="kapasitas" class="block text-sm mb-1">Kapasitas</label>
                    <input type="text" id="kapasitas" name="kapasitas" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="id_prodi" class="block text-sm mb-1">Program Studi</label>
                    <select id="prodi" name="id_prodi" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none" required>
                        <option value="">Pilih Program Studi</option>
                        @foreach($prodi as $prodi)
                            <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded" onclick="toggleModal('modaltambahruang')">Tutup</button>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Tambah</button>
                </div>
            </form>
        </div>
    </div>
            
    <!-- Modal edit Ruangan -->
    
    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex'); // Tampilkan modal sebagai flexbox
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex'); // Sembunyikan modal
            }
        }

        function loadTable() {
            fetch('/ruang/data')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('tbody');
                    tableBody.innerHTML = ''; // Hapus isi tabel sebelumnya
                    data.forEach((ruang, index) => {
                        tableBody.innerHTML += `
                            <tr class="border-b border-gray-600">
                                <td class="p-3">${index + 1}</td>
                                <td class="p-3">${ruang.kode_ruang}</td>
                                <td class="p-3">${ruang.kapasitas}</td>
                                <td class="p-3">${ruang.prodi}</td>
                                <td class="p-3 flex space-x-2">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-full">Edit</button>
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full">Delete</button>
                                </td>
                            </tr>`;
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Panggil loadTable() setelah berhasil submit
        function submitForm() {
            const form = document.getElementById('modaltambahruang');
            const formData = new FormData(form);

            fetch("{{ route('ruang.tambah') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data berhasil ditambahkan!');
                        toggleModal('modaltambahruang'); // Tutup modal
                        loadTable(); // Muat ulang tabel
                    } else {
                        alert('Gagal menambahkan data.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menambahkan data.');
                });
        }

        function hapusRuang(kodeRuang) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch(`/ruang/hapus/${kodeRuang}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin' // Tambahkan ini untuk mengirim cookies
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Data berhasil dihapus!');
                window.location.reload();
            } else {
                alert(data.message || 'Gagal menghapus data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data: ' + (error.message || 'Unknown error'));
        });
    }
}

function submitEditForm(kode_ruang) {
    const form = document.getElementById(`formeditruang${kode_ruang}`);
    const formData = new FormData(form);
    
    fetch(`/ruang/edit/${kode_ruang}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Data berhasil diperbarui!');
            window.location.reload();
        } else {
            alert(data.message || 'Gagal memperbarui data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan: ' + error.message);
    });

    return false;
}




    </script>
</body>
</html>
