@extends('layouts.admin-dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
                    <div class="modal-body">    
                        <input type="hidden" name="id" id="id_edit">            
                        <div class="form-group">
                            <label for="name_edit">Nama Pengguna</label>
                            <input type="text" class="form-control" name="name" id="name_edit" placeholder="Masukkan nama pengguna" required>
                        </div>
                        <div class="form-group">
                            <label for="email_edit">Email</label>
                            <input type="email" class="form-control" name="email" id="email_edit" placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="type_edit">Type</label>
                            <select name="type" id="type_edit" class="form-control" required>
                                <option value="" hidden>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="supir">Supir</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                  <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="formTambah" action="{{ url('pengguna/tambah') }}" method="post">
                    @csrf
                    <div class="modal-body">             
                        <div class="form-group">
                            <label for="name">Nama Pengguna</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama pengguna" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="" hidden>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="supir">Supir</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($users as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            @if($row->type == 'admin')
                                            <span class="badge bg-primary badge-pill">{{ $row->type }}</span>
                                            @elseif($row->type == 'user')
                                            <span class="badge bg-success badge-pill">{{ $row->type }}</span>
                                            @elseif($row->type == 'supir')
                                            <span class="badge bg-warning badge-pill">{{ $row->type }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btnEdit"
                                            data-id="{{ $row->id }}"
                                            data-name="{{ $row->name }}"
                                            data-email="{{ $row->email }}"
                                            data-type="{{ $row->type }}"><i class="bi bi-pencil"></i></button>
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
                var name = $(this).data('name');
                var email = $(this).data('email');
                var type = $(this).data('type');
                var url = "{{ url('pengguna/update') }}/"+id+"";

                $('#id_edit').val(id);
                $('#name_edit').val(name);
                $('#email_edit').val(email);
                $('#type_edit').val(type);
                
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
                var url = "{{ url('pengguna/delete') }}/"+id+"";

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
                        Swal.fire('Data batal diubah', '', 'error')
                    }
                })
            })
        })
    })
</script>
@endsection