@extends('adminlte::page')

@section('title', 'Laporan Barang Masuk')

@section('content_header')
    <h1>Laporan Barang Masuk</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Laporan Barang Masuk')}}</div>
                    <div class="card-body">
                        <a href="{{route('admin.print.laporanBarangMasuks')}}" target="_blank" class="btn btn-secondary"><i class="fa fa-print"></i> Unduh Laporan</a>
                        <hr>
                        <table id="table-data" class="table table-hover" style="width:100%">
                            <thead align="center">
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jumlah</th>
                                    <th>Dibuat Oleh</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @php $no=1; @endphp
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->created_at}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$product->oleh->name}}</td>
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
