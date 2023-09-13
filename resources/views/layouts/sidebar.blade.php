<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ set_menu('dashboard') }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pendaftaran Collapse Menu -->
    <li class="nav-item {{ set_menu(['pendaftaran', 'jadwal.pasien']) }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-portrait"></i>
            <span>Pendaftaran</span>
        </a>
        <div id="collapseOne" class="collapse {{ set_show(['pasien', 'pasien.tambah', 'pasien.edit']) }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ set_menu('pendaftaran') }}" href="{{ route('pendaftaran') }}">Pendaftaran</a>
                <a class="collapse-item {{ set_menu('jadwal.pasien') }}" href="{{ route('jadwal.pasien') }}">Jadwal
                    Kunjungan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - RM Collapse Menu -->
    <li class="nav-item {{ set_menu(['rm.input', 'rm.riwayat', 'rm.input.id', 'rm.riwayat.id']) }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-file-signature"></i>
            <span>Rekam Medis</span>
        </a>
        <div id="collapseFive"
            class="collapse {{ set_show(['rm.input', 'rm.riwayat', 'rm.input.id', 'rm.riwayat.id']) }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ set_menu(['rm.input', 'rm.input.id']) }}"
                    href="{{ route('rm.input') }}">Input RM</a>
                <a class="collapse-item {{ set_menu(['rm.riwayat', 'rm.riwayat.id']) }}"
                    href="{{ route('rm.riwayat') }}">Riwayat RM</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Lab Collapse Menu -->
    <li class="nav-item {{ set_menu(['lab', 'lab.hasil']) }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-tint"></i>
            <span>Lab</span>
        </a>
        <div id="collapseThree" class="collapse {{ set_show(['lab', 'lab.hasil']) }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ set_menu('lab') }}" href="{{ route('lab') }}">Input Hasil Lab</a>
                <a class="collapse-item {{ set_menu('lab.hasil') }}" href="{{ route('lab.hasil') }}">Hasil Lab</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Lab Collapse Menu -->
    <li class="nav-item {{ set_menu(['obat', 'obat.tambah', 'obat.excel']) }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-prescription-bottle-alt"></i>
            <span>Obat</span>
        </a>
        <div id="collapseFour" class="collapse {{ set_show(['obat', 'obat.tambah', 'obat.excel']) }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ set_menu('obat') }} " href="{{ route('obat') }}">Daftar Obat</a>
                <a class="collapse-item {{ set_menu('obat.tambah') }} "href="{{ route('obat.tambah') }}">Tambah
                    Obat</a>
                <a class="collapse-item {{ set_menu('obat.excel') }} "href="{{ route('obat.excel') }}">Upload Data
                    Obat</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Admin Klinik Collapse Menu -->
    {{-- <li class="nav-item {{ set_menu(['set-jadwal']) }}">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                      aria-expanded="true" aria-controls="collapseOne">
                      <i class="fas fa-fw fa-file-signature"></i>
                      <span>Admin Klinik</span>
                  </a>
                  <div id="collapseSix"
                      class="collapse {{ set_show(['rm', 'rm.tambah', 'rm.edit', 'rm.lihat', 'rm.tambah.id']) }}"
                      aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <a class="collapse-item {{ set_menu(['rm']) }}" href="{{ route('rm') }}">Pengaturan
                              Jadwal</a>
                          <a class="collapse-item {{ set_menu(['rm.tambah', 'rm.tambah.id']) }}"
                              href="{{ route('rm.tambah') }}">Antrian</a>
                      </div>
                  </div>
              </li> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    {{-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}
</ul>
