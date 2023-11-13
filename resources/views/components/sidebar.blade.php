<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" alt="" class="img-fluid" width="100%">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar simplebar-scrollable-y" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">HOME</span>
                </li>
                <li class="sidebar-item">
                    <x-sidebar-link href="{{ route('home') }}" text="Dashboard" icon="ti-layout-dashboard" />
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MASTER</span>
                </li>
                <li class="sidebar-item">
                    <x-sidebar-link href="{{ route('karyawan.index') }}" text="Karyawan" icon="user-shield" />
                </li>
                <li class="sidebar-item">
                    <x-sidebar-link href="{{ route('berkas_karyawan.index') }}" text="Berkas Karyawan" icon="books" />
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
        
        <div class="fixed-profile p-3 mx-4 mb-2 bg-danger-subtle rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">{{ session('user')['nama']  }}</h6>
                </div>
                <a href="{{ route('logout') }}" class="border-0 bg-transparent text-danger ms-auto"><i class="ti ti-power fs-6"></i></a>
            </div>
        </div>
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->