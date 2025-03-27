<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('mahasiswa.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mahasiswa.mahasiswa.index') ? '' : 'collapsed' }}"
                href="{{ route('mahasiswa.mahasiswa.index') }}">
                <i class="bi bi-mortarboard"></i><span>Data Mahasiswa</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mahasiswa.matkul.index') ? '' : 'collapsed' }}"
                href="{{ route('mahasiswa.matkul.index') }}">
                <i class="bi bi-book"></i><span>Data Matkul</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link "
                href="">
                <i class="bi bi-calendar"></i><span>Data Absensi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mahasiswa.jadwal.index') ? '' : 'collapsed' }}"
                href="{{ route('mahasiswa.jadwal.index') }}">
                <i class="bi bi-list-check"></i><span>Data Jadwal Kuliah</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link "
                href="">
                <i class="bi bi-list-check"></i><span>Data Jurnal Perkuliahan</span>
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
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link btn btn-link" style="text-align: left; color: inherit; background-color: white;">
              <i class="bi bi-box-arrow-right"></i>
              <span>Keluar</span>
            </button>
          </form>
        </li>        
    </ul>

</aside><!-- End Sidebar-->
