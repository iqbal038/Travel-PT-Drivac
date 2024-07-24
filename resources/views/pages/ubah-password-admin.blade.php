@extends('layouts.admin-dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Ubah Password</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Password</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(Session::get('success'))
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
                            <h3 class="card-title">Data Ubah Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formUbah" method="post" action="{{ url('update-password-admin', Auth::user()->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password_lama">Masukkan Password Lama</label>
                                            <input type="password" name="password_lama" class="form-control" id="nama"
                                                placeholder="Masukkan Password Lama">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_baru">Masukkan Password Baru</label>
                                            <input type="password" name="password_baru" class="form-control" id="nama"
                                                placeholder="Masukkan Password Baru" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
                                            <input type="password" name="konfirmasi_password_baru" class="form-control" id="nama"
                                                placeholder="Konfirmasi Password Baru" required>
                                        </div>                                        
                                    </div>                                    
                                </div>                                    
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" id="btnSimpan" class="btn btn-outline-primary">Simpan</button>
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

<script>
$(function() {
    $total_harga = $("#total_harga")

    $('#tujuan').change(function(e) {
        let selected = $(this).find("option:selected")
        let value = parseInt(selected.data('harga'))
        $jumlah_pemesanan = $("#jumlah_pemesanan").val()
        $total_harga.val(value * $jumlah_pemesanan)
    })

    $("#jumlah_pemesanan").on("keyup", function(e) {
        console.log('ai-e', e);
        let selected = $("#tujuan").find("option:selected")
        let value = parseInt(selected.data('harga'))
        $jumlah_pemesanan = $(this).val()
        $total_harga.val(value * $jumlah_pemesanan)
    })

    $('#btnSimpan').on('click', function() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda yakin ingin memesan tiket?',
            icon: 'information',
            showDenyButton: true,
            confirmButtonText: 'Pesan',
            denyButtonText: `Batal`,
            icon: 'warning',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $('#formUbah').submit();
            } else if (result.isDenied) {
                Swal.fire('Oops!', 'Data batal dipesan', 'error')
            }
        })
    });
})
</script>
@endsection