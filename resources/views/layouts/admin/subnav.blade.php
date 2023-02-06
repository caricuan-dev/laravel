@extends ('layouts.admin.master')
@section('pagetitle', isset($pagetitle) ? $pagetitle : 'Dashboard')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ config('app.url') . '/' . $current_menu_datas->slug }}">{{ $current_menu_datas->menu }}</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
               
                    <!-- Application buttons -->
                <div class="text-center">
                  @foreach ($submenus as $submenu)
                  <a href="{{ config('app.url').'/'.$submenu->slug.'/'.$submenu->submenu_slug }}" class="btn btn-app">
                    <i class="fas {{ $submenu->submenu_icon }}"></i> {{ $submenu->submenu }}
                  </a>
                  @endforeach
                </div>
                <!-- /.card-body -->
              <!-- /.card -->
                    <!-- ./col -->
                
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection