@extends('layouts.app')

@section('main')
    @include('layouts.header', [
        'title' => 'Tentang Puskesmas Sekura',
        'breads' => [['Beranda', '/'], ['Tentang Kami', '/']],
    ])
    <section class="bg-white">
        <div class="container py-5">
            <div class="card shadow-lg ">
                <div class="card-body">
                    <h1 class="card-title text-success">Sejarah Puskesmas</h1>
                    <p class="card-text">
                        Sebagai upaya melayani masyarakat untuk mencapai kualitas kesehatan yang baik, Pusat Kesehatan
                        Masyarakat (Puskesmas) hadir di Indonesia sejak 1968. Puskesmas merupakan unit kesehatan yang paling
                        dekat dengan masyarakat di tingkat kecamatan dan kelurahan di bawah Dinas Kesehatan Kabupaten/Kota.
                    </p>
                    <p>
                        Puskesmas memiliki peran penting dalam menyediakan pelayanan kesehatan dasar, promotif (peningkatan
                        kesehatan), preventif (pencegahan penyakit), kuratif (pengobatan), dan rehabilitatif (pemulihan
                        kesehatan). Selain itu, Puskesmas juga berfungsi sebagai pusat pengendalian penyakit, pelaksana
                        imunisasi, dan menyediakan informasi kesehatan kepada masyarakat.
                    </p>
                    <p>
                        Seiring berjalannya waktu, konsep dan peran Puskesmas terus berkembang. Puskesmas tidak hanya
                        berfokus pada aspek medis, tetapi juga memperhatikan aspek sosial dan lingkungan yang memengaruhi
                        kesehatan masyarakat. Melalui berbagai program kesehatan, edukasi, dan kerjasama dengan komunitas,
                        Puskesmas berusaha untuk meningkatkan kualitas hidup dan kesejahteraan masyarakat.
                    </p>
                    <p>
                        Puskesmas juga menjadi tempat pelaksanaan program-program nasional seperti imunisasi, pemberian
                        vitamin A, pemeriksaan kesehatan ibu dan anak, serta program kesehatan lainnya. Puskesmas juga
                        berperan dalam mengidentifikasi dan mengatasi masalah kesehatan yang spesifik di wilayahnya.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
