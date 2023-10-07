<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        th,
        h3 {
            text-transform: uppercase;
        }
    </style>

</head>

<body>
    <div class="container">
        <header>
            <h3 class="mt-4 text-center">Rekapitulasi Pembayaran Overbooking</h3>
            <h4 class="mt-2 text-center">{{ date('d F Y', strtotime($waktu)) }}</h4>
        </header>
        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Korban</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Nomor LP</th>
                    <th scope="col">Biaya Rawatan</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1;
                $totalBiaya = 0;
                $totalDiskon = 0;
                $totalSetelahDiskon = 0;
                ?>
                @foreach ($korban as $key => $index)
                    <tr class="text-left">
                        <td class="text-center">{{ $i++ }}</td>
                        <td>{{ $index->nama }}</td>
                        <td class="text-center">{{ $index->umur }}</td>
                        <td class="text-center">{{ $index->jenis_kelamin }}</td>
                        <td>{{ $index->no_LP }}</td>
                        <td class="text-right">Rp {{ number_format($index->biaya, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($index->diskon, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($index->setelah_diskon, 0, ',', '.') }}</td>
                        <td class="text-center">{{ date('d F Y', strtotime($index->created_at)) }}</td>
                    </tr>
                    @php
                        $totalBiaya += $index->biaya;
                        $totalDiskon += $index->diskon;
                        $totalSetelahDiskon += $index->setelah_diskon;
                    @endphp
                @endforeach
                <tr class="text-left">
                    <td colspan="5" class="text-center">TOTAL</td>

                    <td class="text-right"><b>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</b></td>
                    <td class="text-right"><b>Rp {{ number_format($totalDiskon, 0, ',', '.') }}</b></td>
                    <td class="text-right"><b>Rp {{ number_format($totalSetelahDiskon, 0, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Tambahkan link ke Bootstrap JS dan jQuery jika diperlukan -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
