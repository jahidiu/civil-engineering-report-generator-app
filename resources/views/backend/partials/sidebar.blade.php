@php
    $isActive['user_management'] = isActiveMenu(['user.*', 'role.*']);
    $isActive['settings'] = isActiveMenu(['setting.*', 'mail.*', 'user.profile']);

@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ showDefaultImage('storage/' . $siteData['primary_logo']) }}" alt="Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">{{ $siteData['site_short_name'] }}</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if (Route::is('dashboard')) active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link @if (Route::is('report.*')) active @endif">
                        <i class="nav-icon bi bi-clipboard2-data-fill"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('signatory.index') }}" class="nav-link @if (Route::is('signatory.*')) active @endif">
                        <i class="nav-icon bi bi-pen"></i>
                        <p>Signatory</p>
                    </a>
                </li>

                <li class="nav-item {{ $isActive['settings'] == 'true' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-sliders2"></i>
                        <p>Site Configuration
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('setting.index') }}" class="nav-link @if (Route::is('setting.index')) active @endif">
                                <i class="nav-icon bi bi-gear"></i>
                                <p>General Setting</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('mail.setup') }}" class="nav-link @if (Route::is('mail.*')) active @endif">
                                <i class="nav-icon bi bi-envelope-plus"></i>
                                <p>Mail Setup</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
