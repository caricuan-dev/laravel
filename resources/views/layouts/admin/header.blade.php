<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ config('app.url') . '/storage/' . getSysInfo()->logo }}" alt="{{ getSysInfo()->nama }} Logo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="button"><i class="fas fa-sign-out-alt"></i></a>
            <form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

