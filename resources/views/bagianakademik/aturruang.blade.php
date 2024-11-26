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
                        <span>AHMAD BRIAN</span>
                    </div>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-bell"></i>
                </div>
            </div>

            <!-- Title and Button -->
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-bold">Atur Ruangan Program Studi</h1>
                <button type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full flex items-center" 
                        onclick="toggleModal('modaltambahruang')">
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


            <!-- Table -->
            <div class="bg-gray-700 rounded-lg p-5">
                <table class="w-full table-auto text-left text-gray-300">
                    <thead>
                        <tr class="bg-gray-800">
                            <th class="p-3">No</th>
                            <th class="p-3">Kode Ruangan</th>
                            <th class="p-3">Kondisi</th>
                            <th class="p-3">Jenis Ruang</th>
                            <th class="p-3">Kapasitas</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    @if ($ruang_kuliah->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-gray-400">Tidak ada data ditemukan.</td>
                </tr>
            @endif
                    <tbody>
                        @foreach ($ruang_kuliah as $index => $rk)
                        <tr class="border-b border-gray-600">
                            <td class="p-3">{{ $index + $ruang_kuliah->firstItem() }}</td>
                            <td class="p-3">{{ $rk->kode_ruang }}</td>
                            <td class="p-3">{{ $rk->kondisi }}</td>
                            <td class="p-3">{{ $rk->jenis_ruang }}</td>
                            <td class="p-3">{{ $rk->kapasitas }}</td>
                            <td class="p-3 flex space-x-2">
                            <button 
                                type="button" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-full" 
                                onclick="toggleModal('modaleditruang{{ $rk->kode_ruang }}')"
                            >
                                Edit
                            </button>

                            <!-- Awal Modal EDIT Ruangan -->
                            <div
                                id="modaleditruang{{ $rk->kode_ruang }}"
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
                            >
                                <div class="bg-gray-800 rounded-lg w-1/3">
                                <!-- Modal Header -->
                                    <div class="flex justify-between items-center bg-gray-900 text-white px-6 py-4 rounded-t-lg">
                                    <h5 class="text-lg font-bold">Form Edit Ruangan</h5>
                                        <button
                                        class="text-white hover:text-gray-400"
                                        onclick="toggleModal('modaleditruang{{ $rk->kode_ruang }}')"
                                        >
                                        &times;
                                        </button>
                                </div>

                                <!-- Modal Body -->
                                    <div class="p-6">
                                        <form
                                            id="formeditruang{{ $rk->kode_ruang }}"
                                            action="{{ route('ruang.edit', $rk->kode_ruang) }}" 
                                            method="POST"
                                            enctype="multipart/form-data"
                                        >
                                    @csrf
                                    {{ method_field('PUT') }}

                                    <div class="mb-4">
                                    <label for="kode_ruang" class="block text-sm text-gray-300">Kode Ruang</label>
                                    <input
                                        type="text"
                                        id="kode_ruang"
                                        name="kode_ruang"
                                        value="{{ $rk->kode_ruang }}"
                                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none"
                                    />
                                    </div>

                                    <div class="mb-4">
                                        <label for="kondisi" class="block text-sm text-gray-300">Kondisi Ruang</label>
                                        <input
                                            type="text"
                                            id="kondisi"
                                            name="kondisi"
                                            value="{{ $rk->kondisi }}"
                                            class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label for="jenis_ruang" class="block text-sm text-gray-300">Jenis Ruangan</label>
                                        <input
                                            type="text"
                                            id="jenis_ruang"
                                            name="jenis_ruang"
                                            value="{{ $rk->jenis_ruang }}"
                                            class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none"
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label for="kapasitas" class="block text-sm text-gray-300">Kapasitas</label>
                                        <input
                                            type="number"
                                            id="kapasitas"
                                            name="kapasitas"
                                            value="{{ $rk->kapasitas }}"
                                            class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none"
                                        />
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="flex justify-end space-x-2">
                                        <button
                                            type="button"
                                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600"
                                            onclick="toggleModal('modaleditruang{{ $rk->kode_ruang }}')"
                                        >
                                            Tutup
                                        </button>
                                        <button
                                            type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"
                                        >
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        <!-- Akhir Modal EDIT Ruangan -->

                                        <form action="{{ route('ruang.hapus', $rk->kode_ruang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full">
                                                Delete
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

    <!-- Modal Tambah Ruangan -->
    <div id="modaltambahruang" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-gray-800 rounded-lg p-6 w-1/3">
            <h3 class="text-lg font-bold mb-4">Form Input Ruangan</h3>
            <form action="/ruang/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="kode_ruang" class="block text-sm mb-1">Kode Ruang</label>
                    <input type="text" id="kode_ruang" name="kode_ruang" class="w-full p-2 rounded bg-gray-700 text-gray-300 focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="kondisi" class="block text-sm mb-1">Kondisi</label>
                    <input type="text" id="kondisi" name="kondisi" class="w-full p-2 rounded bg-gray-700 text-gray-300 focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="jenis_ruang" class="block text-sm mb-1">Jenis Ruang</label>
                    <input type="text" id="jenis_ruang" name="jenis_ruang" class="w-full p-2 rounded bg-gray-700 text-gray-300 focus:outline-none">
                </div>
                <div class="mb-4">
                    <label for="kapasitas" class="block text-sm mb-1">Kapasitas</label>
                    <input type="text" id="kapasitas" name="kapasitas" class="w-full p-2 rounded bg-gray-700 text-gray-300 focus:outline-none">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded" onclick="toggleModal('modaltambahruang')">Tutup</button>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" onclick="submitForm()">Tambah</button>
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
                        <td class="p-3">${ruang.kondisi}</td>
                        <td class="p-3">${ruang.jenis_ruang}</td>
                        <td class="p-3">${ruang.kapasitas}</td>
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

            fetch('/ruang/tambah', {
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
        fetch(`/ruang/hapus/${kodeRuang}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal menghapus data.');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Data berhasil dihapus!');
                location.reload(); // Muat ulang halaman atau tabel
            } else {
                alert('Gagal menghapus data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data.');
        });
    }
}

            function submitEditForm(kodeRuang) {
                // Ambil form modal berdasarkan ID modal yang aktif
                const form = document.getElementById(`formeditruang${kodeRuang}`);
                const formData = new FormData(form);

                // Kirim request AJAX
                fetch(`/ruang/edit/${kodeRuang}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-HTTP-Method-Override': 'PUT', // Override untuk metode PUT
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Ruangan berhasil diperbarui!');
                        toggleModal(`modaleditruang${kodeRuang}`); // Tutup modal
                        loadTable(); // Muat ulang tabel
                    } else {
                        alert('Gagal memperbarui ruangan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui ruangan.');
                });
            }
    </script>
</body>
</html>
