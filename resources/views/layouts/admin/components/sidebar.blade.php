<aside class="main-sidebar sidebar-dark-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="#!" class="brand-link">
      <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Efata Game Solution</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview {{ Route::is('back.cms.*') ? 'menu-open' : '' }}">
            <a href="#!" class="nav-link">
              <p style="font-size: 15px;" class="font-weight-700">
                Content Management System
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.header.index') }}" class="nav-link {{ Route::is('back.cms.header.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-desktop"></i>
                  <p>Header</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.keunggulan.index') }}" class="nav-link {{ Route::is('back.cms.keunggulan.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-thumbs-up"></i>
                  <p>Keunggulan</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.keunggulan-produk.index') }}" class="nav-link {{ Route::is('back.cms.keunggulan-produk.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-thumbs-up"></i>
                  <p>Keunggulan Produk</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.galeri.index') }}" class="nav-link {{ Route::is('back.cms.galeri.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-images"></i>
                  <p>Galeri</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.tentang-kami.index') }}" class="nav-link {{ Route::is('back.cms.tentang-kami.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>Tentang Kami</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.alasan-membeli.index') }}" class="nav-link {{ Route::is('back.cms.alasan-membeli.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-cart-plus"></i>
                  <p>Alasan Membeli</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.testimoni.index') }}" class="nav-link {{ Route::is('back.cms.testimoni.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Testimoni</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.produk.index') }}" class="nav-link {{ Route::is('back.cms.produk.*') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-boxes"></i>
                  <p>Produk</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{ route('back.cms.footer.index') }}" class="nav-link {{ Route::is('back.cms.footer.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-info"></i>
                  <p>Footer</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <hr class="border border-white">
          </li>
          <li class="nav-item">
            <a href="{{ route('back.home.index') }}" class="nav-link" target="_blank">
              <i class="nav-icon fas fa-store"></i>
              <p>POS</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
