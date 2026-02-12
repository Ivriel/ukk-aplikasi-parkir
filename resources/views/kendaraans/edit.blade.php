<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Kendaraan #{{ $kendaraan->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8">

                    <form action="{{ route('kendaraans.update', $kendaraan->id) }}" enctype="multipart/form-data"
                        method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div>
                            <x-input-label for="plat_nomor" :value="__('Plat Nomor')" />
                            <x-text-input id="plat_nomor" name="plat_nomor" type="text" class="mt-1 block w-full"
                                :value="old('plat_nomor', $kendaraan->plat_nomor)" />
                            <x-input-error class="mt-2" :messages="$errors->get('plat_nomor')" />
                        </div>

                        <div>
                            <x-input-label for="gambar" :value="__('Gambar Kendaraan')" />
                            @if($kendaraan->gambar)
                                <div class="mt-2 mb-3">
                                    <img src="{{ asset('storage/' . $kendaraan->gambar) }}" alt="Gambar Kendaraan"
                                        class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <input id="gambar" name="gambar" type="file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300" />
                            <x-input-error class="mt-2" :messages="$errors->get('gambar')" />
                        </div>

                        <div>
                            <x-input-label for="jenis_kendaraan" :value="__('Jenis Kendaraan')" />
                            <x-text-input id="jenis_kendaraan" name="jenis_kendaraan" type="text"
                                class="mt-1 block w-full" :value="old('jenis_kendaraan', $kendaraan->jenis_kendaraan)" />
                            <x-input-error class="mt-2" :messages="$errors->get('jenis_kendaraan')" />
                        </div>

                        <div>
                            <x-input-label for="warna" :value="__('Warna')" />
                            <x-text-input id="warna" name="warna" type="text" class="mt-1 block w-full"
                                :value="old('warna', $kendaraan->warna)" />
                            <x-input-error class="mt-2" :messages="$errors->get('warna')" />
                        </div>


                        <div>
                            <x-input-label for="pemilik" :value="__('Pemilik')" />
                            <x-text-input id="pemilik" name="pemilik" type="text" class="mt-1 block w-full"
                                :value="old('pemilik', $kendaraan->pemilik)" />
                            <x-input-error class="mt-2" :messages="$errors->get('pemilik')" />
                        </div>


                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('kendaraans.index')}}"
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