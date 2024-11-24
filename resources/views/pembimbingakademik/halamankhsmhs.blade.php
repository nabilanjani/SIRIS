<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KHS Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-gray-800 to-blue-900 text-white font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gradient-to-b from-gray-900 to-gray-800 p-6">
            <div class="text-2xl font-bold mb-8">SIRIS UNDIP</div>
            <nav class="space-y-4">
                <a href="/pembimbingakademik/dashboard" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/pembimbingakademik/perwalian" class="flex items-center space-x-2 text-white-400 hover:text-white py-2 px-4 font-bold hover:font-bold active:font-bold">
                    <i class="fas fa-user-friends"></i>
                    <span>Perwalian</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-edit"></i>
                    <span>Input Nilai</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-book"></i>
                    <span>Bimbingan & Ujian</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-400 hover:text-white py-2 px-4">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <!-- Logout-->
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
        <div class="flex-1 p-6 overflow-y-auto">
            <!-- Top Bar -->
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-1/3">
                    <input type="text" placeholder="Search..." class="w-full p-2 rounded-full bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none">
                    <i class="fas fa-search absolute top-2 right-4 text-gray-400"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user"></i>
                        <span>{{$user->akademik?->nama ?? 'Tidak ditemukan' }}</span>
                    </div>
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-bell"></i>
                </div>
            </div>
            <!-- Breadcrumb -->
            <!-- <div class="text-gray-400 mb-6">HOME / IRS</div> -->
            <!-- Content -->
            <div>
                <h1 class="text-2xl font-bold mb-4">KHS Mahasiswa</h1>
                <div class="flex justify-between mb-4">
                <a href="/pembimbingakademik/halamanirsmhs" id="link-irs" class="flex-1 text-center text-gray-400" >IRS</a>
                <a href="/pembimbingakademik/halamankhsmhs" id="link-khs" class="flex-1 text-center border-b-2 border-white pb-2" >KHS</a>
                <a href="/pembimbingakademik/halamantranskripmhs" id="link-transkrip" class="flex-1 text-center text-gray-400">Transkrip</a>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-4">Kartu Hasil Studi (KHS)</h2>
                    <ul class="space-y-4">
                        <!-- Accordion Item 1 -->
                        <li class="border-b border-gray-600 pb-2">
                            <button class="accordion-toggle flex justify-between w-full text-left" onclick="toggleAccordion(this)">
                                <span>Semester-1 | Tahun Ajaran 2022/2023 Ganjil <br> 
                                <span class="text-gray-400 text-sm">Jumlah SKS: 24</span></span>
                                <span class="accordion-icon">+</span> <!-- Ikon di sini -->
                            </button>
                            <div class="accordion-content mt-2 hidden text-gray-400">
                            <div class="flex justify-center items-center">
                           </div>
                                <table class="w-full text-sm text-center text-white">
                                    <thead class="text-sm uppercase bg-gray-800 text-white">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">NO</th>
                                            <th scope="col" class="py-3 px-6">KODE</th>
                                            <th scope="col" class="py-3 px-6">MATA KULIAH</th>
                                            <th scope="col" class="py-3 px-6">JENIS</th>
                                            <th scope="col" class="py-3 px-6">STATUS</th>
                                            <th scope="col" class="py-3 px-6">SKS</th>
                                            <th scope="col" class="py-3 px-6">NILAI HURUF</th>
                                            <th scope="col" class="py-3 px-6">BOBOT</th>
                                            <th scope="col" class="py-3 px-6">SKS x BOBOT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-gray-700 border-b border-gray-700">
                                            <td class="py-4 px-6">1</td>
                                            <td class="py-4 px-6">PAIK6702</td>
                                            <td class="py-4 px-6">Teori Bahasa dan Otomata</td>
                                            <td class="py-4 px-6">PILIHAN</td>
                                            <td class="py-4 px-6">BARU</td>
                                            <td class="py-4 px-6">3</td>
                                            <td class="py-4 px-6">A</td>
                                            <td class="py-4 px-6">4</td>
                                            <td class="py-4 px-6">12</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <span class="text-white text-md font-bold mt-4 block">IP Semester: </span>
                            </div>
                        </li>
                        <!-- Accordion Item 2 -->
                        <li class="border-b border-gray-600 pb-2">
                            <button class="accordion-toggle flex justify-between w-full text-left" onclick="toggleAccordion(this)">
                                <span>Semester-2 | Tahun Ajaran 2022/2023 Genap <br> 
                                <span class="text-gray-400 text-sm">Jumlah SKS: 24</span></span>
                                <span class="accordion-icon">+</span> <!-- Ikon di sini -->
                            </button>
                            <div class="accordion-content mt-2 hidden text-gray-400">
                                <p>Detail mata kuliah:</p>
                                <ul class="pl-4 list-disc">
                                    <li>Fisika Dasar - 3 SKS</li>
                                    <li>Bahasa Inggris - 2 SKS</li>
                                    <li>Matematika II - 3 SKS</li>
                                </ul>
                            </div>
                        </li>
                        <!-- Tambahkan semester lainnya dengan struktur yang sama -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Accordion -->
    <script>
        function toggleAccordion(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector('.accordion-icon');
            content.classList.toggle('hidden');

            // Mengubah ikon
            icon.textContent = content.classList.contains('hidden') ? '+' : '-';
        }
    </script>
</body>
</html>