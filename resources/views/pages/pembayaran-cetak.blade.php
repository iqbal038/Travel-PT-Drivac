<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Transaksi</title>
</head>
<body>
<h2 align="center">Laporan Data Transaksi</h2>

<h3>Tabel Pembayaran</h3>
<table border="1" width="100%" style="border-collapse:collapse">
<tr>
    <th>No</th>
    <th>No.Pemesanan</th>
    <th>Nama Pemesan</th>
    <th>Status Bayar</th>
    <th>Jenis Pembayaran</th>
    <th>Tgl.Pembayaran</th>
    <th>Total Bayar</th>
</tr>
@php $no = 1; @endphp
<tr align="center">
    <td>{{ $no++ }}</td>
    <th>{{ $pembayaran->no_pemesanan }}</th>
    <td>{{ $pembayaran->nama_pemesan }}</td>
    <td>{{ $pembayaran->status }}</td>
    <td>{{ ($pembayaran->jenis_pembayaran == 'va' ? 'Virtual Account' : 'Cash') }}</td>
    <td>{{ date('d M Y', strtotime($pembayaran->tanggal_pemesanan)) }}</td>
    <td>Rp{{ number_format($pembayaran->jumlah_pembayaran, 0,',','.') }}</td>
</tr>
</table>
<script>
    window.print();
</script>
</body>
</html>
