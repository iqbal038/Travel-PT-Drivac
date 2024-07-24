@extends('layouts.user-dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Riwayat Transaksi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Riwayat</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat!</strong> {{ Session::get('success') }}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> {{ Session::get('error') }}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Terjadi kesalahan.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Riwayat Transaksi</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr align="center">
                                            <th>No.Pemesanan</th>
                                            <th>Tgl.Keberangkatan</th>
                                            <th>Nama Pemesan</th>
                                            <th>No.Telp</th>
                                            <th>Total Pembayaran</th>
                                            <th>Metode Pembayaran</th>
                                            {{-- <th>Tujuan</th> --}}
                                            <th>Status Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemesanan as $trx)
                                            <tr align="center">
                                                <td>{{ $trx->no_pemesanan }}</td>
                                                <td>{{ date('d-m-Y', strtotime($trx->tanggal_pemesanan)) }}</td>
                                                <td>{{ $trx->nama_pemesan }}</td>
                                                <td>{{ $trx->no_telp }}</td>
                                                <td>{{ number_format($trx->harga_pesanan, 0, ',', '.') }}</td>
                                                <td>{{ $trx->jenis_pembayaran ?? '-' }}</td>
                                                {{-- <td>{{ $trx->tujuan }}</td> --}}
                                                <td>
                                                    @if ($trx->status == 'belum-lunas')
                                                        <span class="badge bg-warning badge-pill">
                                                            Menunggu Konfirmasi
                                                        </span>
                                                    @elseif($trx->status == 'lunas')
                                                        <span class="badge bg-success badge-pill">
                                                            Lunas
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($trx->status == 'belum-lunas')
                                                        <a href="{{ url('/riwayat-transaksi/detail', $trx->id) }}"
                                                            class="btn btn-primary btn-sm"><i class="fas fa-eye"
                                                                title="Detail"></i></a>
                                                        <a href="{{ url('/riwayat-transaksi/bayar', $trx->id) }}"
                                                            class="btn btn-info btn-sm" title="Bayar"><i
                                                                class="fas fa-cash-register"></i></a>
                                                    @elseif($trx->status == 'lunas')
                                                        <a href="{{ url('/riwayat-transaksi/detail', $trx->id) }}"
                                                            class="btn btn-primary btn-sm"><i class="fas fa-eye"
                                                                title="Detail"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script>
        $(function() {
            $("#example1").DataTable();
            $("#example2").DataTable();

            $('.updateStatus').each(function() {
                $(this).on('click', function() {
                    var id = $(this).data('id');
                    var url = "{{ url('update-status-pemesanan') }}/" + id + "";

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah anda yakin ingin mengubah data?',
                        showDenyButton: true,
                        confirmButtonText: 'Ubah',
                        denyButtonText: `Batal`,
                        icon: 'warning',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = url;
                        } else if (result.isDenied) {
                            Swal.fire('Data batal diubah', '', 'error')
                        }
                    })
                })
            })
        });
    </script>
@endsection
