@extends ('layouts.admin.master')
@section('pagetitle', isset($pagetitle) ? $pagetitle : 'Master Status')
@section('stylesheets')
    <!-- DataTables, Sweetalert2, Toast -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/toastr/toastr.css') }}">
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">Daftar Status</h3>
                            <a class="btn btn-success btn-xs float-right" href="javascript:void(0)" role="button" id="createBtn" title="Tambah Data"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <div class="card-body">
                            <table id="statustables" class="table table-bordered table-sm data-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="45%">Status</th>
                                        <th class="text-center" width="20%">Key</th>
                                        <th class="text-center" width="20%">Val</th>
                                        <th class="text-center" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody id="status-table-body">
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
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text status_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="key" class="control-label">Key</label>
                            <input type="text" class="form-control" id="key" name="key" placeholder="0 ~ 9" value="" maxlength="256" required="">
                            <span class="text-danger error-text key_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="val" class="control-label">Value</label>
                            <input type="text" class="form-control" id="val" name="val" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text val_error"></span>
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
        var table = $('#statustables').DataTable({
            processing: false,
            info: false,
            ajax: "{{ route('admin.status.index') }}",
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
            responsive: true,
            columns: [
                //  {data:'id', name:'id'},
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'status_name',
                    name: 'status_name'
                },
                {
                    data: 'status_key',
                    name: 'status_key'
                },
                {
                    data: 'status_val',
                    name: 'status_val'
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
                }
            ]
        });

        /*--------------------------------------------------------------------------------------
        Create New Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('#createBtn').click(function() {
            $('#ajaxModal').modal('show');
            $('#formName').html('Tambah Data');
            $('#ajaxForm').trigger('reset');
            $('#ajaxForm').attr('action', "{{ route('admin.status.store') }}");
        });

        /*--------------------------------------------------------------------------------------
        Update Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('body').on('click', '#editBtn', function() {
            var id = $(this).data('id');
            var geturl = "{{ route('admin.status.edit', ':id') }}";
            var puturl = "{{ route('admin.status.update', ':id') }}";
            geturl = geturl.replace(':id', id);
            puturl = puturl.replace(':id', id);
            $('#ajaxModal').modal('show');
            $('#formName').html('Ubah Data');
            $('#ajaxForm').attr('action', puturl);
            $.get(geturl, function(data) {
                $('input[name="id"]').val(data.details.id);
                $('#status').val(data.details.status_name);
                $('#key').val(data.details.status_key);
                $('#val').val(data.details.status_val);
            }, 'json');
        });

        /*--------------------------------------------------------------------------------------
        Delete  Button
        ----------------------------------------------------------------------------------------*/
        $(document).on('click', '#deleteBtn', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.status.destroy', ':id') }}";
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
                        id: id
                    }, function(data) {
                        if (data.code == 1) {
                            $('#statustables').DataTable().ajax.reload(null, false);
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
                        $('#statustables').DataTable().ajax.reload(null, false);
                        $('#ajaxModal').modal('hide');
                        toastr.success(data.msg);
                    }
                }
            });
        });
    });
</script>
@endsection
