@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow border-1">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h3 class="mb-0">Buat Laporan</h3>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                            </div>

                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 text-center">
                                {{-- @if (session()->has('success'))
                            <div class="alert alert-info my-2" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                            @endif --}}
                                @if (session()->has('Errors'))
                                    <div class="alert alert-danger my-2" role="alert">
                                        <strong>{{ session('Errors') }}</strong>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger my-2" role="alert">

                                        @foreach ($errors->all() as $error)
                                            <strong>{{ $error }}</strong><br>
                                        @endforeach

                                    </div>
                                @endif

                                {{-- @error('id')
                            <div class="alert alert-danger my-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror --}}
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="row  justify-content-center">

                            <div class="col-6 mx-4 ">
                                <form action="{{ route('laporan.cetak') }}" method="post" target="_blank">
                                    @csrf

                                    <div class="form-group">
                                        <label for="laporan_type">Pilih Tipe Laporan:</label>
                                        <select class="form-control" name="laporan_type" id="laporan_type">
                                            <option value="harian">Harian</option>
                                            <option value="bulanan">Bulanan</option>
                                            <option value="rentang">Rentang Tanggal</option>
                                        </select>
                                    </div>

                                    <!-- Input tanggal untuk laporan harian -->
                                    <div class="form-group" id="tanggal_harian" style="display: block;">
                                        <label for="tanggal">Pilih Tanggal:</label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                                    </div>

                                    <!-- Input bulan dan tahun untuk laporan bulanan dan tahunan -->
                                    <div class="form-group" id="bulan_input" style="display: none;">
                                        <label for="bulan">Pilih Bulan:</label>
                                        <input type="month" class="form-control" name="bulan" id="bulan">
                                    </div>

                                    <!-- Input bulan dan tahun untuk laporan bulanan dan tahunan -->
                                    <div class="form-group" id="rentang_input" style="display: none;">
                                        <label for="bulan">Pilih Bulan:</label>
                                        <input type="text" class="form-control" name="rentang" id="rentang">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Buat Laporan</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-start">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="" id="delete-form" method="post">
            @csrf
            @method('DELETE')
        </form>
    @endsection

    @section('custom_html')
        {{-- @foreach ($akun as $index)
            <form action="{{ route('anggota.destroy', $index->id) }}" id="delete-form-{{ $index->id }}" method="post">
                @csrf
                @method('DELETE')
            </form>
        @endforeach --}}
    @endsection

    @push('custom_js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {
            $('input[name="rentang"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>
        <script>
            $(document).ready(function() {

                laporanType.dispatchEvent(new Event('change'));

            });
        </script>

        <script>
            // JavaScript untuk mengatur tampilan input berdasarkan pilihan laporan
            const laporanType = document.getElementById('laporan_type');
            const tanggalHarian = document.getElementById('tanggal_harian');
            const bulanTahun = document.getElementById('bulan_input');
            const rentang = document.getElementById('rentang_input');

            laporanType.addEventListener('change', function() {
                if (laporanType.value === 'harian') {
                    tanggalHarian.style.display = 'block';
                    bulanTahun.style.display = 'none';
                    rentang.style.display = 'none';
                } else if (laporanType.value === 'bulanan') {
                    tanggalHarian.style.display = 'none';
                    bulanTahun.style.display = 'block';
                    rentang.style.display = 'none';
                } else if (laporanType.value === 'rentang') {
                    tanggalHarian.style.display = 'none';
                    bulanTahun.style.display = 'none';
                    rentang.style.display = 'block';
                }
                // Mengambil semua elemen input yang memiliki style display: block
                const blockElements = document.querySelectorAll('[style*="display: block"]');

                // Mengubah required menjadi true untuk elemen input yang memiliki style display: block
                blockElements.forEach((element) => {
                    element.querySelector('input').required = true;
                });

                // Mengambil semua elemen input yang memiliki style display: none
                const noneElements = document.querySelectorAll('[style*="display: none"]');

                // Mengubah required menjadi false untuk elemen input yang memiliki style display: none
                noneElements.forEach((element) => {
                    element.querySelector('input').required = false;
                });
            });
        </script>
    @endpush
