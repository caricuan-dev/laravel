@extends ('layouts.admin.master')
@section('pagetitle', isset($pagetitle) ? $pagetitle : 'Master Navigasi')
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">Admin Menu Tree</h3>
                            <a class="btn btn-success btn-xs float-right" href="javascript:void(0)" role="button" id="createAdminBtn" title="Tambah Data"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <div class="card-body">
                            <!-- Admin Menu -->
                            <nav class="mt-2">
                                <table style="width: 100%;">
                                    <tr>
                                        <th class="text-left">Menu</th>
                                        <th class="text-center"></th>
                                    </tr>
                                    @foreach ($menu_admin as $header)
                                        <tr>
                                            <td>{{ strtoupper($header->menu_title) }}</td>
                                            <td class="text-right">
                                                <a id="editAdminBtn" href="javascript:void(0)" role="button" data-id="{{ $header->id }}"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                        @if (count($header->childs))
                                            @foreach ($header->childs as $parent)
                                                <tr>
                                                    <td><i class="fas {{ $parent->icon }} nav-icon pr-2"></i>{{ $parent->menu_title }}</td>
                                                    <td class="text-right">
                                                        <a id="editAdminBtn" href="javascript:void(0)" role="button" data-id="{{ $parent->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @if (count($parent->childs))
                                                    @foreach ($parent->childs as $child)
                                                        <tr>
                                                            <td class="pl-4"><i class="fas {{ $child->icon }} nav-icon pr-2"></i>{{ $child->menu_title }}</td>
                                                            <td class="text-right">
                                                                <a id="editAdminBtn" href="javascript:void(0)" role="button" data-id="{{ $child->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                        @if (count($child->childs))
                                                            @foreach ($child->childs as $item)
                                                                <tr>
                                                                    <td class="pl-5"><i class="fas {{ $item->icon }} nav-icon pr-2"></i>{{ $item->menu_title }}</td>
                                                                    <td class="text-right">
                                                                        <a id="editAdminBtn" href="javascript:void(0)" role="button" data-id="{{ $item->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </table>
                            </nav>
                            <!-- /.Admin-menu -->

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">User Menu Tree</h3>
                            <a class="btn btn-success btn-xs float-right" href="javascript:void(0)" role="button" id="createUserBtn" title="Tambah Data"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <div class="card-body">
                            <!-- User Menu -->
                            <nav class="mt-2">
                                <table style="width: 100%;">
                                    <tr>
                                        <th class="text-left">Menu</th>
                                        <th class="text-center"></th>
                                    </tr>
                                    @foreach ($menu_user as $header)
                                        <tr>
                                            <td>{{ strtoupper($header->menu_title) }}</td>
                                            <td class="text-right">
                                                <a id="editUserBtn" href="javascript:void(0)" role="button" data-id="{{ $header->id }}"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                        @if (count($header->childs))
                                            @foreach ($header->childs as $parent)
                                                <tr>
                                                    <td><i class="fas {{ $parent->icon }} nav-icon pr-2"></i>{{ $parent->menu_title }}</td>
                                                    <td class="text-right">
                                                        <a id="editUserBtn" href="javascript:void(0)" role="button" data-id="{{ $parent->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @if (count($parent->childs))
                                                    @foreach ($parent->childs as $child)
                                                        <tr>
                                                            <td class="pl-4"><i class="fas {{ $child->icon }} nav-icon pr-2"></i>{{ $child->menu_title }}</td>
                                                            <td class="text-right">
                                                                <a id="editUserBtn" href="javascript:void(0)" role="button" data-id="{{ $child->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                        @if (count($child->childs))
                                                            @foreach ($child->childs as $item)
                                                                <tr>
                                                                    <td class="pl-5"><i class="fas {{ $item->icon }} nav-icon pr-2"></i>{{ $item->menu_title }}</td>
                                                                    <td class="text-right">
                                                                        <a id="editUserBtn" href="javascript:void(0)" role="button" data-id="{{ $item->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </table>
                            </nav>
                            <!-- /.User-menu -->
                        </div>
                    </div>
                </div>
   
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">Public Menu Tree</h3>
                            <a class="btn btn-success btn-xs float-right" href="javascript:void(0)" role="button" id="createPublicBtn" title="Tambah Data"><i class="fas fa-plus-circle"></i></a>
                        </div>
                        <div class="card-body">
                            <!-- Publik Menu -->
                            <nav class="mt-2">
                                <table style="width: 100%;">
                                    <tr>
                                        <th class="text-left">Menu</th>
                                        <th class="text-center"></th>
                                    </tr>
                                    @foreach ($menu_public as $header)
                                        <tr>
                                            <td>{{ strtoupper($header->menu_title) }}</td>
                                            <td class="text-right">
                                                <a id="editPublicBtn" href="javascript:void(0)" role="button" data-id="{{ $header->id }}"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                        @if (count($header->childs))
                                            @foreach ($header->childs as $parent)
                                                <tr>
                                                    <td><i class="fas {{ $parent->icon }} nav-icon pr-2"></i>{{ $parent->menu_title }}</td>
                                                    <td class="text-right">
                                                        <a id="editPublicBtn" href="javascript:void(0)" role="button" data-id="{{ $parent->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                                                @if (count($parent->childs))
                                                    @foreach ($parent->childs as $child)
                                                        <tr>
                                                            <td class="pl-4"><i class="fas {{ $child->icon }} nav-icon pr-2"></i>{{ $child->menu_title }}</td>
                                                            <td class="text-right">
                                                                <a id="editPublicBtn" href="javascript:void(0)" role="button" data-id="{{ $child->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                        @if (count($child->childs))
                                                            @foreach ($child->childs as $item)
                                                                <tr>
                                                                    <td class="pl-5"><i class="fas {{ $item->icon }} nav-icon pr-2"></i>{{ $item->menu_title }}</td>
                                                                    <td class="text-right">
                                                                        <a id="editPublicBtn" href="javascript:void(0)" role="button" data-id="{{ $item->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </table>
                            </nav>
                            
                            
                            <!-- /.Publik-menu -->
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">  
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center pt-1">All Menu</h3>
                            
                        </div>
                        <div class="card-body">
                            <table id="allmenustables" class="table table-bordered table-sm data-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="10%">Display</th>
                                        <th class="text-center" width="10%">Header</th>
                                        <th class="text-center" width="20%">Menu</th>
                                        <th class="text-center" width="10%">Icon</th>
                                        <th class="text-center" width="15%">Slug</th>
                                        <th class="text-center" width="15%">Permission</th>
                                        <th class="text-center" width="10%">Status</th>
                                        <th class="text-center" width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody id="allmenustables-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('modals')
    <div class="modal fade" id="ajaxAdminModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formAdminName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <form id="ajaxAdminForm" class="form-horizontal" action="">
                        <input type="hidden" name="id" value="">
                        <div id="dlokasi" class="form-group">
                            <label for="RadioLokasi1" class="control-label">Lokasi Display</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="Admin" id="RadioLokasi1" checked>
                                    <label for="RadioLokasi1">
                                        Admin
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="User" id="RadioLokasi2" disabled>
                                    <label for="RadioLokasi2">
                                        User
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="Public" id="RadioLokasi3" disabled>
                                    <label for="RadioLokasi3">
                                        Publik
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="dheader" class="form-group">
                            <label for="RadioHeader" class="control-label">Buat Sebagai Header</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="header" id="AdminHeaderYes" value="Yes">
                                    <label for="AdminHeaderYes">
                                        Ya
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="header" id="AdminHeaderNo" value ="No" checked>
                                    <label for="AdminHeaderNo">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="dmenuinduk" class="form-group">
                            <label for="menu_induk">Menu Induk</label>
                            <select class="form-control" id="menu_induk" name="menu_induk">
                                <option value="0">Pilih Menu</option>
                                @foreach ($menu_admin as $header)
                                    <option value="{{ $header->id }}">{{ $header->menu_title }}</option>
                                    @if (count($header->childs))
                                        @foreach ($header->childs as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->menu_title }}</option>
                                            @if (count($parent->childs))
                                                @foreach ($parent->childs as $child)
                                                <option value="{{ $child->id }}">{{ $child->menu_title }}</option>
                                                @endforeach
                                            @endif        
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger error-text menuinduk_error"></span>
                        </div>
                        <div id="dmenu" class="form-group">
                            <label for="menu" class="control-label">Menu</label>
                            <input type="text" class="form-control" id="menu" name="menu" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text menu_error"></span>
                        </div>
                        <div id="dsort" class="form-group">
                            <label for="sort" class="control-label">Sort Order</label>
                            <input type="text" class="form-control" id="sort" name="sort" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text sort_error"></span>
                        </div>
                        <div id="dicon" class="form-group">
                            <label for="icon" class="control-label">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text icon_error"></span>
                        </div>
                        <div id="dslug" class="form-group">
                            <label for="slug" class="control-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text slug_error"></span>
                        </div>
                        <div id="dperm" class="form-group">
                            <label for="perm" class="control-label">Permission</label>
                            <input type="hidden" id="perm_id" name="perm_id" value="">
                            <input type="text" class="form-control" id="perm" name="perm" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text role_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="statusid">Status</label>
                            <select class="form-control" id="statusid" name="statusid">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
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

    <div class="modal fade" id="ajaxUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formUserName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <form id="ajaxUserForm" class="form-horizontal" action="">
                        <input type="hidden" name="id" value="">
                        <div id="dlokasi" class="form-group">
                            <label for="RadioLokasi1" class="control-label">Lokasi Display</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="Admin" id="RadioLokasi1" disabled>
                                    <label for="RadioLokasi1">
                                        Admin
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="User" id="RadioLokasi2" checked>
                                    <label for="RadioLokasi2">
                                        User
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="Public" id="RadioLokasi3" disabled>
                                    <label for="RadioLokasi3">
                                        Publik
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="dheader" class="form-group">
                            <label for="RadioHeader" class="control-label">Buat Sebagai Header</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="header" id="UserHeaderYes" value="Yes">
                                    <label for="UserHeaderYes">
                                        Ya
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="header" id="UserHeaderNo" value ="No" checked>
                                    <label for="UserHeaderNo">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="dmenuinduk" class="form-group">
                            <label for="menu_induk">Menu Induk</label>
                            <select class="form-control" id="menu_induk" name="menu_induk">
                                <option value="0">Pilih Menu</option>
                                @foreach ($menu_user as $header)
                                    <option value="{{ $header->id }}">{{ $header->menu_title }}</option>
                                    @if (count($header->childs))
                                        @foreach ($header->childs as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->menu_title }}</option>
                                            @if (count($parent->childs))
                                                @foreach ($parent->childs as $child)
                                                <option value="{{ $child->id }}">{{ $child->menu_title }}</option>
                                                @endforeach
                                            @endif        
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger error-text menuinduk_error"></span>
                        </div>
                        <div id="dmenu" class="form-group">
                            <label for="menu" class="control-label">Menu</label>
                            <input type="text" class="form-control" id="menu" name="menu" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text menu_error"></span>
                        </div>
                        <div id="dsort" class="form-group">
                            <label for="sort" class="control-label">Sort Order</label>
                            <input type="text" class="form-control" id="sort" name="sort" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text sort_error"></span>
                        </div>
                        <div id="dicon" class="form-group">
                            <label for="icon" class="control-label">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text icon_error"></span>
                        </div>
                        <div id="dslug" class="form-group">
                            <label for="slug" class="control-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text slug_error"></span>
                        </div>
                        <div id="dperm" class="form-group">
                            <label for="perm" class="control-label">Permission</label>
                            <input type="hidden" id="perm_id" name="perm_id" value="">
                            <input type="text" class="form-control" id="perm" name="perm" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text perm_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="statusid">Status</label>
                            <select class="form-control" id="statusid" name="statusid">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
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

    <div class="modal fade" id="ajaxPublicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formPublicName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <form id="ajaxPublicForm" class="form-horizontal" action="">
                        <input type="hidden" name="id" value="">
                        <div id="dlokasi" class="form-group">
                            <label for="RadioLokasi1" class="control-label">Lokasi Display</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="Admin" id="RadioLokasi1" disabled>
                                    <label for="RadioLokasi1">
                                        Admin
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="User" id="RadioLokasi2" disabled>
                                    <label for="RadioLokasi2">
                                        User
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="lokasi" value="Public" id="RadioLokasi3" checked>
                                    <label for="RadioLokasi3">
                                        Publik
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="dheader" class="form-group">
                            <label for="RadioHeader" class="control-label">Buat Sebagai Header</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="header" id="PublicHeaderYes" value="Yes">
                                    <label for="PublicHeaderYes">
                                        Ya
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" name="header" id="PublicHeaderNo" value ="No" checked>
                                    <label for="PublicHeaderNo">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="dmenuinduk" class="form-group">
                            <label for="menu_induk">Menu Induk</label>
                            <select class="form-control" id="menu_induk" name="menu_induk">
                                <option value="0">Pilih Menu</option>
                                @foreach ($menu_public as $header)
                                    <option value="{{ $header->id }}">{{ $header->menu_title }}</option>
                                    @if (count($header->childs))
                                        @foreach ($header->childs as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->menu_title }}</option>
                                            @if (count($parent->childs))
                                                @foreach ($parent->childs as $child)
                                                <option value="{{ $child->id }}">{{ $child->menu_title }}</option>
                                                @endforeach
                                            @endif        
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger error-text menuinduk_error"></span>
                        </div>
                        <div id="dmenu" class="form-group">
                            <label for="menu" class="control-label">Menu</label>
                            <input type="text" class="form-control" id="menu" name="menu" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text menu_error"></span>
                        </div>
                        <div id="dsort" class="form-group">
                            <label for="sort" class="control-label">Sort Order</label>
                            <input type="text" class="form-control" id="sort" name="sort" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text sort_error"></span>
                        </div>
                        <div id="dicon" class="form-group">
                            <label for="icon" class="control-label">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text icon_error"></span>
                        </div>
                        <div id="dslug" class="form-group">
                            <label for="slug" class="control-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text slug_error"></span>
                        </div>
                        <div id="dperm" class="form-group">
                            <label for="perm" class="control-label">Permission</label>
                            <input type="hidden" id="perm_id" name="perm_id" value="">
                            <input type="text" class="form-control" id="perm" name="perm" placeholder="" value="" maxlength="256" required="">
                            <span class="text-danger error-text perm_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="statusid">Status</label>
                            <select class="form-control" id="statusid" name="statusid">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
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
        var table = $('#allmenustables').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.navigasi.index') }}",
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
                    data: 'display',
                    name: 'display'
                },
                {
                    data: 'header',
                    name: 'header'
                },
                {
                    data: 'menu_title',
                    name: 'menu_title'
                },
                {
                    data: 'icon',
                    name: 'icon'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'permission',
                    name: 'permission'
                },
                {
                    data: 'status_name',
                    name: 'status_name'
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
                },
                {
                    targets: 7,
                    className: 'dt-body-center'
                },
                {
                    targets: 8,
                    className: 'dt-body-center'
                }
            ]
        });
        
        /*--------------------------------------------------------------------------------------
        Create New Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('#createAdminBtn').click(function() {
            $('#ajaxAdminModal').modal('show');
            $('#formAdminName').html('Tambah Header');
            $('#ajaxAdminForm').trigger('reset');
            $('#ajaxAdminForm').attr('action', "{{ route('admin.navigasi.store') }}");
        });

        $('#createUserBtn').click(function() {
            $('#ajaxUserModal').modal('show');
            $('#formUserName').html('Tambah Menu User');
            $('#ajaxUserForm').trigger('reset');
            $('#ajaxUserForm').attr('action', "{{ route('admin.navigasi.store') }}");
        });

        $('#createPublicBtn').click(function() {
            $('#ajaxPublicModal').modal('show');
            $('#formPublicName').html('Tambah Child');
            $('#ajaxPublicForm').trigger('reset');
            $('#ajaxPublicForm').attr('action', "{{ route('admin.navigasi.store') }}");
        });

        /*--------------------------------------------------------------------------------------
        Update Button -> Save Button
        ----------------------------------------------------------------------------------------*/
        $('body').on('click', '#editAdminBtn', function() {
            var id = $(this).data('id');
            var geturl = "{{ route('admin.navigasi.edit', ':id') }}";
            var puturl = "{{ route('admin.navigasi.update', ':id') }}";
            geturl = geturl.replace(':id', id);
            puturl = puturl.replace(':id', id);
            $('#ajaxAdminModal').modal('show');
            $('#formAdminName').html('Ubah Data');
            $('#ajaxAdminForm').attr('action', puturl);
            $.get(geturl, function(data) {
                $('input[name="id"]').val(data.details.id);
                $('#RadioLokasi1').attr('checked', true);
                if (data.details.header == 'Yes') {
                    $('#AdminHeaderYes').prop('checked', true);
                } else {
                    $('#AdminHeaderNo').prop('checked', true); 
                }
                $('#menu_induk').val(data.details.parent_id);
                $('#menu').val(data.details.menu_title);
                $('#sort').val(data.details.sort_order);
                $('#icon').val(data.details.icon);
                $('#slug').val(data.details.slug);
                $('#perm').val(data.details.perm_name);
                $('#perm_id').val(data.details.perm_id);
                $('#statusid').val(data.details.status);
            }, 'json');
        });

        $('body').on('click', '#editUserBtn', function() {
            var id = $(this).data('id');
            var geturl = "{{ route('admin.navigasi.edit', ':id') }}";
            var puturl = "{{ route('admin.navigasi.update', ':id') }}";
            geturl = geturl.replace(':id', id);
            puturl = puturl.replace(':id', id);
            $('#ajaxUserModal').modal('show');
            $('#formUserName').html('Ubah Data');
            $('#ajaxUserForm').attr('action', puturl);
            $.get(geturl, function(data) {
                $('input[name="id"]').val(data.details.id);
                $('#RadioLokasi2').attr('checked', true);
                if (data.details.header == 'Yes') {
                    $('#UserHeaderYes').prop('checked', true);
                } else {
                    $('#UserHeaderNo').prop('checked', true); 
                }
                $('#menu_induk').val(data.details.parent_id);
                $('#menu').val(data.details.menu_title);
                $('#sort').val(data.details.sort_order);
                $('#icon').val(data.details.icon);
                $('#slug').val(data.details.slug);
                $('#perm').val(data.details.perm_name);
                $('#perm_id').val(data.details.perm_id);
                $('#statusid').val(data.details.status);
            }, 'json');
        });

        $('body').on('click', '#editPublicBtn', function() {
            var id = $(this).data('id');
            var geturl = "{{ route('admin.navigasi.edit', ':id') }}";
            var puturl = "{{ route('admin.navigasi.update', ':id') }}";
            geturl = geturl.replace(':id', id);
            puturl = puturl.replace(':id', id);
            $('#ajaxPublicModal').modal('show');
            $('#formPublicName').html('Ubah Data');
            $('#ajaxPublicForm').attr('action', puturl);
            $.get(geturl, function(data) {
                $('input[name="id"]').val(data.details.id);
                $('#RadioLokasi3').attr('checked', true);
                if (data.details.header == 'Yes') {
                    $('#PublicHeaderYes').prop('checked', true);
                } else {
                    $('#PublicHeaderNo').prop('checked', true); 
                }
                $('#menu_induk').val(data.details.parent_id);
                $('#menu').val(data.details.menu_title);
                $('#sort').val(data.details.sort_order);
                $('#icon').val(data.details.icon);
                $('#slug').val(data.details.slug);
                $('#perm').val(data.details.perm_name);
                $('#perm_id').val(data.details.perm_id);
                $('#statusid').val(data.details.status);
            }, 'json');
        });



        /*--------------------------------------------------------------------------------------
        Delete  Button
        ----------------------------------------------------------------------------------------*/
        $(document).on('click', '#deleteBtn', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.navigasi.destroy', ':id') }}";
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
                            toastr.success(data.msg);
                            location.reload();
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
        $('#ajaxAdminForm').on('submit', function(e) {
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
                        $('#ajaxAdminModal').modal('hide');
                        toastr.success(data.msg);
                        location.reload();
                    }
                }
            });
        });

        $('#ajaxUserForm').on('submit', function(e) {
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
                        $('#ajaxUserModal').modal('hide');
                        toastr.success(data.msg);
                        location.reload();
                    }
                }
            });
        });

        $('#ajaxPublicForm').on('submit', function(e) {
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
                        $('#ajaxPublicModal').modal('hide');
                        toastr.success(data.msg);
                        location.reload();
                    }
                }
            });
        });
    });
</script>
@endsection
