@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Korban'])
    <div class="container-fluid mt-6">
        <div class="row">
            <div class="row justify-content-center">
                <div class="col-xl-8 order-xl-1 mb-3">
                    {{-- Informasi Jabatan --}}
                    <div class="card z-index-0 fadeIn3 fadeInBottom mb-5">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-info shadow-info border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Tambah Korban</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger text-white text-center alert-dismissible fade show my-2"
                                    role="alert">
                                    @foreach ($errors->all() as $error)
                                        <strong>{{ $error }}</strong><br>
                                    @endforeach
                                </div>
                            @endif
                            <form method="post" action="{{ route('korban.store') }}" autocomplete="off">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nama Korban</label>
                                            <input class="form-control" type="text" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Umur</label>
                                            <input class="form-control" type="number" name="umur" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1"
                                                required>
                                                <option value="" readonly>Pilih Jenis Kelamin</option>
                                                <option value="Laki - Laki">Laki - Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">No LP</label>
                                            <input class="form-control" type="text" name="no_LP" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Lama Rawatan</label>
                                            <input class="form-control" type="text" name="lamarawat" value=""
                                                required />

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nomor
                                                Handphone</label>
                                            <input class="form-control" type="tel" name="no_hp" id="no_hp"
                                                minlength="10" required>
                                                <span class="text-small">Example : 6282175831680</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Tanggal Transaksi</label>
                                            <input class="form-control" type="date" name="created_at" id="created_at"required>
                                               
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Biaya Rawatan</label>
                                            <input class="form-control" type="number" name="biaya" id="biaya"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Diskon 5%</label>
                                            <input class="form-control" type="text" id="diskon" readonly>
                                            <input class="form-control" type="number" name="diskon" id="diskon_1"
                                                required hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Biaya Rawatan Setelah
                                                Diskon</label>
                                            <input class="form-control" type="text" id="setelah_diskon" readonly>
                                            <input class="form-control" type="number" name="setelah_diskon"
                                                id="setelah_diskon_1" required hidden>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn bg-primary text-white">Simpan</button>
                                    <a href="{{ route('korban') }}" class="btn bg-info text-white">Kembali</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {
            $('input[name="lamarawat"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>
    <script type="text/javascript">
        // Mendapatkan referensi ke elemen-elemen input
        const biayaInput = document.getElementById('biaya');
        const diskonInput = document.getElementById('diskon');
        const setelahDiskonInput = document.getElementById('setelah_diskon');
        const diskonInputname = document.getElementById('diskon_1');
        const setelahDiskonInputname = document.getElementById('setelah_diskon_1');

        // Mendengarkan event input pada input biaya
        biayaInput.addEventListener('input', function() {
            const biaya = parseFloat(biayaInput.value);
            const diskonPersen = 0.05; // 5% diskon

            if (!isNaN(biaya)) {
                // Menghitung diskon
                const diskon = Math.floor(biaya *
                    diskonPersen); // Menggunakan Math.floor() untuk pembulatan
                // Menghitung biaya setelah diskon
                const biayaSetelahDiskon = Math.floor(biaya -
                    diskon); // Menggunakan Math.floor() untuk pembulatan
                diskonInputname.value = diskon;
                // console.log(diskonInputname.value);
                setelahDiskonInputname.value = biayaSetelahDiskon;
                // console.log(setelahDiskonInputname.value);
                // Menampilkan hasil dalam elemen input tanpa angka desimal
                diskonInput.value = diskon.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
                setelahDiskonInput.value = biayaSetelahDiskon.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
            } else {
                // Jika input tidak valid, mengosongkan nilai diskon dan biaya setelah diskon
                diskonInput.value = '';
                setelahDiskonInput.value = '';
            }
        });
    </script>
@endpush
