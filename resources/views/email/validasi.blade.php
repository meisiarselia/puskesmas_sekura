<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Validasi Pendaftaran</title>
    <style>
        * {
            font-family: sans-serif;
        }
    </style>
</head>

<body style="background-color: #eee">
    <div style="text-align: center;">
        <div style="display:inline-block; max-width: 600px; padding: 20px;background-color: white;text-align: left">
            <h1 style="margin: 0">Puskesmas Sekura</h1>
            <hr>
            <p>
                <strong>Kepada Yang Terhormat, {{ $pasien->jenkel == 1 ? 'Bapak' : 'Ibu' }} {{ $pasien->nama }}</strong>
            </p>
            <p>
                Kami dari Puskesmas Sekura ingin memberitahukan {!! $is_valid
                    ? 'bahwa anda <span style="color: green;font-weight: bolder">berhasil</span> melakukan pendaftaran dengan NIK:'
                    : 'bahwa pendaftaran anda <span style="color: red;font-weight: bolder">gagal</span>, dokumen yg diunggah berbeda dengan data yg diinputkan. Silahkan lakukan pendaftaran ulang. NIK'  !!}:
            </p>
            <p style="font-size: 24px; font-weight: bold; padding: 10px; background-color: #f2f2f2; text-align: center">
                {{ $pasien->nik }}
            </p>
            @if ($is_valid)
            <p>
                Segera lakukan pendaftaran konsultasi melalui link dibawah ini:
            </p>
                <a href="{{ route('pendaftaranonline.daftar') }}?nik={{ $pasien->nik }}">
                    Daftar Konsultasi
                </a>
            @else
            <p>
                Anda dapat melakukan pendaftaran ulang melalui link dibawah ini:
            </p>
                <a href="{{ route('pendaftaranonline.registrasi') }}?nik={{ $pasien->nik }}">
                    Registrasi Data
                </a>
            @endif
            <p>
                Hormat kami,<br>
                Puskesmas Sekura
            </p>
        </div>
    </div>
</body>

</html>
