<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-white leading-tight">
            {{ __('Buat IRS') }}
        </h3>
    </x-slot>

    <body class="bg-gradient-to-r from-blue-900 to-indigo-900 text-white h-screen flex">
        <div class="flex w-full h-full">
            {{-- Data Mahasiswa --}}
            <div class="w-1/4 p-4">
                <div class="bg-white p-4 rounded-lg mb-4">
                    <h1 class="text-lg font-semibold mb-2">SIRIS UNDIP</h1>
                    <p class="text-xs">Nama : NABILA BETARI ANJANI</p>
                    <p class="text-xs">NIM : 24060122140169</p>
                    <p class="text-xs">Th. Ajaran : 2024/2025</p>
                    <p class="text-xs">Ganjil/Genap : GANJIL</p>
                    <p class="text-xs">Matakuliah prioritas : SMT 4</p>
                    <p class="text-xs">IPk : 4,00</p>
                    <p class="text-xs">IPS (semester lalu) : 4,00</p>
                    <p class="text-xs">Max. Beban SKS (saat ini) : 24</p>
                </div>
                <button class="bg-white w-full py-2 rounded-lg mb-4 text-xs">Refresh IRS</button>
                <button class="bg-white w-full py-2 rounded-lg mb-4 text-xs">Cari Mata Kuliah</button>
                <button class="bg-white w-full py-2 rounded-lg text-xs">Mata Kuliah Terpilih</button>
            </div>

            {{-- Main Content Jadwal --}}
            <div class="w-3/4 p-4">
                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="grid grid-cols-6 gap-2 text-left text-gray-300 text-xs">
                        <div>Waktu</div>
                        <div>Senin</div>
                        <div>Selasa</div>
                        <div>Rabu</div>
                        <div>Kamis</div>
                        <div>Jumat</div>
                    </div>
                    <!-- The timetable content goes here -->
                    <div class="grid grid-cols-6 gap-2 mt-2 text-left text-gray-300 text-xs">
                        <div>06.00</div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="grid grid-cols-6 gap-2 mt-2 text-left text-gray-300 text-xs">
                        <div>07.00</div>
                        <div class="bg-yellow-400 text-black p-2 rounded-lg">
                            <p>Teori Bahasa dan Otomata</p>
                            <p>WAJIB (KM2020)</p>
                            <p>(SMT 7) (3 SKS)</p>
                            <p>Kelas: C 3/3 SKS</p>
                            <p>07:00 - 09:30</p>
                        </div>
                        <div></div>
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <p>Komputasi Tersebar dan Paralel</p>
                            <p>WAJIB (KM2020)</p>
                            <p>(SMT 5) (3 SKS)</p>
                            <p>Kelas: C 3/3 SKS</p>
                            <p>07:00 - 09:30</p>
                        </div>
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <p>Proyek Perangkat Lunak</p>
                            <p>WAJIB (KM2020)</p>
                            <p>(SMT 5) (3 SKS)</p>
                            <p>Kelas: C 3/3 SKS</p>
                            <p>07:00 - 09:30</p>
                        </div>
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <p>Sistem Informasi</p>
                            <p>WAJIB (KM2020)</p>
                            <p>(SMT 5) (3 SKS)</p>
                            <p>Kelas: C 3/3 SKS</p>
                            <p>07:00 - 09:30</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-6 gap-2 mt-2 text-left text-gray-300 text-xs">
                        <div>08.00</div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div class="bg-blue-900 p-2 rounded-lg">
                            <p>Pengembangan Berbasis Proyek</p>
                            <p>WAJIB (KM2020)</p>
                            <p>(SMT 5) (3 SKS)</p>
                            <p>Kelas: C 3/3 SKS</p>
                            <p>07:00 - 09:30</p>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>