<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route("panel.main.index") }}">
                <img src="{{ asset("assets/img/logo-mini.png") }}" alt="homepage" class="dark-logo w-100" />
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                <li class="nav-item nav-main-title">
                    Seja bem vindo ao {{ env('APP_NAME') }}
                </li>
            </ul>
        </div>
    </nav>
</header>
