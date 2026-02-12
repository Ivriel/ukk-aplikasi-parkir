<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Tarif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8">

                    <form action="{{ route('tarifs.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="jenis_kendaraan" :value="__('Jenis Kendaraan')" />
                            <select name="jenis_kendaraan" id="jenis_kendaraan"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="mobil">
                                    Mobil</option>
                                <option value="motor">Motor</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label for="tarif_per_jam"
                                class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Tarif Per Jam
                            </label>
                            <input type="number" name="tarif_per_jam" id="tarif_per_jam"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition duration-200"
                                required autofocus>
                            @error('tarif_per_jam')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('tarifs.index')}}"
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