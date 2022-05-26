<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center">Data Proposal</h1>
    <p class="text-center">Laporan Proposal Yang disetujui sampai dengan <b><?php echo now() ?></b></p>
    <br>
        <table id="table-data" class="table table-striped table-bordered" style="width:100%">
        <thead align="center">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Proposal</th>
                <th>Mengajukan</th>
                <th>Diterima</th>
            </tr>
        </thead>
        <tbody align="center">
            @php $no=1; @endphp
            @foreach($reports as $report)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$report->title}}</td>
                <td>{{$report->proposal}}</td>
                <td>{{$report->date_submission}}</td>
                <td>{{$report->date_accepted}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
</body>
</html>
