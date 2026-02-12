<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bukti Struk Parkir #{{ $transaksi->id }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            color: #000;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        .label {
            font-weight: bold;
            width: 180px;
        }

        .value {
            width: 180px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">

        <div style="border-bottom: 2px solid #000; padding-bottom: 20px;">
            <h1>Bukti Transaksi Parkir #{{ $transaksi->id }}</h1>
            <p style="">Jalan Teluk Pacitan, Arjosari, Kota Malang</p>
            <p style="">Telp: 1234567890</p>
            <div style="">Dicetak pada:{{ \Carbon\Carbon::parse(now())->translatedFormat('d M Y - H:i:s') }} WIB</div>
        </div>



        <div style="border: 1px solid #000; padding: 15px; margin-top: 10px;">
            <div style="font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 10px;">
                DATA KENDARAAN</div>
            <table style="width: 100%; border: none;">
                <tr>
                    <td class="label">Plat Nomor</td>
                    <td>: {{ $transaksi->kendaraan->plat_nomor }}</td>
                </tr>
                <tr>
                    <td class="label">Jenis</td>
                    <td>: {{ $transaksi->kendaraan->jenis_kendaraan }}</td>
                </tr>
                <tr>
                    <td class="label">Warna</td>
                    <td>: {{ $transaksi->kendaraan->warna }}</td>
                </tr>
                <tr>
                    <td class="label">Pemilik</td>
                    <td>: {{ $transaksi->kendaraan->pemilik }}</td>
                </tr>
                <tr>
                    <td class="label">Ditambahkan Oleh</td>
                    <td>: {{ $transaksi->user->nama_lengkap }} - {{ $transaksi->user->role }}</td>
                </tr>
            </table>
        </div>

        <div style="border: 1px solid #000; padding: 15px; margin-top: 10px;">
            <div style="font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 10px;">
                DATA PARKIR</div>
            <table style="width: 100%; border: none;">
                <tr>
                    <td class="label">Area</td>
                    <td>: {{ $transaksi->area->nama_area }}</td>
                </tr>

                <tr>
                    <td class="label">Tarif Per Jam</td>
                    <td>: Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }} / Jam </td>
                </tr>

                <tr>
                    <td class="label">Waktu Masuk</td>
                    <td>: {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)->translatedFormat('d M Y - H:i:s') }} WIB
                    </td>
                </tr>
                <tr>
                    <td class="label">Waktu Keluar</td>
                    <td>: {{ \Carbon\Carbon::parse($transaksi->waktu_keluar)->translatedFormat('d M Y - H:i:s') }} WIB
                    </td>
                </tr>
                <tr>
                    <td class="label">Durasi</td>
                    <td>: {{ $transaksi->durasi_jam }} Jam</td>
                </tr>
                <tr>
                    <td class="label">Total Biaya</td>
                    <td>: Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

    </div>


</body>

</html>