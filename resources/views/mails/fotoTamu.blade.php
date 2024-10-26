<h1>Terdapat kunjungan hari ini di jam {{ \Carbon\Carbon::parse($kedatanganTamu->waktu_kedatangan)->format('H:i') }}</h1>
<p>Nama Tamu: {{ $kedatanganTamu->tamu->nama }}</p>
<p>Email Tamu: {{ $kedatanganTamu->tamu->email }}</p>
