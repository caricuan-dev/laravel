@extends ('layouts.admin.master')
@section('pagetitle', isset($pagetitle) ? $pagetitle : 'Daftar Role')
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">Daftar Role</h3>
                            <a class="btn btn-success btn-xs float-right" href="javascript:void(0)" role="button" id="createBtn" title="Tambah Data"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <div class="card-body">
                            <table id="rolestables" class="table table-bordered table-sm data-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="45%">Role</th>
                                        <th class="text-center" width="25%">Guard</th>
                                        <th class="text-center" width="25%"></th>
                                    </tr>
                                </thead>
                                <tbody id="rolestables-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">Permission</h3>
                            <a class="btn btn-success btn-xs float-right" href="javascript:void(0)" role="button" id="createBtn" title="Tambah Data"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <div class="card-body">
                            <form id="PermissionForm" class="form-horizontal" action="" method="">
                                <input type="hidden" id="permmethod" name="_method" value="">
                                @csrf
                                <div class="form-group ">
                                    <label for="roles">Roles</label>
                                    <select class="form-control" id="roles" name="roles">
                                        <option value="0">Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text roles_error"></span>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="perm" class="control-label">Permission</label>
                                </div>
                                <div class="form-group ">
                                    @foreach ($permissions as $permission)
                                        <div class="icheck-primary d-inline-block">
                                            <input type="checkbox" id="{{ $permission->id }}_pid" name="perm[]" value="{{ $permission->name }}">
                                            <label for="{{ $permission->id }}_pid">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group col-md-3 float-right pr-">
                                    <button type="submit" class="btn btn-block btn-success" id="savePermBtn">Simpan</button>
                                </div>
                            </form>
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
                    <form id="ajaxForm" class="form-horizontal" action="" method="">
                        <input type="hidden" name="_method" value="">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="name" class="control-label">Role</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="guard" class="control-label">Guard</label>
                            <input type="text" class="form-control" id="guard" name="guard" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text guard_error"></span>
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

        $('#PermissionForm')[0].reset()


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
        var table = $('#rolestables').DataTable({
            processing: false,
            info: false,
            responsive: true,
            ajax: "{{ route('admin.admin-role.index') }}",
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
                    data: 'guard_name',
                    name: 'guard_name'
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
                }
            ]
        });


        /*--------------------------------------------------------------------------------------
        Create New Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('#createBtn').click(function() {
            $('#ajaxModal').modal('show');
            $('#formName').html('Tambah Header');
            $('#ajaxForm').trigger('reset');
            $('#ajaxForm').attr('action', "{{ route('admin.admin-role.store') }}");
            $('#ajaxForm').attr('method', "POST");
            $('input[name="_method"]').val('POST');
        });

        /*--------------------------------------------------------------------------------------
        Update Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('body').on('click', '#editBtn', function() {
            var id = $(this).data('id');
            var geturl = "{{ route('admin.admin-role.edit', ':id') }}";
            var puturl = "{{ route('admin.admin-role.update', ':id') }}";
            geturl = geturl.replace(':id', id);
            puturl = puturl.replace(':id', id);
            $('#ajaxModal').modal('show');
            $('#formName').html('Ubah Data');
            $('#ajaxForm').attr('action', puturl);
            $('#ajaxForm').attr('method', "POST");
            $('input[name="_method"]').val('PUT');
            $.get(geturl, function(data) {
                $('input[name="id"]').val(data.details.id);
                $('#name').val(data.details.name);
                $('#guard').val(data.details.guard_name);
            }, 'json');
        });

        /*--------------------------------------------------------------------------------------
        Delete  Button
        ----------------------------------------------------------------------------------------*/
        $(document).on('click', '#deleteBtn', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.admin-role.destroy', ':id') }}";
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
                            $('#rolestables').DataTable().ajax.reload(null, false);
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
                method: $(form).attr('method'),
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
                        $('#rolestables').DataTable().ajax.reload(null, false);
                        $('#ajaxModal').modal('hide');
                        toastr.success(data.msg);
                    }
                }
            });
        });

        $('#roles').on('change', function() {
            var id = $('#roles').val();
            $('input[type=checkbox]').each(function() {
                this.checked = false;
            });
            var geturl = "{{ route('admin.admin-permission.edit', ':id') }}";
            var puturl = "{{ route('admin.admin-permission.update', ':id') }}";
            geturl = geturl.replace(':id', id);
            puturl = puturl.replace(':id', id);
            $('#PermissionForm').attr('method', "POST");
            $('#PermissionForm').attr('action', puturl);
            $('#permmethod').val('PUT');

            $.get(geturl, function(data) {
                $.each(data.details, function(key, val) {
                    $('input[id^="'+val.id+'_pid"]').prop('checked', true);
                });
            }, 'json');
        });


        $('#PermissionForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
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
                        toastr.success(data.msg);
                        location.reload();
                    }
                }
            });
        });
    });
</script>
@endsection
