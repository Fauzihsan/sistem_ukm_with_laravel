@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">


        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Selamat Datang {{$user->name}}</div>
                    <div class="card-body">
                        @if ($user->roles_id != 2 && $user->roles_id != 1)

                        <div class="row justify-content-center">
                            @if ($user->roles_id == 8)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-sitemap"></i></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Total Event {{$user->name}}</span>
                                  <span class="info-box-number">{{$jumlahActivity}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        @endif
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                @if ($user->roles_id == 8)
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-file-import"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Proposal Diajukan</span>
                                        <span class="info-box-number">{{$jumlahProposalMenungguPersetujuan}}</span>
                                    </div>
                                @else
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-procedures"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Menunggu Persetujuan</span>
                                        @if ($user->roles_id == 7)
                                            <span class="info-box-number">{{$menungguBem}}</span>
                                        @elseif ($user->roles_id == 6)
                                            <span class="info-box-number">{{$menungguBlm}}</span>
                                        @elseif ($user->roles_id == 5)
                                            <span class="info-box-number">{{$menungguPembimbing}}</span>
                                        @elseif ($user->roles_id == 4)
                                            <span class="info-box-number">{{$menungguWd3}}</span>
                                        @elseif ($user->roles_id == 3)
                                            <span class="info-box-number">{{$menungguDekan}}</span>
                                        @endif
                                    </div>
                                @endif
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix visible-sm-block"></div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="info-box">
                                  @if ($user->roles_id == 8)
                                  <span class="info-box-icon bg-blue"><i class="fa fa-check-circle"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Proposal Diterima</span>
                                    <span class="info-box-number">{{$jumlahProposalDiterima}}</span>
                                  </div>
                                  @else
                                  <span class="info-box-icon bg-blue"><i class="fa fa-check-circle"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Disetujui</span>
                                        @if ($user->roles_id == 7)
                                            <span class="info-box-number">{{$disetujuiBem}}</span>
                                        @elseif ($user->roles_id == 6)
                                            <span class="info-box-number">{{$disetujuiBlm}}</span>
                                        @elseif ($user->roles_id == 5)
                                            <span class="info-box-number">{{$disetujuiPembimbing}}</span>
                                        @elseif ($user->roles_id == 4)
                                            <span class="info-box-number">{{$disetujuiWd3}}</span>
                                        @elseif ($user->roles_id == 3)
                                            <span class="info-box-number">{{$disetujuiDekan}}</span>
                                        @endif
                                    </div>
                                  @endif
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-file"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Total Proposal Yang Ada</span>
                                  @if ($user->roles_id == 8)
                                    <span class="info-box-number">{{$jumlahProposal}}</span>
                                  @else
                                  <span class="info-box-number">{{$proposal}}</span>
                                  @endif
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        @endif
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
    <script> console.log('Hi!'); </script>
@stop
