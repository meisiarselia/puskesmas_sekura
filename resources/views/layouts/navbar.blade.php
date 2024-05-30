<header>
    <nav class="navbar navbar-expand-lg navigation" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="/images/logo.png" alt="" class="img-fluid" style="width: 50px">
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
                aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icofont-navigation-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarmain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ request()->is('beranda') ? 'active' : '' }}">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>
                    <li class="nav-item {{ request()->is('pendaftaranonline*') ? 'active' : '' }}">
                        <a class="nav-link" href="/pendaftaranonline">Pendaftaran Online</a>
                    </li>
                    <li class="nav-item dropdown {{ request()->is('tentang*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="department.html" id="dropdown03"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tentang Puskesmas <i class="icofont-thin-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown03">
                            <li>
                                <a class="dropdown-item {{ request()->is('tentang') ? 'active' : '' }}"
                                    href="/tentang">Profil Kami
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->is('tentang/struktur-organisasi') ? 'active' : '' }}"
                                    href="/tentang/struktur-organisasi">Struktur Organisasi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->is('tentang/kegiatan') ? 'active' : '' }}"
                                    href="/tentang/kegiatan">Kegiatan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->is('tentang/prestasi') ? 'active' : '' }}"
                                    href="/tentang/prestasi">Prestasi
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown {{ request()->is('pelayanan*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pelayanan <i class="icofont-thin-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown04">
                            <li>
                                <a class="dropdown-item {{ request()->is('pelayanan/jenis-pelayanan*') ? 'active' : '' }}" href="/pelayanan/jenis-pelayanan">Jenis Pelayanan</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->is('pelayanan/fasilitas*') ? 'active' : '' }}" href="/pelayanan/fasilitas">Fasilitas</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->is('pelayanan/kritik-saran*') ? 'active' : '' }}" href="/pelayanan/kritik-saran">Kritik & Saran</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#faqModal">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/beranda#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
