<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Transaksi</title>
</head>
<body>
<h2 align="center">Laporan Data Transaksi</h2>
<!-- <center>
    <span>Range date: {{ $dari_tgl }} - {{ $sampai_tgl }}</span>
</center> -->
<table border="1" width="100%" style="border-collapse:collapse">
<tr>
    <th>No</th>
    <th>Nama Pemesan</th>
    <th>Nama Supir</th>
    <th>Jenis Kendaraan</th>
    <th>Tanggal Berangkat</th>
    <th>Harga</th>
</tr>
<tr align="center">
    <td>1</td>
    <td>Iqbal</td>
    <td>Sugardi</td>
    <td>Avanza</td>
    <td>10-12-2023</td>
    <td>Rp{{ number_format(200000, 0,',','.') }}</td>
</tr>
</table>

<script>
    window.print();
</script>
</body>
</html>
