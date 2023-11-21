<div class="br-sideleft overflow-y-auto icon-bawah">
    <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
    <div class="br-sideleft-menu">
        <a href="{{ route('operator.dashboard') }}" class="br-menu-link {{ Request::routeIs('operator.dashboard') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div>
        </a>
        <a href="{{ route('operator.pohon') }}" class="br-menu-link {{ Request::routeIs('operator.pohon') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-stats-bars tx-22"></i>
                <span class="menu-item-label">Data Pohon</span>
            </div>
        </a>
        <a href="{{ route('operator.peta') }}" class="br-menu-link {{ Request::routeIs('operator.peta') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-location tx-22"></i>
                <span class="menu-item-label">Peta Persebaran</span>
            </div>
        </a>

        <a href="#" class="br-menu-link {{ Request::routeIs('operator.laporan_masyarakat') || Request::routeIs('operator.laporan_internal') ? 'show-sub' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Laporan</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('operator.laporan_masyarakat') }}" class="nav-link {{ Request::routeIs('operator.laporan_masyarakat') ? 'active' : '' }}">Laporan Masyarakat</a></li>
            <li class="nav-item"><a href="{{ route('operator.laporan_internal') }}" class="nav-link {{ Request::routeIs('operator.laporan_internal') ? 'active' : '' }}">Laporan Internal</a></li>
        </ul>
    </div>

    <br>
</div>
