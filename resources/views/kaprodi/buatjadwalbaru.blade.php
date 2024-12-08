<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <div 
                        class="bg-[rgba(255,255,255,0.2)] rounded-lg p-4 flex justify-between items-center hover:bg-[rgba(255,255,255,0.3)] transition"
                    >
                        <span>{{ $namaProdi }}</span>
                        <button type="button" data-prodi="{{ $namaProdi }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm prodi-button">Buat Jadwal
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            

            <!-- Schedule Table -->
            <div id="scheduleManagement" class="hidden">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Jadwal Prodi</h1>
                    <button 
                        onclick="resetSchedule()" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm"
                    >
                        Kembali ke Pilih Prodi
                    </button>
                </div>
                <div class="bg-[rgba(255,255,255,0.2)] rounded-lg overflow-hidden">
                    <table class="w-full text-gray-300">
                        <thead>
                            <tr class="bg-gray-800">
                                <th class="p-2">Senin 
                                    <button onclick="toggleForm('Senin')" class="text-yellow-400 hover:text-yellow-600">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </th>
                                <th class="p-2">Selasa 
                                    <button onclick="toggleForm('Selasa')" class="text-yellow-400 hover:text-yellow-600">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </th>
                                <th class="p-2">Rabu 
                                    <button onclick="toggleForm('Rabu')" class="text-yellow-400 hover:text-yellow-600">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </th>
                                <th class="p-2">Kamis 
                                    <button onclick="toggleForm('Kamis')" class="text-yellow-400 hover:text-yellow-600">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </th>
                                <th class="p-2">Jumat 
                                    <button onclick="toggleForm('Jumat')" class="text-yellow-400 hover:text-yellow-600">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="schedule-Senin" class="p-2"></td>
                                <td id="schedule-Selasa" class="p-2"></td>
                                <td id="schedule-Rabu" class="p-2"></td>
                                <td id="schedule-Kamis" class="p-2"></td>
                                <td id="schedule-Jumat" class="p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

    <!-- Pop-up Form for Adding Schedule -->
    <div id="jadwalFormPopup" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-[#1E255E] p-8 rounded-lg w-1/2">
            <h2 class="text-2xl font-bold mb-4 text-white">Form Pengisian Jadwal</h2>
            <form id="jadwalForm" method="POST" action="/kaprodi/buatjadwalbaru/store">
            @csrf
            <input type="hidden" id="hari" name="hari" value="">
            <div class="grid grid-cols-2 gap-4">
                <!-- Form Fields -->
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Program Studi</label>
                    <span class="text-white">:</span>
                    <input type="text" name="prodi" id="prodiInput" readonly class="w-full p-2 bg-gray-600 rounded">
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Mata kuliah</label>
                    <span class="text-white">:</span>
                    <select name="mata_kuliah" class="bg-gray-600 text-white rounded px-2 py-1 w-54">
                        <option>Pilih Matkul</option>
                        @if(!empty($mata_kuliah) && $mata_kuliah->count())
                            @foreach ($mata_kuliah as $matkul)
                                <option value="{{ $matkul->kodemk }}" {{ request('mata_kuliah') == $matkul->kodemk ? 'selected' : '' }}>
                                    {{ $matkul->namamk }}
                                </option>
                            @endforeach
                        @else
                            <option value="">Tidak ada mata kuliah tersedia</option>
                        @endif

                    </select>
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Jenis mata kuliah</label>
                    <span class="text-white">:</span>
                    <select name="jenis_mata_kuliah" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option value="">Pilih Jenis MK</option>
                        <option value="wajib" {{ old('jenis_mata_kuliah') == 'wajib' ? 'selected' : '' }}>Wajib</option>
                        <option value="pilihan" {{ old('jenis_mata_kuliah') == 'pilihan' ? 'selected' : '' }}>Pilihan</option>
                    </select>
                </div>
                
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Jenis pertemuan</label>
                    <span class="text-white">:</span>
                    <select name="jenis_pertemuan" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option value="">Pilih Jenis Pert</option>
                        <option value="tatap_muka" {{ old('jenis_pertemuan') == 'tatap_muka' ? 'selected' : '' }}>Tatap Muka</option>
                        <option value="online" {{ old('jenis_pertemuan') == 'online' ? 'selected' : '' }}>Online</option>
                    </select>
                </div>
                
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Jenis kelas</label>
                    <span class="text-white">:</span>
                    <select name="jenis_kelas" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option value="">Pilih Jenis Kls</option>
                        <option value="reguler" {{ old('jenis_kelas') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="iup" {{ old('jenis_kelas') == 'iup' ? 'selected' : '' }}>IUP</option>
                    </select>
                </div>
                
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Kelas</label>
                    <span class="text-white">:</span>
                    <select name="kelas" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Kelas</option>
                        <option value="A" {{ old('kelas') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('kelas') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('kelas') == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('kelas') == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">SKS</label>
                    <span class="text-white">:</span>
                    <select name="sks" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih SKS</option>
                        @for($sks = 1; $sks <= 4; $sks++)
                                <option value="{{ $sks }}" {{ request('sks') == $sks ? 'selected' : '' }}>
                                    {{ $sks }}
                                </option>
                        @endfor
                    </select>
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Semester</label>
                    <span class="text-white">:</span>
                    <select id="semester" name="semester" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Semester</option>
                        @for($smt = 1; $smt <= 14; $smt++)
                                <option value="{{ $smt }}" {{ request('smt') == $smt ? 'selected' : '' }}>
                                    {{ $smt }}
                                </option>
                        @endfor
                    </select>
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Ruang kuliah</label>
                    <span class="text-white">:</span>
                    <select name="ruang_kuliah" id="ruangKuliah" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option value="" data-kapasitas="0">Pilih Ruangan</option>
                        @if(!empty($ruang_kuliah) && $ruang_kuliah->count())
                            @foreach ($ruang_kuliah as $rk)
                                <option value="{{ $rk->kode_ruang }}" data-kapasitas="{{ $rk->kapasitas }}">
                                    {{ $rk->kode_ruang }}
                                </option>
                            @endforeach
                        @else
                            <option value="" data-kapasitas="0">Tidak ada ruang kuliah tersedia</option>
                        @endif
                    </select>
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Dosen Pengampu</label>
                    <span class="text-white">:</span>
                    <select name="dosen_pengampu" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option value="">Pilih Dosen</option>
                            @if($dosen->count())
                                @foreach ($dosen as $d)
                                    <option value="{{ $d->nip }}">
                                        {{ $d->nama }}
                                    </option>
                                @endforeach
                            @else
                                <option value="">Tidak ada dosen tersedia</option>
                            @endif
                    </select>
                </div>                
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Koordinator</label>
                    <span class="text-white">:</span>
                    <select name="koordinator" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Koor</option>
                        @if(!empty($dosen) && $dosen->count())
                            @foreach ($dosen as $d)
                                <option value="{{ $d->nip }}" {{ request('dosen') == $d->nip ? 'selected' : '' }}>
                                    {{ $d->nama }}
                                </option>
                            @endforeach
                        @else
                            <option value="">Tidak ada dosen tersedia</option>
                        @endif
                    </select>
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Hari</label>
                    <span class="text-white">:</span>
                    <input type="text" id="hariDisplay" class="bg-gray-600 text-white rounded px-2 py-1 w-40" readonly>
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Mulai</label>
                    <span class="text-white">:</span>
                    <input type="time" name="mulai" class="bg-gray-600 text-white rounded px-2 py-1 w-40" placeholder="-- : --">
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Selesai</label>
                    <span class="text-white">:</span>
                    <input type="time" name="selesai" class="bg-gray-600 text-white rounded px-2 py-1 w-30" placeholder="-- : --">
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Kuota</label>
                    <span class="text-white">:</span>
                    <input name="kuota" id="kuota" type="text" class="bg-gray-600 text-white rounded px-2 py-1">
                </div>
                <div class="grid grid-cols-[100px_1fr_200px] gap-4 items-center">
                    <label class="text-white">Kurikulum</label>
                    <span class="text-white">:</span>
                    <select name="kurikulum" class="bg-gray-600 text-white rounded px-2 py-1">
                        <option>Pilih Kurikulum</option>
                        <option value="Kurikulum 2017" {{ old('kurikulum') == '2017' ? 'selected' : '' }}>Kurikulum 2017</option>
                        <option value="Kurikulum 2020" {{ old('kurikulum') == '2020' ? 'selected' : '' }}>Kurikulum 2020</option>
                    </select>
                </div>

                <div class="col-span-2 flex justify-end space-x-4 mt-4">
                    <button type="submit" name="submit" value="submit" class="bg-green-500 text-white rounded px-4 py-2" onClick="submitForm(event)">Submit</button>
                    <button type="reset" class="bg-red-500 text-white rounded px-4 py-2">Reset</button>
                    <button type="button" class="text-white px-4 py-2" onclick="toggleForm()">Cancel</button>
                </div>
            </div>
        </div>
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>

    <!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi utama untuk mengaktifkan jadwal
        window.showJadwal = function (namaProdi) {
            console.log(`Mengaktifkan jadwal untuk: ${namaProdi}`);
    
            // Simpan nama prodi di sessionStorage
            sessionStorage.setItem('selectedProdi', namaProdi);
    
            // Sembunyikan halaman pemilihan prodi
            document.getElementById('prodiSelection').classList.add('hidden');
    
            // Tampilkan area manajemen jadwal
            const scheduleManagement = document.getElementById('scheduleManagement');
            scheduleManagement.classList.remove('hidden');
    
            // Update judul
            scheduleManagement.querySelector('h1').textContent = `Jadwal ${namaProdi}`;
    
            // Set Prodi di input form
            const prodiInput = document.getElementById('prodiInput');
            if (prodiInput) {
                prodiInput.value = namaProdi;
            }
    
            // Bersihkan jadwal sebelumnya
            const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            days.forEach(day => {
                document.getElementById(`schedule-${day}`).innerHTML = '';
            });
    
            // Ambil jadwal dari backend
            fetch(`/prodi/${namaProdi}/jadwal`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil jadwal');
                    }
                    return response.json();
                })
                .then(jadwal => {
                    const jadwalByDay = {
                        'Senin': [],
                        'Selasa': [],
                        'Rabu': [],
                        'Kamis': [],
                        'Jumat': []
                    };
    
                    jadwal.forEach(item => {
                        if (jadwalByDay[item.hari]) {
                            jadwalByDay[item.hari].push(item);
                        }
                    });
    
                    Object.keys(jadwalByDay).forEach(day => {
                        const dayCell = document.getElementById(`schedule-${day}`);
                        if (jadwalByDay[day].length > 0) {
                            const jadwalHtml = jadwalByDay[day].map(jadwal => `
                                <div class="schedule-box">
                                    <p class="font-bold">${jadwal.mata_kuliah}</p>
                                    <p class="text-sm">
                                        ${jadwal.kelas} | ${jadwal.mulai} - ${jadwal.selesai}
                                    </p>
                                </div>
                            `).join('');
                            dayCell.innerHTML = jadwalHtml;
                        } else {
                            dayCell.innerHTML = '<p class="text-gray-500">Tidak ada jadwal</p>';
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    days.forEach(day => {
                        const dayCell = document.getElementById(`schedule-${day}`);
                        dayCell.innerHTML = `
                            <p class="text-red-500">
                                Gagal memuat jadwal: ${error.message}
                            </p>
                        `;
                    });
                });
        };

        // Periksa apakah ada prodi yang tersimpan di sessionStorage
        const savedProdi = sessionStorage.getItem('selectedProdi');
        if (savedProdi) {
            showJadwal(savedProdi);
        }
    
        // Tambahkan event listener pada tombol di prodiSelection
        const prodiButtons = document.querySelectorAll('.prodi-button');
        prodiButtons.forEach(button => {
            button.addEventListener('click', function () {
                const namaProdi = this.getAttribute('data-prodi');
                showJadwal(namaProdi);
            });
        });
    
        // Fungsi untuk mereset jadwal
        window.resetSchedule = function () {
            sessionStorage.removeItem('selectedProdi');
            document.getElementById('prodiSelection').classList.remove('hidden');
            document.getElementById('scheduleManagement').classList.add('hidden');
        };
    });
    
    
    
        // Fungsi untuk menutup form pengisian jadwal
        function closeForm() {
            const formPopup = document.getElementById('jadwalFormPopup');
            formPopup.classList.add('hidden');
        }

    // Validasi Form
    function submitForm(event) {
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
    }
    
    
    // Tambahkan validasi form
    function validateForm() {
        const requiredFields = document.querySelectorAll('select[required], input[required]');
        let isValid = true;
    
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                console.log('Field tidak valid:', field);
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
    
        return isValid;
    }
    
    
    // Tambahkan event listener
    document.getElementById('jadwalForm').addEventListener('submit', submitForm);

    document.addEventListener('DOMContentLoaded', function () {
        const ruangKuliahSelect = document.getElementById('ruangKuliah');
        const kuotaInput = document.getElementById('kuota');

        ruangKuliahSelect.addEventListener('change', function () {
            // Get the selected option
            const selectedOption = this.options[this.selectedIndex];

            // Get kapasitas from the selected option's data attribute
            const kapasitas = selectedOption.getAttribute('data-kapasitas') || '';

            // Set the value of the kuota input
            kuotaInput.value = kapasitas;
        });
    });
    

    function toggleForm(hari) {
        console.log("Form pengisian jadwal untuk hari:", hari); // Debug

        const form = document.getElementById('jadwalFormPopup');
        form.classList.toggle('hidden');
    
        // Set nilai hari di input tersembunyi
        const hariInput = document.getElementById('hari');
        if (hariInput) {
            hariInput.value = hari;
        }

        // Set nilai nama hari di input yang tampil (display)
        const hariDisplay = document.getElementById('hariDisplay');
        if (hariDisplay) {
            hariDisplay.value = hari; // Menampilkan nama hari pada input yang tampil
        }
    
        if (form.classList.contains('hidden')) {
            document.getElementById('jadwalForm').reset();
        }
    }

    function closeForm() {
        const formPopup = document.getElementById('jadwalFormPopup');
        formPopup.classList.add('hidden');
    }
</script>

</body>
</html>