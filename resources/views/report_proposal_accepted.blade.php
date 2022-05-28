@extends('adminlte::page')

@section('title', 'Laporan Proposal Disetujui')

@section('content_header')
    <h1>Laporan Proposal Disetujui</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Daftar Proposal')}}</div>
                    <div class="card-body">
                        <a href="{{route('admin.print.reportProposal')}}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> List Laporan</a>
                        <a href="{{route('admin.print.allProposal')}}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> File Laporan</a>
                        <hr>
                        <table id="table-data" class="table table-hover" style="width:100%">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Proposal</th>
                                    <th>Proposal</th>
                                    <th>Tanggal Mengajukan</th>
                                    <th>Tanggal Diterima</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @php $no=1; @endphp
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$report->title}}</td>
                                        <td><a href="download_proposal/{{$report->proposal}}" target="_blank">{{$report->proposal}}</a></td>
                                        <td>{{$report->date_submission}}</td>
                                        <td>{{$report->date_accepted}}</td>
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
