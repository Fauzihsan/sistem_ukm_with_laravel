@extends('adminlte::page')

@section('title', 'Validasi Proposal')

@section('content_header')
    <h1>Validasi Proposals</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Daftar Proposal')}}</div>
                    <div class="card-body">
                        <table id="table-data" class="table table-striped table-bordered" style="width:100%">
                            <thead align="center">
                                <tr>
                                    <th>NO</th>
                                    <th>JUDUL PROPOSAL </th>
                                    <th>FILE</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @php $no=1; @endphp
                            @if ($user->roles_id == 7)
                                @foreach($proposalsForBem as $proposal)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$proposal->title}}</td>
                                        <td><a href="download_proposal/{{$proposal->file}}">{{$proposal->file}}</a></td>
                                        <td>
                                            @if ($proposal->validated_bem == 0)
                                                    <span>Tidak Disetujui</span>
                                                    @else
                                                    <span>Sudah Disetujui</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                @if ($proposal->validated_bem == 0)
                                                @if ($comments->where('proposals_id' , $proposal->id)->count() == 0)
                                                        <button type="button" id="btn-edit-validasiProposal" class="btn btn-success" data-toggle="modal" data-target="#editValidasiProposalModal" data-id="{{$proposal->id}}">Setujui</button>
                                                        <button type="button" id="btn-add-feedback" class="btn btn-danger" data-toggle="modal" data-target="#addFeedback" data-proposals_id="{{$proposal->id}}">Tidak Disetujui</button>
                                                    @else
                                                        <span>sudah berkomentar</span>
                                                    @endif
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @elseif ($user->roles_id == 6)
                                @foreach($proposalsForBlm as $proposal)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$proposal->title}}</td>
                                        <td><a href="download_proposal/{{$proposal->file}}">{{$proposal->file}}</a></td>
                                        <td>
                                            @if ($proposal->validated_blm == 0)
                                                    <span>Belum Diperiksa</span>
                                                    @else
                                                    <span>Sudah Diperiksa</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                @if ($proposal->validated_blm == 0)
                                                        <button type="button" id="btn-edit-validasiProposal" class="btn btn-success" data-toggle="modal" data-target="#editValidasiProposalModal" data-id="{{$proposal->id}}">Diketahui</button>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            @elseif ($user->roles_id == 5)
                                @foreach($proposalsForPembimbing as $proposal)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$proposal->title}}</td>
                                        <td><a href="download_proposal/{{$proposal->file}}">{{$proposal->file}}</a></td>
                                        <td>
                                            @if ($proposal->validated_pembimbing == 0)
                                                    <span>Tidak Disetujui</span>
                                                    @else
                                                    <span>Sudah Disetujui</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                @if ($proposal->validated_pembimbing == 0)
                                                    @if ($comments->where('proposals_id' , $proposal->id)->count() == 0)
                                                    <button type="button" id="btn-edit-validasiProposal" class="btn btn-success" data-toggle="modal" data-target="#editValidasiProposalModal" data-id="{{$proposal->id}}">Setujui</button>
                                                    <button type="button" id="btn-add-feedback" class="btn btn-danger" data-toggle="modal" data-target="#addFeedback" data-proposals_id="{{$proposal->id}}">Tidak Disetujui</button>
                                                    @else
                                                        <span>sudah berkomentar</span>
                                                    @endif
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            @elseif ($user->roles_id == 4)
                                @foreach($proposalsForWd3 as $proposal)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$proposal->title}}</td>
                                        <td><a href="download_proposal/{{$proposal->file}}">{{$proposal->file}}</a></td>
                                        <td>
                                            @if ($proposal->validated_wd3 == 0)
                                                    <span>Tidak Disetujui</span>
                                                    @else
                                                    <span>Sudah Disetujui</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                @if ($proposal->validated_wd3 == 0)
                                                    @if ($comments->where('proposals_id' , $proposal->id)->count() == 0)
                                                        <button type="button" id="btn-edit-validasiProposal" class="btn btn-success" data-toggle="modal" data-target="#editValidasiProposalModal" data-id="{{$proposal->id}}">Setujui</button>
                                                        <button type="button" id="btn-add-feedback" class="btn btn-danger" data-toggle="modal" data-target="#addFeedback" data-proposals_id="{{$proposal->id}}">Tidak Disetujui</button>
                                                    @else
                                                        <span>sudah berkomentar</span>
                                                    @endif
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            @elseif ($user->roles_id == 3)
                                @foreach($proposalsForDekan as $proposal)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$proposal->title}}</td>
                                        <td><a href="download_proposal/{{$proposal->file}}">{{$proposal->file}}</a></td>
                                        <td>
                                            @if ($proposal->validated_dekan == 0)
                                                    <span>Belum Diperiksa</span>
                                                    @else
                                                    <span>Sudah Diperiksa</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                @if ($proposal->validated_dekan == 0)
                                                        <button type="button" id="btn-edit-validasiProposal" class="btn btn-success" data-toggle="modal" data-target="#editValidasiProposalModal" data-id="{{$proposal->id}}">Diketahui</button>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addFeedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Berikan Feedback dan Alasan Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.feedback.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="title">Feedback</label>
                            <textarea type="text" class="form-control" name="comment" id="comment" required autocomplete="off"></textarea>
                        </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="users_name" value="{{$user->name}}">
                <input type="hidden" name="proposals_id" id="proposals_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editValidasiProposalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PERINGATAN!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                @if ($user->roles_id == 7)
                    <form method="post" action="{{ route('admin.validasi_proposal_bem.update') }}" enctype="multipart/form-data">
                @elseif ($user->roles_id == 6)
                    <form method="post" action="{{ route('admin.validasi_proposal_blm.update') }}" enctype="multipart/form-data">
                @elseif ($user->roles_id == 5)
                    <form method="post" action="{{ route('admin.validasi_proposal_pembimbing.update') }}" enctype="multipart/form-data">
                @elseif ($user->roles_id == 4)
                    <form method="post" action="{{ route('admin.validasi_proposal_wd3.update') }}" enctype="multipart/form-data">
                @elseif ($user->roles_id == 3)
                    <form method="post" action="{{ route('admin.validasi_proposal_dekan.update') }}" enctype="multipart/form-data">
                @endif
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>Apakah anda yakin akan menyetujui Proposal : </p>
                                <input type="text" class="form-control" name="title" id="edit-title" required autocomplete="off" disabled style="background: transparent; border: none; font-weight:bold;">
                            </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="users_id" value="{{$user->id}}">
                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="file" id="file">
                <input type="hidden" name="validated_bem" id="edit-validated_bem">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Setujui</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(function(){
        $(document).on('click', '#btn-edit-validasiProposal', function(){
            let id = $(this).data('id');

            $('#image-area').empty();

            $.ajax({
                type: "get",
                url : baseurl+'/admin/ajaxadmin/dataProposal/'+id,
                dataType : 'json',
                success : function(res){
                    $('#edit-title').val(res.title);
                    $('#edit-id').val(res.id);
                    $('#edit-validated_bem').val(res.validated_bem);
                    $('#file').val(res.file);
                },
            });
        });
    });

    $(function(){
        $(document).on('click', '#btn-add-feedback', function(){
            let id = $(this).data('proposals_id');

            $.ajax({
                type: "get",
                url : baseurl+'/admin/ajaxadmin/dataProposal/'+id,
                dataType : 'json',
                success : function(res){
                    $('#proposals_id').val(res.id);
                },
            });
        });
    });
</script>
@stop
