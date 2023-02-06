@extends ('layouts.admin.master')
@section('pagetitle', isset($pagetitle) ? $pagetitle : 'Daftar Admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">Daftar Admin</h3>
                            <a class="btn btn-success btn-xs float-right" href="javascript:void(0)" role="button" id="createBtn" title="Tambah Data"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <div class="card-body">
                            <table id="admintables" class="table table-bordered table-sm data-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="25%">Nama</th>
                                        <th class="text-center" width="20%">Email</th>
                                        <th class="text-center" width="15%">No Hp</th>
                                        <th class="text-center" width="15%">Role</th>
                                        <th class="text-center" width="10%">Status</th>
                                        <th class="text-center" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody id="admintables-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('modals')
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <form id="ajaxForm" class="form-horizontal" action="">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text nama_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="" value="" maxlength="256">
                            <span class="text-danger error-text password_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="control-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text no_hp_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="">Pilih Role</option>
                                @foreach ($data_role as $roles)
                                    <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text menuinduk_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Pilih Status</option>
                                @foreach ($data_status as $status)
                                    <option value="{{ $status->status_key }}">{{ $status->status_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text statusid_error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success" id="saveBtn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
@section('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('/admin/plugins/toastr/toastr.min.js') }}"></script>
<script type="text/javascript">
    $(function() {


        toastr.options.preventDuplicates = true;
        /*--------------------------------------------------------------------------------------
         Header Token
         ----------------------------------------------------------------------------------------*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /*--------------------------------------------------------------------------------------
        Render DataTable -> Index Data Tables
        ----------------------------------------------------------------------------------------*/
        var table = $('#admintables').DataTable({
            processing: false,
            info: false,
            responsive: true,
            ajax: "{{ route('admin.admin-list.index') }}",
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "language": {
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            },
            columns: [
                //  {data:'id', name:'id'},
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [{
                    targets: 0,
                    className: 'dt-body-center'
                },
                {
                    targets: 1,
                    className: 'dt-body-center'
                },
                {
                    targets: 2,
                    className: 'dt-body-center'
                },
                {
                    targets: 3,
                    className: 'dt-body-center'
                },
                {
                    targets: 4,
                    className: 'dt-body-center'
                },
                {
                    targets: 5,
                    className: 'dt-body-center'
                },
                {
                    targets: 6,
                    className: 'dt-body-center'
                }
            ]
        });

        /*--------------------------------------------------------------------------------------
        Create New Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('#createBtn').click(function() {
            var geturl = "{{ route('admin.admin-list.create') }}";
            $('#ajaxModal').modal('show');
            $('#formName').html('Tambah Header');
            $('#ajaxForm')[0].reset();
            $('#ajaxForm').attr('action', "{{ route('admin.admin-list.store') }}");
            $('#ajaxForm').attr('method', "POST");
            $('input[name="_method"]').val('POST');
        });


        /*--------------------------------------------------------------------------------------
        Update Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('body').on('click', '#editBtn', function() {
            var id = $(this).data('id');
            var create = "{{ route('admin.admin-list.create') }}";
            var geturl = "{{ route('admin.admin-list.edit', ':id') }}";
            var puturl = "{{ route('admin.admin-list.update', ':id') }}";
            geturl = geturl.replace(':id', id);
            puturl = puturl.replace(':id', id);
            $('#ajaxModal').modal('show');
            $('#formName').html('Ubah Data');
            $('#ajaxForm')[0].reset();
            $('#ajaxForm').attr('action', puturl);
            $('#ajaxForm').attr('method', "POST");
            $('input[name="_method"]').val('PUT');
            $.get(geturl, function(data) {
                $('input[name="id"]').val(data.details.id);
                $('#nama').val(data.details.name);
                $('#email').val(data.details.email);
                $('#password').val(data.details.sort_order);
                $('#no_hp').val(data.details.no_hp);
                $('#role').val(data.details.role);
                $('#status').val(data.details.status);
            }, 'json');
        });

        /*--------------------------------------------------------------------------------------
        Delete  Button
        ----------------------------------------------------------------------------------------*/
        $(document).on('click', '#deleteBtn', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.admin-list.destroy', ':id') }}";
            url = url.replace(':id', id);
            swal.fire({
                title: 'Hapus Data',
                html: 'Proses ini akan <b>Menghapus</b> Data, apakah anda yakin?',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 300,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.post(url, {
                        _method: 'DELETE',
                        id: id
                    }, function(data) {
                        if (data.code == 1) {
                            $('#admintables').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                        }
                    }, 'json');
                }
            });
        });

        /*--------------------------------------------------------------------------------------
        Save Button
        ----------------------------------------------------------------------------------------*/
        $('#ajaxForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: "POST",
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        $('#admintables').DataTable().ajax.reload(null, false);
                        $('#ajaxModal').modal('hide');
                        toastr.success(data.msg);
                    }
                }
            });
        });
    });
</script>
@endsection
