<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">

                <div class="p-6 bg-white dark:bg-gray-800  border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Transaksi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola transaksi di sini.
                        </p>
                    </div>

                    @if (auth()->user()->role === 'petugas')
                        <a href="{{ route('transaksis.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Tambah Transaksi
                        </a>
                    @endif
                </div>

                <div class="px-4 pb-2 w-full dark:border-gray-700">
                    <form action="{{ route('transaksis.index') }}" method="GET" class="flex-grow flex gap-2 text-white">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari plat nomor dan area"
                            class="w-full rounded-xl border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl">Cari</button>
                        <a href="{{ route('transaksis.index') }}"
                            class="bg-red-600 text-white px-6 py-2 rounded-xl">Reset</a>
                    </form>
                </div>

                <div class="px-4 pb-2 border-b w-full dark:border-gray-700 text-white">
                    <form action="{{ route('transaksis.index') }}" method="GET" class="w-full">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select name="sort" onchange="this.form.submit()"
                            class="w-full rounded-xl border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <option value="">Terbaru
                            </option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama
                            </option>
                            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Total Biaya
                                Termurah
                            </option>
                            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Total Biaya
                                Termahal
                            </option>
                        </select>
                    </form>

                </div>

                @if (auth()->user()->role === 'owner')
                    <div class="px-4 py-3 bg-indigo-50 dark:bg-indigo-900/20 border-b dark:border-gray-700">
                        <form action="{{ route('transaksis.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Dari
                                    Tanggal</label>
                                <input type="date" name="dari_tanggal" value="{{ request('dari_tanggal') }}"
                                    class="rounded-lg border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Sampai
                                    Tanggal</label>
                                <input type="date" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}"
                                    class="rounded-lg border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white text-sm">
                            </div>
                            <button type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                                Filter Rekap
                            </button>
                            <a href="{{ route('transaksis.index') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-600">
                                Reset
                            </a>
                        </form>

                        @if(request('dari_tanggal') || request('sampai_tanggal'))
                            <div class="mt-3 p-3 bg-white dark:bg-gray-800 rounded-lg border dark:border-gray-700">
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    <strong>Periode:</strong>
                                    {{ request('dari_tanggal') ?? 'Awal' }} s/d {{ request('sampai_tanggal') ?? 'Sekarang' }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-4 font-bold">#ID</th>
                                <th class="px-6 py-4 font-bold">Plat Nomor</th>
                                <th class="px-6 py-4 font-bold">Waktu Masuk</th>
                                <th class="px-6 py-4 font-bold">Waktu Keluar</th>
                                <th class="px-6 py-4 font-bold">Durasi Jam</th>
                                <th class="px-6 py-4 font-bold">Tarif / Jam</th>
                                <th class="px-6 py-4 font-bold">Biaya Total</th>
                                <th class="px-6 py-4 font-bold">Area</th>
                                <th class="px-6 py-4 font-bold">Status</th>
                                @if (auth()->user()->role === 'petugas')
                                    <th class="px-6 py-4 text-right font-bold">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($transaksis as $transaksi)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">{{ $transaksi->id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        {{ $transaksi->kendaraan->plat_nomor }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        {{ $transaksi->waktu_masuk ?? '-' }} WIB
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        {{ $transaksi->waktu_keluar ?? '-' }} WIB
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        {{ $transaksi->durasi_jam ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        {{ $transaksi->area->nama_area ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        {{ $transaksi->status ?? '-' }}
                                    </td>
                                    @if (auth()->user()->role === 'petugas')
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end items-center gap-2">

                                                <a href="{{ route('transaksis.show', $transaksi->id) }}"
                                                    class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1.5 rounded-md transition-colors">
                                                    Show
                                                </a>


                                                @if ($transaksi->status === 'masuk')
                                                    <a href="{{ route('transaksis.edit', $transaksi->id) }}"
                                                        class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1.5 rounded-md transition-colors">
                                                        Selesai
                                                    </a>
                                                @endif


                                                @if ($transaksi->status === 'keluar')
                                                    <a href="{{ route('transaksis.print', $transaksi->id) }}"
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1.5 rounded-md transition-colors">
                                                        Cetak
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <td colspan="9" class="text-center text-red-500 italic font-bold">Tidak ada data transaksi
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                    {{ $transaksis->links() }}
                </div>


            </div>
        </div>
    </div>
</x-app-layout>