<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Area Parkir #{{ $areaParkir->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8">

                    <form action="{{ route('areaParkirs.update', $areaParkir->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nama_area" :value="__('Nama Area')" />
                            <x-text-input id="nama_area" name="nama_area" type="text" class="mt-1 block w-full"
                                :value="old('nama_area', $areaParkir->nama_area)" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_area')" />
                        </div>

                        <div>
                            <x-input-label for="kapasitas" :value="__('Kapasitas')" />
                            <x-text-input id="kapasitas" name="kapasitas" type="number" class="mt-1 block w-full"
                                :value="old('kapasitas', $areaParkir->kapasitas)" />
                            <x-input-error class="mt-2" :messages="$errors->get('kapasitas')" />
                        </div>

                        <div>
                            <x-input-label for="terisi" :value="__('Terisi')" />
                            <x-text-input id="terisi" name="terisi" type="nuber" class="mt-1 block w-full"
                                :value="old('terisi', $areaParkir->terisi ?? 0)" disabled />
                            <x-input-error class="mt-2" :messages="$errors->get('terisi')" />
                        </div>


                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('areaParkirs.index')}}"
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