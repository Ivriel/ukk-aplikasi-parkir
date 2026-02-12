<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8">
                    <div class="pb-2 w-full dark:border-gray-700">
                        <form action="{{ route('transaksis.create') }}" method="GET"
                            class="flex-grow flex gap-2 text-white">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari plat nomor, jenis, warna, dan pemilik kendaraan"
                                class="w-full rounded-xl border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl">Cari</button>
                            <a href="{{ route('transaksis.create') }}"
                                class="bg-red-600 text-white px-6 py-2 rounded-xl">Reset</a>
                        </form>
                    </div>

                    <form action="{{ route('transaksis.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="kendaraan_id" :value="__('Kendaraan')" />
                            <select name="kendaraan_id" id="kendaraan_id"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                <option value="">Pilih Kendaraan</option>

                                @forelse ($kendaraan as $k)
                                    <option value="{{ $k->id }}">{{ $k->plat_nomor }} - {{ $k->jenis_kendaraan }} -
                                        {{ $k->warna }} - {{ $k->pemilik }}
                                    </option>
                                @empty
                                    <option value="">Tidak ada data kendaraan</option>
                                @endforelse
                            </select>
                        </div>

                        <div>
                            <x-input-label for="tarif_id" :value="__('Tarif')" />
                            <select name="tarif_id" id="tarif_id"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                <option value="">Pilih Tarif Parkir</option>

                                @forelse ($tarif as $t)
                                    <option value="{{ $t->id }}">{{ $t->jenis_kendaraan }} - Rp
                                        {{ number_format($t->tarif_per_jam, 0, ',', '.') }}
                                    </option>
                                @empty
                                    <option value="">Tidak ada tarif</option>
                                @endforelse
                            </select>
                        </div>

                        <div>
                            <x-input-label for="area_id" :value="__('Area')" />
                            <select name="area_id" id="area_id"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                <option value="">Area Parkir</option>

                                @forelse ($area as $a)
                                    <option value="{{ $a->id }}" {{ $a->terisi >= $a->kapasitas ? 'disabled' : '' }}>
                                        {{ $a->nama_area }} <br>
                                        {{ $a->kapasitas . '/' . $a->terisi }}
                                    </option>
                                @empty
                                    <option value="">Tidak ada area parkir</option>
                                @endforelse
                            </select>
                        </div>


                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('transaksis.index')}}"
                                class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-gray-200 border border-transparent rounded-xl font-bold text-xs text-white dark:text-gray-900 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition duration-150 shadow-md">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>