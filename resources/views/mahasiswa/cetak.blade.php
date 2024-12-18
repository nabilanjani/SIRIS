<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-white leading-tight">
            {{ __('Cetak IRS') }}
        </h3>
    </x-slot>

    <body class="bg-gradient-to-b from-blue-900 to-blue-700 min-h-screen flex flex-col items-center">
        <div class="flex justify-center items-center w-full">
            <!-- Container Utama -->
            <div class="w-full max-w-6xl p-4">
                <!-- Top Navigation -->
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-circle text-white text-2xl"></i>
                            <span class="text-white">
                                Halo! {{ $mahasiswa->first()->nama ?? 'Mahasiswa' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Judul Halaman -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-white">IRS Mahasiswa</h2>
                </div>

                <!-- Data IRS -->
                <div class="container mx-auto p-6 bg-gray-800 rounded-lg shadow-lg">
                    @if($irs->isNotEmpty())
                        <!-- Header Semester -->
                        <div class="text-center mb-6">
                            <h3 class="text-lg font-semibold text-white">
                                Semester {{ $irs->first()->semester ?? '-' }}
                            </h3>
                            <h3 class="text-lg font-semibold text-white">
                                Status IRS {{ $irs->first()->status }}
                            </h3>
                        </div>

                        <!-- Tabel IRS -->
                        <table class="w-full table-auto text-white text-sm border-collapse rounded-lg overflow-hidden">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="p-3 border border-gray-600">No</th>
                                    <th class="p-3 border border-gray-600">Kode MK</th>
                                    <th class="p-3 border border-gray-600">Waktu</th>
                                    <th class="p-3 border border-gray-600">Mata Kuliah</th>
                                    <th class="p-3 border border-gray-600">Kelas</th>
                                    <th class="p-3 border border-gray-600">SKS</th>
                                    <th class="p-3 border border-gray-600">Dosen Pengampu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($irs as $index => $item)
                                    <tr class="hover:bg-gray-700 transition duration-200">
                                        <td class="p-3 text-center border border-gray-600">{{ $index + 1 }}</td>
                                        <td class="p-3 text-center border border-gray-600">{{ $item->kodemk }}</td>
                                        <td class="p-3 text-center border border-gray-600">
                                            {{ $item->hari }}, 
                                            {{ $item->mulai }} - {{ $item->selesai }}
                                        </td>
                                        <td class="p-3 text-center border border-gray-600">{{ $item->namamk }}</td>
                                        <td class="p-3 text-center border border-gray-600">{{ $item->kelas }}</td>
                                        <td class="p-3 text-center border border-gray-600">{{ $item->sks }}</td>
                                        <td class="p-3 text-center border border-gray-600">
                                            {{ optional($item->jadwal)->dosen_pengampu ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center text-white">
                            <p>Data IRS tidak ditemukan untuk semester ini.</p>
                        </div>
                    @endif

                    <!-- Tombol Cetak PDF -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('mahasiswa.cetakpdf') }}"
                           class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow-lg transition duration-300">
                            Cetak PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
