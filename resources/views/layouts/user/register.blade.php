<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">
    <title>{{ config('app.name') }} - Masuk atau Daftar</title>
    <link rel="shortcut icon" href="{{ config('app.url') . '/assets/user/img/ico.jpg' }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link class="js-stylesheet" href="{{ config('app.url') . '/assets/user/css/light.css' }}" rel="stylesheet">
</head>
<!--
      HOW TO USE:
      data-theme: default (default), dark, light
      data-layout: fluid (default), boxed
      data-sidebar-position: left (default), right
      data-sidebar-behavior: sticky (default), fixed, compact
    -->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="main d-flex justify-content-center w-100">
        <main class="content d-flex p-0">
            <div class="container d-flex flex-column">
                <div class="row h-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">

                            <div class="text-center mt-4">
                                <h1 class="h2">Get started</h1>
                                <p class="lead">
                                    Start creating the best possible user experience for you customers.
                                </p>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <form action="{{ route('user.create') }}" method="post" autocomplete="off">
                                            @if (Session::get('success'))
                                                <div class="alert alert-success">
                                                    {{ Session::get('success') }}
                                                </div>
                                            @endif
                                            @if (Session::get('fail'))
                                                <div class="alert alert-danger">
                                                    {{ Session::get('fail') }}
                                                </div>
                                            @endif

                                            @csrf
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input class="form-control form-control-lg" type="text" name="name" placeholder="Full Name" />
                                                <small class="form-text text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control form-control-lg" type="email" name="email" placeholder="Email" />
                                                <small class="form-text text-danger">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control form-control-lg" type="password" name="password" placeholder="Password" />
                                                <small class="form-text text-danger">
                                                    @error('password')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="form-group">
                                                <label>Repeat Password</label>
                                                <input class="form-control form-control-lg" type="password" name="cpassword" placeholder="Repeat Password" />
                                                <small class="form-text text-danger">
                                                    @error('cpassword')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>
                                            <div class="form-group">
                                                <label>Rank</label>
                                                <select class="form-control form-control-lg" id="pangkat_id" name="pangkat">
                                                    <option value="">Choose Rank</option>
                                                    @foreach (getRanks() as $rank)
                                                        <option value='{{ $rank->id }}'>{{ $rank->rank }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-danger">
                                                    @error('pangkat')
                                                        {{ $message }}
                                                    @enderror
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select class="form-control form-control-lg" id="unit_id" name="unit">
                                                    <option value="">Choose Unit</option>
                                                    @foreach (getUnits() as $unit)
                                                        <option value='{{ $unit->id }}'>{{ $unit->unit }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-danger">
                                                    @error('unit')
                                                        {{ $message }}
                                                    @enderror
                                                </small>

                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-lg btn-primary">Daftar</button>
                                            </div>
                                        </form>
                                        <div class="text-center pt-2">
                                            <a href="{{ route('user.login') }}">Sudah punya akun? Klik untuk login.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ config('app.url') . '/assets/user/js/app.js' }}"></script>

</body>

</html>
