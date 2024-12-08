<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-white leading-tight">
            {{ __('Akademik') }}
        </h3>
        <h2 class="font-semibold text-xl text-white leading-tight flex justify-center items-center">
            {{ __('Pilih Status Akademik') }}
        </h2>
        <p class="flex justify-center items-center text-white">Silakan pilih salah satu status akademik berikut untuk semester ini</p>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="flex space-x-4">
                    <div class="flex flex-col w-full space-y-4">
                        <div class="bg-gradient-to-r from-gray-400 to-gray-500 overflow-hidden shadow-sm sm:rounded-lg w-full h-80 flex justify-center items-center">
                            <a href="/mahasiswa/cetak">
                            <div class="p-4 text-white text-3xl">
                                {{ __("Lihat IRS") }}
                            </div>
                        </div>
                    </div>
    
                    <div class="bg-gradient-to-r from-gray-400 to-gray-500 overflow-hidden shadow-sm sm:rounded-lg w-full h-80 flex justify-center items-center">
                        <a href="/mahasiswa/irs">
                        <div class="p-4 text-white text-3xl">
                            {{ __("Buat IRS") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>