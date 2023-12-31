<div class="br-sideleft overflow-y-auto icon-bawah">
    <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
    <div class="br-sideleft-menu">
        <a href="{{ route('admin.dashboard') }}" class="br-menu-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div>
        </a>
        <a href="{{ route('admin.pohon') }}" class="br-menu-link {{ Request::routeIs('admin.pohon') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-stats-bars tx-22"></i>
                <span class="menu-item-label">Data Pohon</span>
            </div>
        </a>
        <a href="{{ route('admin.peta') }}" class="br-menu-link {{ Request::routeIs('admin.peta') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-location tx-22"></i>
                <span class="menu-item-label">Peta Persebaran</span>
            </div>
        </a>

        <a href="#" class="br-menu-link {{ Request::routeIs('admin.laporan_masyarakat') || Request::routeIs('admin.laporan_internal') ? 'show-sub' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Laporan</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.laporan_masyarakat') }}" class="nav-link {{ Request::routeIs('admin.laporan_masyarakat') ? 'active' : '' }}">Laporan Masyarakat</a></li>
            <li class="nav-item"><a href="{{ route('admin.laporan_internal') }}" class="nav-link {{ Request::routeIs('admin.laporan_internal') ? 'active' : '' }}">Laporan Internal</a></li>
        </ul>

        <label class="sidebar-label pd-x-15 mg-t-20">Referensi</label>
        <a href="{{ route('admin.ref_aduan') }}" class="br-menu-link {{ Request::routeIs('admin.ref_aduan') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-clipboard tx-22"></i>
                <span class="menu-item-label">Jenis Aduan</span>
            </div>
        </a>
        <a href="{{ route('admin.ref_jenis') }}" class="br-menu-link {{ Request::routeIs('admin.ref_jenis') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-clipboard tx-22"></i>
                <span class="menu-item-label">Jenis Pohon</span>
            </div>
        </a>
        <a href="{{ route('admin.ref_akar') }}" class="br-menu-link {{ Request::routeIs('admin.ref_akar') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-clipboard tx-22"></i>
                <span class="menu-item-label">Akar Pohon</span>
            </div>
        </a>
        <a href="{{ route('admin.ref_kondisi') }}" class="br-menu-link {{ Request::routeIs('admin.ref_kondisi') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-clipboard tx-22"></i>
                <span class="menu-item-label">Kondisi Pohon</span>
            </div>
        </a>
        <a href="{{ route('admin.ref_tajuk') }}" class="br-menu-link {{ Request::routeIs('admin.ref_tajuk') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-clipboard tx-22"></i>
                <span class="menu-item-label">Tajuk</span>
            </div>
        </a>

    </div>

    <br>
</div>
