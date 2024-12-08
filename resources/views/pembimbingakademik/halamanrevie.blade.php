<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa Perwalian</title>
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
            <div>
                <form method="GET" action="{{ route('pembimbingakademik.halamanrevie') }}">
                    @if(request('status_irs'))
                        <input type="hidden" name="status_irs" value="{{ request('status_irs') }}">
                    @endif
                    
                    <div class="mb-4">
                        <div class="mb-4 flex items-center">
                            <span class="mr-2 w-24">Angkatan :</span>
                            <select name="angkatan" class="p-2 rounded bg-gray-700 text-gray-300 w-60">
                                <option value="">--- Pilih Angkatan ---</option>
                                @for($year = 2017; $year <= 2024; $year++)
                                    <option value="{{ $year }}" {{ request('angkatan') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-4 flex items-center">
                            <span class="mr-2 w-24">Prodi :</span>
                            <select name="prodi" class="p-2 rounded bg-gray-700 text-gray-300 w-60">
                                <option value="">--- Pilih Prodi ---</option>
                                @foreach($prodi as $p)
                                    <option value="{{ $p->nama }}" {{ request('prodi') == $p->nama ? 'selected' : '' }}>
                                        {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="mb-2 px-4 py-2 bg-blue-600 rounded text-white">Filter Data</button>
                        <a href="{{ route('pembimbingakademik.resetFilter') }}" class="px-4 py-2 bg-gray-600 rounded text-white">Reset Filter</a>
                    </div>
                </form>
                <div class="flex space-x-4 mb-4">
                    <a href="{{ route('pembimbingakademik.halamanrevie', ['status_irs' => 'belum_irs'] + request()->except('status_irs')) }}" 
                    class="flex flex-col justify-center items-center bg-red-500 text-white px-4 py-2 rounded">
                        Belum IRS <br><strong>{{ $counts['belum_irs'] }}</strong>
                    </a>
                    <a href="{{ route('pembimbingakademik.halamanrevie', ['status_irs' => 'belum_disetujui'] + request()->except('status_irs')) }}" 
                    class="flex flex-col justify-center items-center bg-yellow-500 text-white px-4 py-2 rounded">
                        IRS Belum Disetujui<br><strong>{{ $counts['belum_disetujui'] }}</strong>
                    </a>
                    <a href="{{ route('pembimbingakademik.halamanrevie', ['status_irs' => 'sudah_disetujui'] + request()->except('status_irs')) }}" 
                    class="flex flex-col justify-center items-center bg-green-500 text-white px-4 py-2 rounded">
                        IRS Sudah Disetujui<br><strong>{{ $counts['sudah_disetujui'] }}</strong>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-800 rounded-lg">
                        <thead>
                            <tr class="text-left text-gray-400">
                                <th class="p-4"></th>
                                <th class="p-4">Nama</th>
                                <th class="p-4">NIM</th>
                                <th class="p-4">Prodi</th>
                                <th class="p-4">Angkatan</th>
                                <th class="p-4">Jalur Masuk</th>
                                <th class="p-4">IP Lalu</th>
                                <th class="p-4">Status IRS</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                        @foreach($mahasiswa as $mhs)
                        <tr class="border-b border-gray-700">
                            <td class="p-4 flex items-center space-x-2">
                                <a href="/pembimbingakademik/halamanirsmhs/{{ $mhs->nim }}" class="px-4 py-2 bg-blue-600 rounded text-white inline-block">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                            <td class="p-4">{{ $mhs->nama }}</td>
                            <td class="p-4">{{ $mhs->nim }}</td>
                            <td class="p-4">{{ $mhs->jurusan }}</td>
                            <td class="p-4">{{ $mhs->angkatan }}</td>
                            <td class="p-4">{{ $mhs->jalur_masuk }}</td>
                            <td class="p-4">
                                @if($mhs->irs->count() > 0)
                                    {{ number_format($mhs->ips, 2) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="p-4">
                            @if($mhs->irs->count() > 0)
                            @if($mhs->irs->first()->status === 'disetujui')
                                <span class="block px-2 py-1 bg-green-500 rounded text-white w-full text-center font-bold">
                                    Disetujui
                                </span>
                            @elseif($mhs->irs->first()->status === 'pending')
                                <span class="block px-2 py-1 bg-yellow-500 rounded text-white w-full text-center font-bold">
                                    Belum Disetujui
                                </span>
                            @endif
                        @else
                            <span class="block px-2 py-1 bg-red-500 rounded text-white w-full text-center font-bold">Belum IRS</span>
                        @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>