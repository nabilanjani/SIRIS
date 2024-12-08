<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-white leading-tight">
            {{ __('Buat IRS') }}
        </h3>
    </x-slot>

    <div class="flex w-full h-full">
        {{-- Sidebar Data Mahasiswa --}}
        <div class="w-full sm:w-1/4 p-4">
            <div class="bg-white p-4 rounded-lg mb-4 shadow">
                <h1 class="text-lg font-semibold mb-2">SIRIS UNDIP</h1>
                <p class="text-sm">Nama : {{ $mahasiswa->nama }}</p>
                <p class="text-sm">NIM : {{ $mahasiswa->nim }}</p>
                <p class="text-sm">IPS : {{ number_format($ips, 2) }}</p>
                <p class="text-sm">SKS Maksimal: {{ $maksSKS }}</p>
                <p class="text-sm">SKS yang Diambil: {{ $totalSKSdiambil }}</p>
            </div>
            <button onclick="toggleIRSModal()" 
                class="w-full bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700 transition">
            Lihat IRS
            </button>
        </div>

        {{-- Main Content --}}
        <div class="w-full sm:w-3/4 p-4">
            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <strong>Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Pencarian Mata Kuliah --}}
            <input type="text" placeholder="Cari Mata Kuliah" 
                   class="p-2 mb-4 border border-gray-300 rounded w-full focus:ring focus:ring-yellow-400" 
                   oninput="searchTable()">

            {{-- Daftar Mata Kuliah --}}
            <div class="bg-gray-300 p-4 rounded-lg shadow">
                <h2 class="text-black text-lg mb-4">Daftar Mata Kuliah</h2>
                
                <table id="mata-kuliah-table" class="table-auto w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border border-black px-4 py-2">Kode Mata Kuliah</th>
                            <th class="border border-black px-4 py-2">Nama Mata Kuliah</th>
                            <th class="border border-black px-4 py-2">Semester</th>
                            <th class="border border-black px-4 py-2">SKS</th>
                            <th class="border border-black px-4 py-2">Kelas</th>
                            <th class="border border-black px-4 py-2">Waktu</th>
                            <th class="border border-black px-4 py-2">Hari</th>
                            <th class="border border-black px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($jadwal as $mk)
                            <tr>
                                <td class="border border-black px-4 py-2" style="font-size: 14px; white-space: nowrap;">{{ $mk->kodemk }}</td>
                                <td class="border border-black px-4 py-2" style="font-size: 14px; white-space: nowrap;">{{ $mk->namamk }}</td>
                                <td class="border border-black px-4 py-2" style="font-size: 14px; white-space: nowrap;">{{ $mk->semester }}</td>
                                <td class="border border-black px-4 py-2" style="font-size: 14px; white-space: nowrap;">{{ $mk->sks }}</td>
                                <td class="border border-black px-4 py-2" style="font-size: 14px; white-space: nowrap;">{{ $mk->kelas }}</td>
                                <td class="border border-black px-4 py-2" style="font-size: 14px; white-space: nowrap;">
                                    {{ date('H:i', strtotime($mk->mulai)) }} - {{ date('H:i', strtotime($mk->selesai)) }}
                                </td>
                                <td class="border border-black px-4 py-2" style="font-size: 14px; white-space: nowrap;">{{ $mk->hari }}</td>
                                <td class="border border-black px-4 py-2">
                                    {{-- Tombol Tambah --}}
                                    <form action="{{ route('irs.store') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="kodemk" value="{{ $mk->kodemk }}">
                                        <input type="hidden" name="namamk" value="{{ $mk->namamk }}">
                                        <input type="hidden" name="semester" value="{{ $mk->semester }}">
                                        <input type="hidden" name="sks" value="{{ $mk->sks }}">
                                        <input type="hidden" name="kelas" value="{{ $mk->kelas }}">
                                        <input type="hidden" name="mulai" value="{{ date('H:i', strtotime($mk->mulai)) }}">
                                        <input type="hidden" name="selesai" value="{{ date('H:i', strtotime($mk->selesai)) }}">
                                        <input type="hidden" name="hari" value="{{ $mk->hari }}">
                    
                                        <button type="submit" 
                                                class="bg-yellow-200 px-4 py-2 rounded hover:bg-yellow-600 transition"
                                                {{ $totalSKSdiambil + $mk->sks > $maksSKS ? 'disabled' : '' }}>
                                            Tambah
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

    {{-- Lihat IRS --}}
    <div id="irsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-2/3">
            <h2 class="text-lg font-bold mb-4">Mata Kuliah yang Diambil</h2>
            @php
                $irs = App\Models\IRS::all(); // Query ulang data IRS
            @endphp
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border border-black px-4 py-2">Kode Mata Kuliah</th>
                        <th class="border border-black px-4 py-2">Nama Mata Kuliah</th>
                        <th class="border border-black px-4 py-2">Semester</th>
                        <th class="border border-black px-4 py-2">SKS</th>
                        <th class="border border-black px-4 py-2">Kelas</th>
                        <th class="border border-black px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($irs as $mk)
                        <form action="{{ route('irs.delete') }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="kodemk" value="{{ $mk->kodemk }}">
                            <input type="hidden" name="namaMhs" value="{{ $mk->nama }}">
                            <input type="hidden" name="kelas" value="{{ $mk->kelas }}">
                            <tr>
                                <td class="border border-black px-4 py-2">{{ $mk->kodemk }}</td>
                            <td class="border border-black px-4 py-2">{{ $mk->namamk }}</td>
                            <td class="border border-black px-4 py-2">{{ $mk->semester }}</td>
                            <td class="border border-black px-4 py-2">{{ $mk->sks }}</td>
                            <td class="border border-black px-4 py-2">{{ $mk->kelas }}</td>
                            <td class="border border-black px-4 py-2">
                                <button type="submit" 
                                    class="bg-yellow-200 px-4 py-2 rounded hover:bg-yellow-600 transition">
                                    Hapus
                                </button>
                            </td>
                            </tr>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
    
            <div class="flex justify-end mt-4">
                <button onclick="toggleIRSModal()" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    

    {{-- JavaScript --}}
    <script>
        function searchTable() {
            let input = document.querySelector('input[type="text"]');
            let filter = input.value.toLowerCase();
            let rows = document.querySelectorAll('#mata-kuliah-table tbody tr');

            rows.forEach(row => {
                let namaMK = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                row.style.display = namaMK.includes(filter) ? '' : 'none';
            });
        }

        function toggleIRSModal() {
            const modal = document.getElementById('irsModal');
            modal.classList.toggle('hidden');
    }


    </script>
</x-app-layout>
