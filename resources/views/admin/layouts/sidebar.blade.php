<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
  
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? '' : 'collapsed' }}" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
  
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.mahasiswa.index') ? '' : 'collapsed' }}" href="{{ route('admin.mahasiswa.index') }}">
        <i class="bi bi-journal-text"></i><span>Data Mahasiswa</span>
      </a>
    </li>
  
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.dosen.index') ? '' : 'collapsed' }}" href="{{ route('admin.dosen.index') }}">
        <i class="bi bi-journal-text"></i><span>Data Dosen</span>
      </a>
    </li>
  
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.absensi.index') ? '' : 'collapsed' }}" href="">
        <i class="bi bi-journal-text"></i><span>Data Absensi</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('admin.absensi.index') ? '' : 'collapsed' }}" href="">
        <i class="bi bi-journal-text"></i><span>Data Absensi</span>
      </a>
    </li>
  
    <li class="nav-heading">Pages</li>
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->
  
    <li class="nav-item">
      <a class="nav-link collapsed" href="" onclick="return confirm('Apakah anda yakin ingin keluar?')">
        <i class="bi bi-box-arrow-right"></i>
        <span>Keluar</span>
      </a>
    </li><!-- End Logout Nav -->
  
  </ul>
  
  </aside><!-- End Sidebar-->
  