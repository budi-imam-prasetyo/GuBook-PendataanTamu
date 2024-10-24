<!-- resources/views/FO/pdf/laporan-tamu.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kedatangan Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Kedatangan Tamu</h2>
        <p>Tanggal:
            @php
                $filename = ''; // Inisialisasi variabel filename
            @endphp

            @if ($filterType === 'daily' && filled($startDate) && filled($endDate))
                @php
                    $filename .= '-' . $startDate . '-sampai-' . $endDate;
                @endphp
            @elseif ($filterType === 'monthly' && filled($month) && filled($monthYear))
                @php
                    $filename .= '-bulan-' . $month . '-' . $monthYear;
                @endphp
            @elseif ($filterType === 'yearly' && filled($year))
                @php
                    $filename .= '-tahun-' . $year;
                @endphp
            @endif

            <!-- Menampilkan filename jika diperlukan -->
            {{ $filename }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Kedatangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td>{{ $item->jumlah_kedatangan }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><strong>Total Kedatangan</strong></td>
                <td><strong>{{ $data->sum('jumlah_kedatangan') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>

</html>
