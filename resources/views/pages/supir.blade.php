@extends('layouts.admin-dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Supir</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supir</li>
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
                        <h3 class="card-title">Data Supir</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{url('supir')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_supir">Nama Supir</label>
                                <input type="text" name="nama_supir" class="form-control" id="nama_supir" placeholder="Masukkan Nama Supir" required>
                            </div>
                            <div class="form-group">
                                <label for="ttl_supir">Tempat Tanggal Lahir</label>
                                <input type="date" name="ttl_supir" class="form-control" id="ttl_supir" placeholder="Masukkan Tempat Tanggal Lahir"  required>
                            </div>
                            <div class="form-group">
                                <label for="no_telpon">No Telpon</label>
                                <input type="text" name="no_telpon" class="form-control" id="no_telpon" placeholder="Masukkan No Telpon" maxlength="13" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <select class="custom-select rounded-0" id="jenis_kendaraan">
                                    <option hidden>Pilih Jenis Kendaraan</option>
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <input type="text" name="jenis_kendaraan" class="form-control" id="jenis_kendaraan" placeholder="Masukkan Jenis Kendaraan" required>
                            </div>
                            <div class="form-group">
                                <label for="norek">No Rekening</label>
                                <input type="text" name="norek" class="form-control" id="norek" placeholder="Masukkan No Rekening" required>
                            </div>
                            <div class="form-group">
                                <label for="ontrip">OnTrip</label>
                                <input type="text" name="ontrip" class="form-control" id="ontrip" placeholder="Masukkan OnTrip" required>
                            </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit"  class="btn btn-outline-primary">Tambah</button>
                            <button type="submit"  class="btn btn-outline-primary">Edit</button>
                            <button type="submit"  class="btn btn-outline-danger">Hapus</button>
                            <button type="reset"  class="btn btn-outline-danger">Batal</button>
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

 @endsection
 {{-- @push()
     <script>
         $(function() {})

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#kamarForm').serialize(),
                url: "{{ route('kamar.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#kamarForm').trigger("reset");
                    $('#tambahKamarModal').modal('hide');
                    table.draw();

                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
            location.reload();
        });

     </script>
 @endpush --}}
