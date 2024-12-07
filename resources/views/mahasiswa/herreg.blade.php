<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-white leading-tight">
            {{ __('Her-Registrasi') }}
        </h3>
        <h2 class="font-semibold text-xl text-white leading-tight flex justify-center items-center">
            {{ __('Pilih Status Akademik') }}
        </h2>
        <p class="flex justify-center items-center text-white">Silakan pilih salah satu status akademik berikut untuk semester ini</p>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex space-x-4">
                    <!-- Active Status Section -->
                    <div class="flex flex-col w-full space-y-4">
                        <div class="bg-gradient-to-r from-gray-400 to-gray-500 overflow-hidden shadow-sm sm:rounded-lg w-full h-48 flex flex-col justify-center items-center p-4">
                            <div class="text-white text-3xl font-semibold">
                                {{ __("Aktif") }}
                            </div>
                            <div class="text-white text-lg mt-2 text-center">
                                <p>Anda akan mengikuti kegiatan perkuliahan pada semester ini serta mengisi Isian Rencana Studi (IRS).</p>
                            </div>
                            <form action="{{ route('herreg.setAktif', ['nim' => $mahasiswa->nim]) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="w-[500px] py-4 bg-blue-200 text-white rounded-lg text-lg font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    Aktif
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Leave Status Section -->
                    <div class="flex flex-col w-full space-y-4">
                        <div class="bg-gradient-to-r from-gray-400 to-gray-500 overflow-hidden shadow-sm sm:rounded-lg w-full h-48 flex flex-col justify-center items-center p-4">
                            <div class="text-white text-3xl font-semibold">
                                {{ __("Cuti") }}
                            </div>
                            <div class="text-white text-lg mt-2 text-center">
                                <p>Menghentikan kuliah sementara untuk semester ini tanpa kehilangan status sebagai mahasiswa Undip.</p>
                            </div>
                            <form action="{{ route('herreg.setCuti', ['nim' => $mahasiswa->nim]) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="w-[500px] py-4 bg-yellow-200 text-white rounded-lg text-lg font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                    Cuti
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Information Box Section -->
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full h-48 mt-8 p-6">
                    <div class="text-white text-3xl font-semibold">
                        {{ __("Her-Registrasi") }}
                    </div>
                    <div class="text-white text-lg mt-4">
                        <p>Informasi lebih lanjut mengenai her-registrasi, atau mekanisme serta pengajuan penangguhan pembayaran dapat ditanyakan melalui Biro Administrasi Akademik (BAA) atau program studi masing-masing.</p>
                    </div>
                </div>
                <form action="{{ route('herreg.batalkan', ['nim' => $mahasiswa->nim]) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-[1150px] py-4 bg-red-500 text-white rounded-lg text-lg font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Batalkan Status
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
