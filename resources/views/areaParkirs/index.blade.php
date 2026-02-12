<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">

                <div
                    class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Area Parkir</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola area parkir di sini.
                        </p>
                    </div>
                    <a href="{{ route('areaParkirs.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        + Tambah Area Parkir
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-4 font-bold">#ID</th>
                                <th class="px-6 py-4 font-bold">Nama Area</th>
                                <th class="px-6 py-4 font-bold">Kapasitas</th>
                                <th class="px-6 py-4 font-bold">Terisi</th>
                                <th class="px-6 py-4 font-bold">Created at</th>
                                <th class="px-6 py-4 font-bold">Updated at</th>
                                <th class="px-6 py-4 text-right font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($areaParkirs as $areaParkir)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        #{{ $areaParkir->id }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-semibold">
                                        {{ $areaParkir->nama_area }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                        {{ $areaParkir->kapasitas }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                        {{ $areaParkir->terisi }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                        {{ $areaParkir->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                        <span
                                            class="text-xs block">{{ $areaParkir->updated_at->format('d M Y H:i') }}</span>
                                        <span
                                            class="text-[10px] text-gray-400">{{ $areaParkir->updated_at->diffForHumans() }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('areaParkirs.edit', $areaParkir->id) }}"
                                            class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-md transition duration-200 shadow-sm">Edit</a>
                                        <form action="{{ route('areaParkirs.destroy', $areaParkir->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-md transition duration-200 shadow-sm"
                                                onclick="return confirm('Yakin hapus data tarif {{ $areaParkir->nama_area }}?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="box-archive"></path>
                                            </svg>
                                            <p class="mt-2 text-gray-500 dark:text-gray-400">Belum ada data rak yang
                                                tersimpan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>