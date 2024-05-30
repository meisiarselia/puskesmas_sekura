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
                Kami dari Puskesmas Sekura ingin memberitahukan bahwa Anda telah berhasil registrasi dengan NIK:

            </p>
            <p style="font-size: 24px; font-weight: bold; padding: 10px; background-color: #f2f2f2; text-align: center">
                {{ $pasien->nik }}
            </p>
            <p>
                Terima kasih atas data yang telah Anda kirimkan. Saat ini, data Anda sedang dalam proses validasi. Kami
                akan segera mengirimkan hasil validasi tersebut ke email Anda setelah proses selesai.
            </p>
            <p>
                Hormat kami,<br>
                Puskesmas Sekura
            </p>
        </div>
    </div>
</body>

</html>
