<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">

                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Transaksi
                                #{{ $transaction->id }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Informasi lengkap transaksi parkir
                            </p>
                        </div>
                        <a href="{{ route('transaksis.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali
                        </a>
                    </div>
                </div>

                <div class="p-6 space-y-6">

                    <div
                        class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-5 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Kendaraan</h4>
                        <div class="grid    grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Plat Nomor</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->kendaraan->plat_nomor }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Jenis Kendaraan</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->kendaraan->jenis_kendaraan }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Pemilik</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->kendaraan->pemilik }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Warna</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->kendaraan->warna }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-5 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Parkir</h4>
                        <div class="grid    grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Area Parkir</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->area->nama_area }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tarif per Jam</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">Rp
                                    {{ number_format($transaction->tarif->tarif_per_jam, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Jenis Kendaraan</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->tarif->jenis_kendaraan }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-5 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Waktu & Durasi</h4>
                        <div class="grid    grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Waktu Masuk</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->waktu_masuk ?? '-' }} WIB
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Waktu Keluar</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->waktu_keluar ?? '-' }} WIB
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Durasi Parkir</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->durasi_jam ?? '-' }} Jam
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                @if($transaction->status === 'masuk')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Masuk
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Keluar
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-5 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Biaya</h4>
                        <div class="flex justify-between items-center">
                            <p class="text-base text-gray-600 dark:text-gray-300">Total Biaya Parkir</p>
                            <p class="text-3xl font-bold text-white">
                                Rp {{ number_format($transaction->biaya_total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-5 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Petugas</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nama Petugas</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->user->nama_lengkap }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->user->email }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Username</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->user->username }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Status Aktif</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->user->status_aktif == 1 ? 'Aktif' : 'Non Aktif' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($transaction->status === 'keluar' && auth()->user()->role === 'petugas')
                        <div class="flex justify-end">
                            <a href="{{ route('transaksis.print', $transaction->id) }}"
                                class="inline-flex items-center px-6 py-3 bg-yellow-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cetak Struk
                            </a>
                        </div>
                    @endif

                    @if($transaction->status === 'masuk' && auth()->user()->role === 'petugas')
                        <div class="flex justify-end">
                            <a href="{{ route('transaksis.edit', $transaction->id) }}"
                                class="inline-flex items-center px-6 py-3 bg-red-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tandai Keluar
                            </a>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>