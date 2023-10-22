<div class="br-sideleft overflow-y-auto icon-bawah">
    <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
    <div class="br-sideleft-menu">
        <a href="{{ route('super_admin.dashboard') }}" class="br-menu-link {{ Request::routeIs('super_admin.dashboard') ? 'active' : ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a>    
        
        <label class="sidebar-label pd-x-15 mg-t-20">Setting</label>
        <a href="{{ route('super_admin.role') }}" class="br-menu-link {{ Request::routeIs('super_admin.role') ? 'active' : ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-locked tx-22"></i>
                <span class="menu-item-label">Role</span>
            </div><!-- menu-item -->
        </a>   
        <a href="{{ route('super_admin.registrasi') }}" class="br-menu-link {{ Request::routeIs('super_admin.registrasi') ? 'active' : ''}}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-android-people tx-22"></i>
                <span class="menu-item-label">Registrasi</span>
            </div><!-- menu-item -->
        </a>
        
    </div><!-- br-sideleft-menu -->

    <br>
</div>