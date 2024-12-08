<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IRS Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-b from-[#141B46] to-[#3143AC] text-white font-sans">
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
                <a href="{{ route('profile.show') }}" class="flex items-center space-x-2 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-user-circle text-xl"></i>
                    <span>{{ $user->akademik?->nama }}</span>
                </a> 
                    <i class="fas fa-cog"></i>
                    <i class="fas fa-bell"></i>
                </div>
            </div>
            <!-- Alert Success -->
            @if(session('success'))
            <div id="alert-success" class="mb-6 bg-green-500 text-white p-4 rounded-lg flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="closeAlert()" class="text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif
            <!-- Content -->
            <div>
                <h1 class="text-2xl font-bold mb-4">IRS Mahasiswa</h1>
                <div class="flex justify-between mb-4">
                <a href="/pembimbingakademik/halamanirsmhs" id="link-irs" class="flex-1 text-center border-b-2 border-white pb-2" >IRS</a>
                <a href="/pembimbingakademik/halamankhsmhs" id="link-khs" class="flex-1 text-center text-gray-400" >KHS</a>
                <a href="/pembimbingakademik/halamantranskripmhs" id="link-transkrip" class="flex-1 text-center text-gray-400">Transkrip</a>
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-4">Isian Rencana Semester (IRS)</h2>
                    <ul class="space-y-4">
                        @php
                            $smtnow = $mhs->semester;
                            $allSemesters = range(1, $smtnow);
                        @endphp
                        @foreach ($allSemesters as $semester)
                            <li class="border-b border-gray-600 pb-2">
                                <button class="accordion-toggle flex justify-between w-full text-left" onclick="toggleAccordion(this)">
                                    <span>Semester - {{ $semester }}</span>
                                    <span class="accordion-icon">+</span>
                                </button>
                                <div class="accordion-content mt-2 hidden text-gray-400">
                                    @if ($dataIRS->where('semester', $semester)->count() > 0)
                                        <div class="flex justify-center items-center">
                                            <div class="text-lg font-bold mb-4 text-white">
                                                @if($statusIRS == 'pending')
                                                    IRS MAHASISWA (BELUM DISETUJUI WALI)
                                                @else
                                                    IRS MAHASISWA (SUDAH DISETUJUI WALI)
                                                @endif
                                            </div>
                                        </div>
                                        <table class="w-full text-sm text-center text-white">
                                            <thead class="text-xs uppercase bg-gray-800 text-white">
                                                <tr>
                                                    <th scope="col" class="py-3 px-6">NO</th>
                                                    <th scope="col" class="py-3 px-6">KODE MK</th>
                                                    <th scope="col" class="py-3 px-6">WAKTU</th>
                                                    <th scope="col" class="py-3 px-6">MATA KULIAH</th>
                                                    <th scope="col" class="py-3 px-6">KELAS</th>
                                                    <th scope="col" class="py-3 px-6">SKS</th>
                                                    <th scope="col" class="py-3 px-6">DOSEN PENGAMPU</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataIRS->where('semester', $semester) as $index => $item)
                                                    <tr class="bg-gray-700 border-b border-gray-600 hover:bg-gray-600">
                                                        <td class="py-4 px-6">{{ $index + 1 }}</td>
                                                        <td class="py-4 px-6">{{ $item->kodemk }}</td>
                                                        <td class="py-4 px-6">{{ $item->hari}}, {{ $item->mulai}}-{{ $item->selesai}}</td>
                                                        <td class="py-4 px-6">{{ $item->namamk }}</td>
                                                        <td class="py-4 px-6">{{ $item->kelas }}</td>
                                                        <td class="py-4 px-6">{{ $item->sks }}</td>
                                                        <td class="text-left py-4 px-6">{{ $item->jadwal->dosen_pengampu ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="flex justify-center space-x-4 mt-6">
                                            <button class="bg-green-500 text-white px-4 py-2 rounded-full" onclick="showConfirmationModal()">Setujui IRS</button>
                                            <button class="bg-yellow-500 text-white px-4 py-2 rounded-full">Berikan Izin Melakukan Perubahan IRS</button>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <p>Tidak ada data IRS untuk semester {{ $semester }}</p>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white text-black p-6 rounded-lg w-1/3">
                            <h2 class="text-xl font-bold mb-4">Konfirmasi</h2>
                            <p class="mb-4">Apakah Anda yakin ingin menyetujui IRS ini?</p>
                            <div class="flex justify-between">
                                <button class="bg-red-500 text-white px-4 py-2 rounded-full" onclick="hideConfirmationModal()">Batal</button>
                                @foreach ($dataIRS->groupBy('semester') as $semester => $irsInSemester)
                                    <form action="{{ route('pembimbingakademik.approveIrs', $semester) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-full">
                                            Setujui
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
    <script>
        function toggleAccordion(element) {
            const content = element.nextElementSibling;
            const icon = element.querySelector('.accordion-icon');
            content.classList.toggle('hidden');
            icon.textContent = content.classList.contains('hidden') ? '+' : '-';
        }

        function showConfirmationModal() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function hideConfirmationModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        function closeAlert() {
            document.getElementById('alert-success').style.display = 'none';
        }
    </script>
</body>
</html>