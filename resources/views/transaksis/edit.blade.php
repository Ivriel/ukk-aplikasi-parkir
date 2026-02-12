<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Konfirmasi Keluar Parkir') }} #{{ $transaksi->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <div class="mb-8 border-b border-gray-100 dark:border-gray-700 pb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Detail Parkir</h3>
                    </div>

                    <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-y-6">

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">Plat
                                        Nomor</label>
                                    <p
                                        class="text-xl font-mono font-bold text-gray-900 dark:text-indigo-400 bg-gray-50 dark:bg-gray-900/50 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                                        {{ $transaksi->kendaraan->plat_nomor }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">Nama
                                        Pemilik</label>
                                    <p class="text-lg font-medium text-gray-700 dark:text-gray-200 p-3">
                                        {{ $transaksi->kendaraan->pemilik }}
                                    </p>
                                </div>
                            </div>

                            <hr class="border-gray-100 dark:border-gray-700">

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">Warna
                                        & Jenis</label>
                                    <p class="text-gray-700 dark:text-gray-300">
                                        <span class="font-medium">{{ $transaksi->kendaraan->warna }}</span>
                                        <span class="text-gray-400 mx-1">•</span>
                                        <span class="capitalize">{{ $transaksi->kendaraan->jenis_kendaraan }}</span>
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">Tarif
                                        Per Jam</label>
                                    <p class="text-gray-700 dark:text-gray-300 font-medium">
                                        Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800/50">
                                <label
                                    class="block text-xs font-semibold uppercase tracking-wider text-indigo-500 dark:text-indigo-400 mb-1">Waktu
                                    Masuk</label>
                                <p class="text-lg font-semibold text-indigo-900 dark:text-indigo-200">
                                    {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->format('d M Y, H:i:s') }} <span
                                        class="text-sm font-normal ml-1 text-indigo-400">WIB</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 mt-10">
                            <a href="{{ route('transaksis.index')}}"
                                class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-8 py-3 bg-red-600 hover:bg-red-700 text-white text-sm font-bold uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-red-500/30 active:transform active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="旋17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Tandai Keluar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>