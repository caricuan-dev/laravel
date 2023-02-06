@extends ('layouts.admin.master')
@section('pagetitle', isset($pagetitle) ? $pagetitle : 'Informasi Sistem')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Sistem</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="nama" placeholder="{{ $nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="badan">Developer</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="badan" placeholder="{{ $badan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="alamat" placeholder="{{ $alamat }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kel_des">Kelurahan / Desa</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="kel_des" placeholder="{{ $kelurahan_desa }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kec">Kecamatan</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="kec" placeholder="{{ $kecamatan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kab_kot">Kabupaten / Kota</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="kab_kot" placeholder="{{ $kabupaten_kota }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kodepos">Kode pos</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="kab_kot" placeholder="{{ $kodepos }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">HP</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="no_hp" placeholder="{{ $hp }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control form-control-border form-control-sm bg-light" id="email" placeholder="{{ $email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-sm-4">
                    <!-- Profile Image -->
                    <div class="card">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid" src="{{ config('app.url') . '/storage/' . $logo }}" alt="User profile picture">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <p class="text-muted text-center">Logo</p>
                    @csrf
                    <form id="ajaxForm" class="form-horizontal" action="{{ route('admin.info.update', '1') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="logo">File Foto / Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" name="logo" required>
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                    <span class="text-danger error-text logo_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success" id="saveBtn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script src="{{ asset('/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            bsCustomFileInput.init();
            /*--------------------------------------------------------------------------------------
             Header Token
             ----------------------------------------------------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection
