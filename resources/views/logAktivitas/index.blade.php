<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">

                <div
                    class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Log Aktivitas</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Cek Riwayat Kelakukan Tiap User.
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-4 font-bold">#ID</th>
                                <th class="px-6 py-4 font-bold">User ID</th>
                                <th class="px-6 py-4 font-bold">Nama Lengkap</th>
                                <th class="px-6 py-4 font-bold">Role</th>
                                <th class="px-6 py-4 font-bold">Phone</th>
                                <th class="px-6 py-4 font-bold">Aktivitas</th>
                                <th class="px-6 py-4 text-right font-bold">Waktu Aktivitas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-300">
                                        #{{ $log->id }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-semibold">
                                        {{ $log->user_id }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                        {{ $log->user->nama_lengkap }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                        {{ $log->user->role }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                        {{ $log->user->email }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                        {{ $log->aktivitas }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                        {{ $log->created_at->format('d M Y H:i:s') }} WIB <br>
                                        <span
                                            class="text-[10px] text-gray-400">{{ $log->created_at->diffForHumans() }}</span>
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
                                            <p class="mt-2 text-gray-500 dark:text-gray-400">Belum ada data log tersimpan.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                    {{ $logs->links() }}
                </div>


            </div>
        </div>
    </div>
</x-app-layout>