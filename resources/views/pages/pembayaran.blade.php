@extends('layouts.user-dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form Pembayaran</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pembayaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Pembayaran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div id="detail">
                                    <form id="formPesan" method="post" action="{{ url('pemesanan') }}">
                                        <input type="hidden" name="lat_penjemputan" id="lat_penjemputan">
                                        <input type="hidden" name="lng_penjemputan" id="lng_penjemputan">
                                        <input type="hidden" name="lat_tujuan" id="lat_tujuan">
                                        <input type="hidden" name="lng_tujuan" id="lng_tujuan">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="no_pemesanan">No.Pemesanan</label>
                                                        <input type="text" name="no_pemesanan" class="form-control"
                                                            id="no_pemesanan" placeholder="Masukkan No. Pemesanan"
                                                            value="{{ $pemesanan->no_pemesanan }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pemesan">Nama Pemesan</label>
                                                        <input type="text" name="nama_pemesan" class="form-control"
                                                            id="nama_pemesan" placeholder="Masukkan nama pemesan" readonly
                                                            value="{{ $pemesanan->nama_pemesan }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_telp">No.Telepon</label>
                                                        <input type="text" name="no_telp" class="form-control"
                                                            id="no_telp" placeholder="Masukkan No.telp" maxlength="13"
                                                            required value="{{ $pemesanan->no_telp }}" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="lokasi_penjemputan">Lokasi Penjemputan</label>
                                                        <input type="text" name="lokasi_penjemputan" readonly
                                                            class="form-control" id="nama_lokasi_penjemputan"
                                                            value="{{ $pemesanan->lokasi_penjemputan }}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="supir">Supir</label>
                                                        <select class="custom-select rounded-0" name="id_supir"
                                                            id="supir" disabled>
                                                            <option value="{{ $pemesanan->id_supir }}">
                                                                {{ $pemesanan->nama_supir }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah_pemesanan">Jumlah Penumpang</label>
                                                        <input type="number" value="1" name="jumlah_pemesanan"
                                                            class="form-control" id="jumlah_pemesanan"
                                                            placeholder="Masukkan Jumlah Penumpang" min="0" required
                                                            value="{{ $pemesanan->jumlah_pemesanan }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        @php
                                                            use Carbon\Carbon;
                                                            $formattedDate = Carbon::parse(
                                                                $pemesanan->tanggal_pemesanan,
                                                            )->format('Y-m-d');
                                                        @endphp

                                                        <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                                        <input type="date" name="tanggal_pemesanan" class="form-control"
                                                            id="tanggal_pemesanan" placeholder="Masukkan Tanggal Pemesanan"
                                                            required value="{{ $formattedDate  }}" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="lokasi_tujuan">Lokasi Tujuan</label>
                                                        <input type="text" name="lokasi_tujuan" readonly
                                                            class="form-control" id="nama_lokasi_tujuan"
                                                            value="{{ $pemesanan->lokasi_tujuan }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /.card-body -->
                                            <div class="row mt-3 justify-content-center">
                                                <div class="col-11 m-2">
                                                    <label for="lokasi_tujuan">Perkiraan Rute</label>
                                                    <div id="mapResult"></div>
                                                </div>
                                            </div>
                                            {{-- <div class="row mt-3 justify-content-center">
                                    <div class="col-11 mx-auto m-2">
                                        <div id="mapResult"></div>
                                        <p>Total Jarak: <span id="total_distance">0</span> meters</p>
                                    </div>
                                </div> --}}
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="total_jarak">Total Jarak</label>
                                                        <input type="text" class="form-control" name="total_jarak"
                                                            id="total_jarak" readonly
                                                            value="{{ $pemesanan->total_jarak }}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="total_harga">Total Bayar</label>
                                                        <input type="text" class="form-control" name="total_harga"
                                                            id="total_harga"
                                                            value="{{ number_format($pemesanan->harga_pesanan, 0, ',', '.') }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Jenis Bayar</label>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" value="cash"
                                                                id="cash" name="jenis_pembayaran" required>
                                                            <label class="form-check-label" for="cash">Cash</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" value="va"
                                                                id="va" name="jenis_pembayaran" required>
                                                            <label class="form-check-label" for="va">Virtual
                                                                Account</label>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        @if ($tipe != 'detail')

                                        <div id="detailButton">
                                            <div class="card-footer">
                                                <button type="button" id="btnBayar"
                                                    class="btn btn-outline-primary">Bayar Sekarang</button>
                                                <button type="button" id="btnReset"
                                                    class="btn btn-danger">Reset</button>
                                            </div>
                                        </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Small boxes (Stat box) -->

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('script')
    <script>
        var map = L.map('mapResult').setView([-6.82645, 107.136757], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Coordinates
        var startPoint = L.latLng(<?= $pemesanan->lat_penjemputan ?>, <?= $pemesanan->lng_penjemputan ?>);
        var endPoint = L.latLng(<?= $pemesanan->lat_tujuan ?>, <?= $pemesanan->lng_tujuan ?>);

        // Add markers with tooltips
        var startMarker = L.marker(startPoint).addTo(map)
            .bindTooltip("Lokasi Penjemputan", {
                permanent: true,
                direction: "right"
            });

        var endMarker = L.marker(endPoint).addTo(map)
            .bindTooltip("Lokasi Tujuan", {
                permanent: true,
                direction: "right"
            });

        // Add routing control
        L.Routing.control({
            waypoints: [
                startPoint,
                endPoint
            ],
            routeWhileDragging: true
        }).addTo(map);

        control.on('routesfound', function(e) {
            var jumlah_pemesanan = $("#jumlah_pemesanan").val();
            var routes = e.routes;
            var totalDistance = routes.reduce((acc, route) => acc + route.summary.totalDistance, 0);

            totalDistance = totalDistance / 1000;
            var totalHarga = (totalDistance * 1250) * jumlah_pemesanan
            var totalHargaFormatted = totalHarga;
            hargaSatuPenumpang = (totalDistance * 1250)

            $("#total_harga").val(formatRupiah(Math.ceil(totalHargaFormatted)));
            $('#total_jarak').val(totalDistance.toFixed(1));

        });

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            return ribuan.join('.').split('').reverse().join('');
            // return angka
        }

        $(function() {
            var total_harga = $("#total_harga");
            var jumlah_pemesanan = $("#jumlah_pemesanan").val();


            $("#jumlah_pemesanan").on("keyup", function() {
                var totalhargaOld = hargaSatuPenumpang;
                // var value = parseInt(selected.data('harga'));
                jumlah_pemesanan = $(this).val();
                total_harga.val(formatRupiah(Math.ceil((totalhargaOld * jumlah_pemesanan))));
            });

            $('#btnPesan').on('click', function() {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah anda yakin ingin memesan tiket?',
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Pesan',
                    denyButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#formPesan').submit();
                    } else if (result.isDenied) {
                        Swal.fire('Oops!', 'Data batal dipesan', 'error');
                    }
                });
            });
        });
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        $(function() {
            // $('.metode-bayar').hide();
            // $('#detail').hide();
            // $('#detailBayar').hide();
            // $('#detailButton').hide();

            $('#va').on('click', function() {
                $('.metode-bayar').show();
            })

            $('#cash').on('click', function() {
                $('.metode-bayar').hide();
            })

            $('.va-dana').on('click', function() {
                alert('Nomor VA Dana: 0812345678910');
                $('#hasil-metode-bayar').val('dana');
            })
            $('.va-bca').on('click', function() {
                alert('Nomor Rekening BCA: 156273823');
                $('#hasil-metode-bayar').val('bca');
            })
            $('.va-bri').on('click', function() {
                alert('Nomor Rekening BRI: 987317142');
                $('#hasil-metode-bayar').val('bri');
            })
            $('.va-mandiri').on('click', function() {
                alert('Nomor Rekening Mandiri: 1843956173');
                $('#hasil-metode-bayar').val('mandiri');
            })

            $('#btnCek').on('click', function() {
                var no_pemesanan = $('#no_pemesanan').val();
                if (no_pemesanan == '') {
                    Swal.fire('Warning', 'Isi nomor pemesanan', 'error');
                } else {
                    $.ajax({
                        url: "{{ url('getPemesanan') }}",
                        method: 'post',
                        data: {
                            no_pemesanan: no_pemesanan,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            console.log(res);
                            $('#detail').show();
                            $('#detailBayar').show();
                            $('#detailButton').show();

                            $('#nama').val(res.data.nama_pemesan);
                            $('#notelp').val(res.data.no_telp);
                            $('#tgl_pesan').val(res.data.tanggal_pemesanan);
                            $('#tujuan').val(res.data.tujuan);
                            $('#jml_penumpang').val(res.data.jumlah_pemesanan);
                            var totalBayar = res.data.jumlah_pemesanan * res.data.harga;
                            $('#total_bayar').val(totalBayar);
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status == 404) {
                                Swal.fire('Oops!', 'Data Pemesanan tidak ditemukan.', 'error');
                                $('#form_pembayaran').trigger('reset');
                            }
                        }
                    })
                }

            });

            setTimeout(function() {
                $('.alert').fadeOut("slow");
            }, 2000);

            $('#btnReset').on('click', function() {
                $('#form_pembayaran').trigger('reset');

                $('.metode-bayar').hide();
                $('#detail').hide();
                $('#detailBayar').hide();
                $('#detailButton').hide();
            })

            $('#btnBayar').on('click', function() {
                $.post("{{ route('payment') }}", {
                        _method: 'POST',
                        _token: '{{ csrf_token() }}',
                        id_pemesanan    : <?= $pemesanan->id ?>
                    },
                    function(data, status) {
                        snap.pay(data.snap_token.snap_token, {
                            onSuccess: function(result) {
                                Swal.fire('Informasi', 'Pembayaran Berhasil!', 'success')
                                    .then((result) => {
                                        // Tindakan lanjutan setelah pengguna menutup pemberitahuan
                                        // Misalnya, redirect ke halaman lain atau menutup popup
                                        // Contoh:
                                        // window.location.href = 'halaman-lain.html';
                                        // $('#popup').modal('hide');
                                        // location.reload();
                                        $.post("{{ route('check-transaction') }}", {
                                            _method: 'POST',
                                            _token: '{{ csrf_token() }}',
                                            order_id    : data.snap_token.order_id,
                                            no_pemesanan : data.snap_token.no_pemesanan,
                                        }, function(data, status) {
                                            if (status){
                                                window.location.href = "{{ url('riwayat-transaksi') }}";
                                            }
                                        });
                                    });
                            },

                            onPending: function(result) {
                                location.reload();
                            },

                            onError: function(result) {
                                console.log("error?");
                                location.reload();
                            }

                        });
                        return false;
                    });
            });
        })
    </script>
@endpush
