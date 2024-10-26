<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Penolakan Pertemuan</title>
</head>
<body>
    <h1>Pemberitahuan Penolakan Pertemuan</h1>
    <p>Yth. {{ $nama_tamu }},</p>

    <p>Kami ingin memberitahukan bahwa permintaan pertemuan Anda telah ditolak. Berikut detail pertemuan Anda:</p>
    
    <ul>
        <li>Nama Tamu: {{ $nama_tamu }}</li>
        <li>Tujuan Pertemuan: {{ $tujuan }}</li>
        <li>Waktu Perjanjian: {{ $waktu_perjanjian }}</li>
    </ul>

    <p><strong>Alasan Penolakan:</strong></p>
    <p>{{ $alasan_penolakan }}</p>

    <p>Kami mohon maaf atas ketidaknyamanan ini. Jika ada pertanyaan lebih lanjut, silakan hubungi kami melalui kontak yang tersedia.</p>

    <p>Terima kasih atas pengertiannya.</p>

    <p>Hormat kami,<br>
    SMKN 11 Bandung</p>
</body>
</html>
