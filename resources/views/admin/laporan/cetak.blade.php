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

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
            /* Posisi horizontal */
            vertical-align: middle;
            /* Posisi vertikal */
            horizontal-align: middle;
            /* Posisi vertikal */
        }

        tbody {
            font-size: 12px;
            /* Ganti dengan ukuran font yang diinginkan */
        }

        thead {
            font-size: 14px;
            /* Ganti dengan ukuran font yang diinginkan */
        }
    </style>

</head>

<body>
    <div id="content-to-export">
        <div class="container">
            <header>
                <h3 class="mt-4 text-center">Rekapitulasi Pembayaran Overbooking</h3>
                <h5 class="mt-2 text-center">{{ $waktu }}</h5>
            </header>
            <table class="table table-striped table-bordered mt-4">
                <thead class="thead-light">
                    <tr class="text-center" colspan='2'>
                        <th scope="col">No</th>
                        <th scope="col">Nama Korban</th>
                        <th scope="col">Umur</th>
                        <th scope="col">Lama Rawatan</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col" style="width: 130px;">Biaya Rawatan</th>
                        <th scope="col" style="width: 130px;">Diskon</th>
                        <th scope="col" style="width: 130px;">Jumlah</th>
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
                        <tr class="text-left" colspan='2'>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{ $index->nama }}</td>
                            <td class="text-center">{{ $index->umur }}</td>
                            <td class="text-center">
                                @php
                                    $rentangTanggalArray = explode('-', $index->lamarawat);
                                    
                                    // Menghapus spasi ekstra dari hasil pemisahan
                                    $tanggalAwal = trim($rentangTanggalArray[0]);
                                    $tanggalAkhir = trim($rentangTanggalArray[1]);
                                    
                                    echo date('d F Y', strtotime($tanggalAwal)) . ' sd ' . date('d F Y', strtotime($tanggalAkhir));
                                @endphp
                            </td>
                            <td class="text-center">{{ date('d F Y', strtotime($index->created_at)) }}</td>
                            <td class="text-right">Rp {{ number_format($index->biaya, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($index->diskon, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($index->setelah_diskon, 0, ',', '.') }}</td>
                        </tr>
                        @php
                            $totalBiaya += $index->biaya;
                            $totalDiskon += $index->diskon;
                            $totalSetelahDiskon += $index->setelah_diskon;
                        @endphp
                    @endforeach
                    <tr class="text-left" colspan='2'>
                        <td colspan="5" class="text-center"><b>TOTAL</b></td>

                        <td class="text-right"><b>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</b></td>
                        <td class="text-right"><b>Rp {{ number_format($totalDiskon, 0, ',', '.') }}</b></td>
                        <td class="text-right"><b>Rp {{ number_format($totalSetelahDiskon, 0, ',', '.') }}</b></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="container mt-4 pt-4">
            <div class="row justify-content-between ">
                <div class="col-3">
                </div>
                <div class="col-3">
                    Bengkulu, {{ date('d F Y', strtotime(now())) }}
                </div>

            </div>
            <div class="row justify-content-between " style="margin-top: 100px">
                <div class="col-3" style="margin-left: 60px">
                    Kepala Cabang
                </div>
                <div class="col-3">
                    Ka. Unit Operasional
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan link ke Bootstrap JS dan jQuery jika diperlukan -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include html2pdf.js from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        window.onload = function() {
            // Select the HTML content to be converted to PDF

            const element = document.getElementById("content-to-export");

            html2pdf()
                .from(element)
                .set({
                    margin: 10,
                    filename: "Rekapitulasi Pembayaran.pdf",
                    image: {
                        type: "jpeg",
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 3
                    },
                    jsPDF: {
                        unit: "mm",
                        format: "a4",
                        orientation: "landscape"
                    }
                })
                .save();

            // setTimeout(function() {
            //     window.close();
            // }, 2000);
        };
    </script>

</body>

</html>
