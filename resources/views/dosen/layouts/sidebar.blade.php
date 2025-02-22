<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dosen.dashboard') ? '' : 'collapsed' }}"
                href="{{ route('dosen.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dosen.mahasiswa.index') ? '' : 'collapsed' }}"
                href="{{ route('dosen.mahasiswa.index') }}">
                <i class="bi bi-mortarboard"></i><span>Data Mahasiswa</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dosen.dosen.index') ? '' : 'collapsed' }}"
                href="{{ route('dosen.dosen.index') }}">
                <i class="bi bi-person-badge"></i><span> Data Dosen</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dosen.matkul.index') ? '' : 'collapsed' }}"
                href="{{ route('dosen.matkul.index') }}">
                <i class="bi bi-book"></i><span>Data Matkul</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dosen.absensi.index') ? '' : 'collapsed' }}"
                href="{{ route('dosen.absensi.index') }}">
                <i class="bi bi-calendar"></i><span>Data Absensi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dosen.jadwal.index') ? '' : 'collapsed' }}"
                href="{{ route('dosen.jadwal.index') }}">
                <i class="bi bi-list-check"></i><span>Data Jadwal Kuliah</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dosen.jurnal.index') ? '' : 'collapsed' }}"
                href="{{ route('dosen.jurnal.index') }}">
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
