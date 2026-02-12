<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Kendaraan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8">

                    <form action="{{ route('kendaraans.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div>
                            <label for="plat_nomor"
                                class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Plat Nomor
                            </label>
                            <input type="text" name="plat_nomor" id="plat_nomor"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition duration-200"
                                required autofocus>
                            @error('plat_nomor')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <x-input-label for="gambar" :value="__('Gambar Kendaraan')" />
                            <input id="gambar" name="gambar" type="file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300" />
                            <x-input-error class="mt-2" :messages="$errors->get('gambar')" />
                        </div>

                        <div>
                            <label for="jenis_kendaraan"
                                class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Jenis Kendaraan
                            </label>
                            <input type="text" name="jenis_kendaraan" id="jenis_kendaraan"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition duration-200"
                                required autofocus>
                            @error('jenis_kendaraan')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="warna" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Warna
                            </label>
                            <input type="text" name="warna" id="warna"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition duration-200"
                                required autofocus>
                            @error('warna')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pemilik" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Pemilik
                            </label>
                            <input type="text" name="pemilik" id="pemilik"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition duration-200"
                                required autofocus>
                            @error('pemilik')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
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