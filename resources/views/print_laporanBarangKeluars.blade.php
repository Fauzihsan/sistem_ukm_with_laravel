<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center">Data Barang</h1>
    <p class="text-center">Laporan Data Barang Keluar || <?php echo now() ?></p>
    <br>
        <table id="table-data" class="table table-striped table-bordered" style="width:100%">
        <thead align="center">
            <tr>
                <th>Nama</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah</th>
                <th>Kasir</th>
            </tr>
        </thead>
        <tbody align="center">
            @php $no=1; @endphp
            @foreach($transactions as $transcation)
                <tr>
                    <td>{{$transcation->barang->name}}</td>
                    <td>{{$transcation->created_at}}</td>
                    <td>{{$transcation->qty}}</td>
                    <td>{{$transcation->cashier}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>    
</body>
</html>