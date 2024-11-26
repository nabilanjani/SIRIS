<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-white leading-tight">
            {{ __('Buat IRS') }}
        </h3>
    </x-slot>

    <div class="flex w-full h-full">
        {{-- Sidebar Data Mahasiswa --}}
        <div class="w-1/4 p-4">
            <div class="bg-white p-4 rounded-lg mb-4">
                <h1 class="text-lg font-semibold mb-2">SIRIS UNDIP</h1>
                <p class="text-xs">Nama : {{ auth()->user()->mahasiswa->nama }}</p>
                <p class="text-xs">NIM : {{ auth()->user()->mahasiswa->nim }}</p>
                <p class="text-xs">IPK : {{ auth()->user()->mahasiswa->ipk }}</p>
                <p class="text-xs">IPS : {{ auth()->user()->mahasiswa->ips }}</p>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="w-3/4 p-4">
            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Daftar Mata Kuliah --}}
            <div class="bg-gray-700 p-4 rounded-lg">
                <h2 class="text-white text-lg mb-4">Daftar Mata Kuliah</h2>
                <table class="table-auto w-full text-gray-300 text-sm">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Kode MK</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Semester</th>
                            <th class="border px-4 py-2">SKS</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mataKuliah as $mk)
                            <tr>
                                <td class="border px-4 py-2">{{ $mk->kodemk }}</td>
                                <td class="border px-4 py-2">{{ $mk->nama }}</td>
                                <td class="border px-4 py-2">{{ $mk->semester }}</td>
                                <td class="border px-4 py-2">{{ $mk->sks }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('irs.tambah') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="nim" value="{{ auth()->user()->mahasiswa->nim }}">
                                        <input type="hidden" name="kodemk" value="{{ $mk->kodemk }}">
                                        <button type="submit" class="bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">
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
</x-app-layout>
