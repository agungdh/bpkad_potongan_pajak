<!-- Sidebar -->
<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            @role('admin')
            {{-- SKPD --}}
            <li class="nav-item">
                <a href="/skpd" class="nav-link {{ Request::is('skpd') || Request::is('skpd/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building"></i>
                    <p>SKPD</p>
                </a>
            </li>
            @endrole

            @role('admin')
            {{-- Bidang --}}
            <li class="nav-item">
                <a href="/bidang" class="nav-link {{ Request::is('bidang') || Request::is('bidang/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>Bidang</p>
                </a>
            </li>
            @endrole

            @role('admin')
            {{-- Pegawai --}}
            <li class="nav-item">
                <a href="/pegawai" class="nav-link {{ Request::is('pegawai') || Request::is('pegawai/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Pegawai</p>
                </a>
            </li>
            @endrole

        </ul>
    </nav>
</div>
