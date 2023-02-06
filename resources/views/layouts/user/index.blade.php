@extends ('layouts.user.master')
@section('pagetitle', isset($pagetitle) ? $pagetitle : 'Dashboard')
@section('content')


    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>Dashboard</h3>
        </div>

        <div class="col-auto ml-auto text-right mt-n1">
            <span class="dropdown mr-2">
                <button class="btn btn-light bg-white shadow-sm dropdown-toggle" id="day" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="align-middle mt-n1" data-feather="calendar"></i> Today
                </button>
                <div class="dropdown-menu" aria-labelledby="day">
                    <h6 class="dropdown-header">Settings</h6>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </span>

            <button class="btn btn-primary shadow-sm">
                <i class="align-middle" data-feather="filter">&nbsp;</i>
            </button>
            <button class="btn btn-primary shadow-sm">
                <i class="align-middle" data-feather="refresh-cw">&nbsp;</i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl">
            <div class="card illustration flex-fill">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row no-gutters w-100">
                        <div class="col-8">
                            <div class="illustration-text p-3 m-1">
                                <h4 class="illustration-text">Welcome</h4>
                                {{ Auth::user()->name }}!
                            </div>
                        </div>
                        <div class="col-4 align-self-end text-right">
                            <img src="{{ config('app.url') . '/assets/user/img/avatars/customer-support.png' }}" alt="Customer Support" class="img-fluid illustration-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl">

        </div>
        <div class="col-12 col-sm-6 col-xxl">

        </div>
    </div>
@endsection
