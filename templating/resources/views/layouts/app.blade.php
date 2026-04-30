<ul class="navbar-nav">

  <!-- Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fa-solid fa-tv text-primary"></i>
      <span class="nav-link-text ms-1">Dashboard</span>
    </a>
  </li>

  <!-- MENU UTAMA -->
  <li class="nav-item mt-3">
    <h6 class="ps-4 text-uppercase text-xs font-weight-bolder opacity-6">
      Menu Utama
    </h6>
  </li>

  <!-- Profile -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('profile.show') }}">
      <i class="fa-solid fa-user text-dark"></i>
      <span class="nav-link-text ms-1">Profile Saya</span>
    </a>
  </li>

  <!-- Daftar Barang -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('productProfile.index') }}">
      <i class="fa-solid fa-box text-success"></i>
      <span class="nav-link-text ms-1">Daftar Barang</span>
    </a>
  </li>

  <!-- Transaksi -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('transaksi.index') }}">
      <i class="fa-solid fa-right-left text-warning"></i>
      <span class="nav-link-text ms-1">Transaksi</span>
    </a>
  </li>

</ul>