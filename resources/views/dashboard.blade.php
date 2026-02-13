<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $greeting }}, {{ $user_fullname }}!
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Role: <span
                        class="capitalize px-2 py-0.5 bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200 rounded text-xs font-semibold">{{ $user_role }}</span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 lg:col-span-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pendapatan</p>
                    <h3 class="text-3xl font-bold text-green-600 dark:text-green-400 mt-1">
                        Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                    </h3>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Transaksi</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $total_transaksi }}</h3>
                        <span class="text-sm text-gray-400">Transaksi</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="font-bold text-gray-800 dark:text-green-500 mt-1">{{ $total_transaksi_masuk }}</h3>
                        <span class="text-sm  dark:text-green-500">Transaksi Masuk</span>
                        <span class="text-white">|</span>
                        <h3 class="font-bold text-gray-800 dark:text-red-500 mt-1">{{ $total_transaksi_keluar }}</h3>
                        <span class="text-sm dark:text-red-500">Transaksi Keluar</span>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Durasi Parkir</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $total_jam_parkir }}</h3>
                        <span class="text-sm text-gray-400">Jam</span>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kendaraan</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $total_kendaraan }}</h3>
                        <span class="text-sm text-gray-400">Kendaraan</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="font-bold text-white mt-1">{{ $kendaraan_mobil }}</h3>
                        <span class="text-sm text-white">Mobil</span>
                        <span class="text-white">|</span>
                        <h3 class="font-bold text-white mt-1">{{ $kendaraan_motor }}</h3>
                        <span class="text-sm text-white">Motor</span>
                        <span class="text-white">|</span>
                        <h3 class="font-bold text-white mt-1">{{ $kendaraan_lainnya }}</h3>
                        <span class="text-sm text-white">Lainnya</span>
                    </div>
                </div>


                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total User</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $total_user }}</h3>
                        <span class="text-sm text-gray-400">Kendaraan</span>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <h3 class="font-bold text-white mt-1">{{ $user_owner }}</h3>
                        <span class="text-sm text-white">Owner</span>
                        <span class="text-white">|</span>
                        <h3 class="font-bold text-white mt-1">{{ $user_admin }}</h3>
                        <span class="text-sm text-white">Admin</span>
                        <span class="text-white">|</span>
                        <h3 class="font-bold text-white mt-1">{{ $user_petugas }}</h3>
                        <span class="text-sm text-white">Petugas</span>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Log User Terdeteksi</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $log_user_terdeteksi }}
                        </h3>
                        <span class="text-sm text-gray-400">Baris</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>