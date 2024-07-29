<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;
    @endphp
    <h1>Laporan Pemesanan</h1>
    <h3>Periode : {{ carbon::parse($dari_tgl)->format('d M Y') }} s/d {{ carbon::parse($sampai_tgl)->format('d M Y') }}</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>No Pemesanan</th>
                <th>Nama Pemesan</th>
                <th>No Telp</th>
                <th>Tanggal Pemesanan</th>
                <th>Jumlah Pemesanan</th>
                <th>Lokasi Penjemputan</th>
                <th>Lokasi Tujuan</th>
                <th>Total Jarak</th>
                <th>Harga Pesanan</th>
                <th>Nama Supir</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->no_pemesanan }}</td>
                    <td>{{ $item->nama_pemesan }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ carbon::parse($item->tanggal_pemesanan)->format('d M Y') }}</td>
                    <td>{{ $item->jumlah_pemesanan }}</td>
                    <td>{{ $item->lokasi_penjemputan }}</td>
                    <td>{{ $item->lokasi_tujuan }}</td>
                    <td>{{ $item->total_jarak }}</td>
                    <td>{{ number_format($item->harga_pesanan , 2,',','.') }}</td>
                    <td>{{ $item->nama_supir }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
