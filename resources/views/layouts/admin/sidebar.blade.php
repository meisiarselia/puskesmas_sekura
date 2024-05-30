<div class="sidebar-container">

    <div class="sidebar" id="sidebar">
        <a class="d-flex align-items-center justify-content-center" href="/admin">
            <img src="/images/logo.png" class="mr-1" height="30">
            <h5 class="m-0">
                Puskesmas Sekura
            </h5>
        </a>
        <hr>
        <a href="/admin" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-display"></i>
            <span>Dashboard</span>
        </a>
        <a href="/admin/data-pasien" class="{{ request()->is('admin/data-pasien*') ? 'active' : '' }}">
            <i class="fa-solid fa-table-list"></i>
            <span>Data Pasien</span>
        </a>
        <a href="/admin/pendaftaran" class="{{ request()->is('admin/pendaftaran*') ? 'active' : '' }}">
            <i class="fa-solid fa-suitcase-medical"></i>
            <span>Pendaftaran Online</span>
        </a>
        <div class="drowon {{ request()->is('admin/tentang*') ? 'active' : '' }}">
            <a href="javascript:;" data-toggle="collapse" data-target="#collapseTentang">
                <i class="fa-solid fa-pen-to-square"></i>
                <span class="mr-auto">Tentang</span>
                <i class="fa-solid fa-chevron-down fa-xs chevron"></i>
            </a>
            <div class="collapse {{ request()->is('admin/tentang*') ? 'show' : '' }} pl-4" id="collapseTentang"
                data-parent="#sidebar">
                <a href="/admin/tentang/kegiatan"
                    class="{{ request()->is('admin/tentang/kegiatan*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Kegiatan</span>
                </a>
                <a href="/admin/tentang/struktur-organisasi"
                    class="{{ request()->is('admin/tentang/struktur-organisasi') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Struktur Organisasi</span>
                </a>
                <a href="/admin/tentang/prestasi"
                    class="{{ request()->is('admin/tentang/prestasi*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Prestasi</span>
                </a>
            </div>
        </div>
        <div class="drowon {{ request()->is('admin/pelayanan*') ? 'active' : '' }}">
            <a href="javascript:;" data-toggle="collapse" data-target="#collapsePelayanan">
                <i class="fa-solid fa-hand-holding-medical"></i>
                <span class="mr-auto">Pelayanan</span>
                <i class="fa-solid fa-chevron-down fa-xs chevron"></i>
            </a>
            <div class="collapse {{ request()->is('admin/pelayanan*') ? 'show' : '' }} pl-4" id="collapsePelayanan"
                data-parent="#sidebar">
                <a href="{{ route('jenis-pelayanan.index') }}"
                    class="{{ request()->is('admin/pelayanan/jenis-pelayanan*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Jenis Pelayanan</span>
                </a>
                <a href="{{ route('kritik-saran.index') }}"
                    class="{{ request()->is('admin/pelayanan/kritik-saran*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Kritik & Saran</span>
                </a>
                <a href="{{ route('fasilitas.index') }}"
                    class="{{ request()->is('admin/pelayanan/fasilitas*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Fasiliitas</span>
                </a>
            </div>
        </div>
        <div class="drowon {{ request()->is('admin/profil*') ? 'active' : '' }}">
            <a href="javascript:;" data-toggle="collapse" data-target="#collapseProfil">
                <i class="fa-solid fa-hospital"></i>
                <span class="mr-auto">Profil</span>
                <i class="fa-solid fa-chevron-down fa-xs chevron"></i>
            </a>
            <div class="collapse {{ request()->is('admin/profil*') ? 'show' : '' }} pl-4" id="collapseProfil"
                data-parent="#sidebar">
                <a href="{{ route('visi-misi.index') }}"
                    class="{{ request()->is('admin/profil/visi-misi*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Visi & Misi</span>
                </a>
                <a href="{{ route('akreditasi.index') }}"
                    class="{{ request()->is('admin/profil/akreditasi*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Akreditasi</span>
                </a>
                <a href="{{ route('direksi.index') }}"
                    class="{{ request()->is('admin/profil/direksi*') ? 'active' : '' }} ">
                    <i class="fa-solid fa-circle fa-2xs" style="font-size: .3rem"></i>
                    <span>Direksi</span>
                </a>
            </div>
        </div>

        <a href="{{ route('poli.index') }}" class="{{ request()->is('admin/poli*') ? 'active' : '' }}">
            <i class="fa-solid fa-stethoscope"></i>
            <span>Poli</span>
        </a>
        <a href="{{ route('faq.index') }}" class="{{ request()->is('admin/faq*') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-question"></i>
            <span>FAQ</span>
        </a>
        <a href="{{ route('kontak.index') }}" class="{{ request()->is('admin/kontak') ? 'active' : '' }}">
            <i class="fa-solid fa-address-book"></i>
            <span>Kontak</span>
        </a>

    </div>
</div>
