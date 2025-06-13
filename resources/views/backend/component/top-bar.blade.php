<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="../management/">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                    <!-- Light Logo icon -->
                    {{-- <img src="../../../../../../../HK10/NT208/FE/template/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> --}}
                    <img src="{{asset('/backend/images/uploads/logo2-resize.png')}}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span class="text-logo">

                 <!-- Light Logo text -->
                    {{-- <img src="../../../../../../../HK10/NT208/FE/template/assets/images/logo-light-text.png" class="light-logo" alt="homepage" /> --}}
                    {{-- <img src="{{asset('/backend/assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /> --}}
                    Travela
                </span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- Add logout button on the right side -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" style="display: inline; padding: 0; border: none; background: none; cursor: pointer;">
                        <i class="fas fa-sign-out-alt">LOGOUT</i>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
