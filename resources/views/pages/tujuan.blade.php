@extends('layouts.admin-dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tujuan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tujuan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

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
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Form Ubah User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="formEdit" method="post">
                    @csrf
                    <input type="hidden" id="id_edit">
                    <div class="modal-body">             
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" class="form-control" name="tujuan" id="tujuan_edit" placeholder="Masukkan tujuan" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" name="harga" min="0" id="harga_edit" placeholder="Masukkan harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSubmitEdit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End of modal -->

          <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Tujuan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="formTambah" action="{{ url('tujuan/tambah') }}" method="post">
                    @csrf
                    <div class="modal-body">             
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Masukkan tujuan" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" name="harga" min="0" id="harga" placeholder="Masukkan harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSubmit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End of modal -->
          
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button type="button" id="btnTambah" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalTambah">Tambah</button>
                            </div>
                            <table class="table table-bordered" id="tabel_pengguna">
                                <thead>
                                    <tr>
                                        <th style="width:5%">#</th>
                                        <th>Tujuan</th>
                                        <th>Harga(Rp.)</th>       
                                        <th>Aksi</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($tujuan as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->tujuan }}</td>
                                        <td>{{number_format($row->harga,0,',','.')}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btnEdit"
                                            data-id="{{ $row->id }}"
                                            data-tujuan="{{ $row->tujuan }}"
                                            data-harga="{{ $row->harga }}"><i class="bi bi-pencil"></i></button>
                                            <button type="button" class="btn btn-danger btnHapus" data-id="{{ $row->id }}"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>
    <!-- /.content-header -->
<script>
    $(document).ready(function() {
        $('#tabel_pengguna').dataTable();

        $('.btnEdit').each(function() {
            $(this).on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('tujuan');
                var email = $(this).data('harga');
                var url = "{{ url('tujuan/update') }}/"+id+"";

                $('#id_edit').val(id);
                $('#tujuan_edit').val(name);
                $('#harga_edit').val(email);
                
                $('#modalEdit').modal('show');
                $('#formEdit').attr('action', url);
            });
        })   
        
        setTimeout(function() {
            $('.alert').fadeOut("slow");
        }, 2000);

        $('.btnHapus').each(function() {
            $(this).on('click', function() {
                var id = $(this).data('id');
                var url = "{{ url('tujuan/delete') }}/"+id+"";

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah anda yakin ingin menghapus data?',
                    showDenyButton: true,
                    confirmButtonText: 'Hapus',
                    denyButtonText: `Batal`,
                    icon: 'warning',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = url;
                    } else if (result.isDenied) {
                        Swal.fire('Data batal dihapus', '', 'error')
                    }
                })
            })
        })

        $('#btnSubmit').on('click', function(e) {
            e.preventDefault();

            if($('#harga').val() <= 0)
            {
                Swal.fire({
                    icon: 'warning',
                    text: 'Masukkan harga dengan nominal yang benar.',
                });
            } else {
                $('#formTambah').submit();
            }
        })

        $('#btnSubmitEdit').on('click', function(e) {
            e.preventDefault();

            if($('#harga_edit').val() <= 0)
            {
                Swal.fire({
                    icon: 'warning',
                    text: 'Masukkan harga dengan nominal yang benar.',
                });
            } else {
                $('#formEdit').submit();
            }
        })
    })
</script>
@endsection