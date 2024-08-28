@extends('layouts.user-dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form Pemesanan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pemesanan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Pemesanan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="formPesan" method="post" action="{{ url('booking') }}">
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
                                                    value="{{ $no_pemesanan }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_pemesan">Nama Pemesan</label>
                                                <input type="text" name="nama_pemesan" class="form-control"
                                                    id="nama_pemesan" placeholder="Masukkan nama pemesan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_telp">No.Telepon</label>
                                                <input type="text" name="no_telp" class="form-control" id="no_telp"
                                                    placeholder="Masukkan No.telp" maxlength="13" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="lokasi_penjemputan">Lokasi Penjemputan</label>
                                                <input type="text" name="lokasi_penjemputan" readonly
                                                    class="form-control" id="nama_lokasi_penjemputan">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="supir">Supir</label>
                                                <select class="custom-select rounded-0" name="id_supir" id="supir">
                                                    <option hidden>Pilih Supir</option>
                                                    @foreach (@$supir as $s)
                                                        <option value="{{ $s->id }}">{{ $s->nama_supir }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_pemesanan">Jumlah Penumpang</label>
                                                <input type="number" value="1" name="jumlah_pemesanan"
                                                    class="form-control" id="jumlah_pemesanan"
                                                    placeholder="Masukkan Jumlah Penumpang" min="0" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                                <input type="date" name="tanggal_pemesanan" class="form-control"
                                                    id="tanggal_pemesanan" placeholder="Masukkan Tanggal Pemesanan"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="lokasi_tujuan">Lokasi Tujuan</label>
                                                <input type="text" name="lokasi_tujuan" readonly class="form-control"
                                                    id="nama_lokasi_tujuan">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <!-- Modal -->
                                    <div class="row">
                                        <div class="col-6 ">
                                            <div id="lokasi_penjemputan"></div>
                                        </div>
                                        <div class="col-6 ">
                                            <div id="lokasi_tujuan"></div>
                                        </div>
                                    </div>
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
                                                <input type="text" class="form-control" name="total_jarak" id="total_jarak" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="total_harga">Total Harga</label>
                                                <input type="text" class="form-control" name="total_harga" id="total_harga" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="button" id="btnPesan" class="btn btn-outline-primary">Pesan Tiket</button>
                                    {{-- <button type="submit" class="btn btn-outline-primary">Pesan Tiket</button> --}}
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @push('script')
        <script>
            mapboxgl.accessToken =
                'pk.eyJ1IjoibnVydWxrYWZpMTgiLCJhIjoiY2xuanR1YmI4MG5oMzJpczMyMHNjcDg5ayJ9.oIQMObaIjF74R0w1KwzAUg';
            const map1 = new mapboxgl.Map({
                container: 'lokasi_penjemputan',
                center: [107.136757, -6.82645],
                zoom: 9
            });
            map1.addControl(new mapboxgl.NavigationControl());
            map1.addControl(
                new mapboxgl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true,
                    },
                    trackUserLocation: true,
                    showUserHeading: true,
                })
            );

            var marker1;
            var startValue;

            map1.on("click", function(e) {
                if (marker1) {
                    marker1.remove();
                }
                marker1 = new mapboxgl.Marker({
                        color: "#7d000c",
                    })
                    .setLngLat(e.lngLat)
                    .addTo(map1);

                const lat = e.lngLat.lat;
                const lng = e.lngLat.lng;
                $("#lat_penjemputan").val(lat);
                $("#lng_penjemputan").val(lng);
                $.ajax({
                    url: "https://api.geoapify.com/v1/geocode/reverse?lat=" + lat + "&lon=" + lng +
                        "&format=json&apiKey=e712c851f0cd4ac7aeba0cfc7f6ef80c",
                    type: "GET",
                    dataType: "json",
                    success: function(result) {
                        startValue = [result.results[0].bbox.lon1, result.results[0].bbox.lat1];
                        updateRoute();
                        $("#nama_lokasi_penjemputan").val(result.results[0].address_line2);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            const map2 = new mapboxgl.Map({
                container: 'lokasi_tujuan',
                center: [107.136757, -6.82645],
                zoom: 9
            });
            map2.addControl(new mapboxgl.NavigationControl());
            map2.addControl(
                new mapboxgl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true,
                    },
                    trackUserLocation: true,
                    showUserHeading: true,
                })
            );

            var marker2;
            var endValue;
            map2.on("click", function(e) {
                if (marker2) {
                    marker2.remove();
                }
                marker2 = new mapboxgl.Marker({
                        color: "#7d000c",
                    })
                    .setLngLat(e.lngLat)
                    .addTo(map2);

                const lat = e.lngLat.lat;
                const lng = e.lngLat.lng;
                $("#lat_tujuan").val(lat);
                $("#lng_tujuan").val(lng);
                $.ajax({
                    url: "https://api.geoapify.com/v1/geocode/reverse?lat=" + lat + "&lon=" + lng +
                        "&format=json&apiKey=e712c851f0cd4ac7aeba0cfc7f6ef80c",
                    type: "GET",
                    dataType: "json",
                    success: function(result) {
                        endValue = [result.results[0].bbox.lon1, result.results[0].bbox.lat1];
                        updateRoute();
                        $("#nama_lokasi_tujuan").val(result.results[0].address_line2);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            function updateRoute() {
                if (startValue && endValue) {
                    control.setWaypoints([
                        L.latLng(startValue[1], startValue[0]),
                        L.latLng(endValue[1], endValue[0])
                    ]);
                }
            }

            var map = L.map('mapResult').setView([-6.82645, 107.136757], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var control = L.Routing.control({
                routeWhileDragging: true
            }).addTo(map);
            let hargaSatuPenumpang = 0;
            control.on('routesfound', function(e) {
                var jumlah_pemesanan = $("#jumlah_pemesanan").val();
                console.log('jml',jumlah_pemesanan)
                var routes = e.routes;
                var totalDistance = routes.reduce((acc, route) => acc + route.summary.totalDistance, 0);
                totalDistance = totalDistance / 1000; // convert to km
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
    @endpush
@endsection
