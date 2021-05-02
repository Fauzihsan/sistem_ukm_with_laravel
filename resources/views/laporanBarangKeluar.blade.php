@extends('adminlte::page')

@section('title', 'Laporan Barang Keluar')

@section('content_header')
    <h1>Laporan Barang Keluar</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Laporan Barang Keluar')}}</div>
                    <div class="card-body">
                        <a href="{{route('admin.print.laporanBarangKeluars')}}" target="_blank" class="btn btn-secondary"><i class="fa fa-print"></i> Unduh Laporan</a>
                        <hr>
                        <table id="table-data" class="table table-hover" style="width:100%">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop
