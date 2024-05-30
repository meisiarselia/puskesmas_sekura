<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Nomor Antrian</title>
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
                Kami dari Puskesmas Sekura ingin memberitahukan bahwa Anda telah berhasil mendaftar dan memiliki kode
                pendaftaran.
                Silakan datang ke puskesmas pada hari <strong>
                    {{ Carbon\Carbon::parse($pendaftaran->tgl_berobat)->translatedFormat('l, j F Y') }}</strong> dan
                gunakan
                kode berikut untuk mengambil nomor antrian Anda:
            </p>
            <p style="font-size: 24px; font-weight: bold; padding: 10px; background-color: #f2f2f2; text-align: center">
                {{ $pendaftaran->kode }}
            </p>
            <p>
                Harap datang tepat waktu sesuai dengan tanggal Anda mendaftar. Terima kasih atas kerjasama Anda.
            </p>
            <p>
                Hormat kami,<br>
                Puskesmas Sekura
            </p>
        </div>
    </div>
</body>

</html>
