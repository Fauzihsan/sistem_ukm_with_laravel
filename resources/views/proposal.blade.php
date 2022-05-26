@extends('adminlte::page')

@section('title', 'Pengajuan Proposal')

@section('content_header')
    <h1>Pengajuan Proposal</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengajuan Proposal')}}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahProposalModal"><i class="fa fa-plus"></i> Ajukan Proposal</button>
                        <hr>
                        <table id="table-data" class="table table-striped table-bordered" style="width:100%">
                            <thead align="center">
                                <tr>
                                    <th>NO</th>
                                    <th>JUDUL PROPOSAL </th>
                                    <th>FILE</th>
                                    <th>STATUS</th>
                                    <th>KOMENTAR</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @php $no=1; @endphp
                                @foreach($proposals as $proposal)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$proposal->title}}</td>
                                    {{-- <td>{{$proposal->file}}</td> --}}
                                    <td><a href="download_proposal/{{$proposal->file}}">{{$proposal->file}}</a></td>
                                    <td>{{$proposal->status}}</td>
                                    <td>
                                        @if ($comments->where('proposals_id' , $proposal->id)->count() != 0)
                                        <div class="btn-group" role="group" aria-label="Basic Example">
                                            <button type="button" id="btn-lihat-komentar" class="btn btn-danger" data-toggle="modal" data-target="#lihatKomentar" data-id="{{$proposal->id}}">ADA KOMENTAR</button>
                                        </div>

                                        {{-- {{$proposal->comment_by}} : <br><span style="background-color: red; color:white;">{{$proposal->comment}}</span> --}}
                                            @else
                                            <button type="button" class="btn btn-success" disabled>TIDAK ADA KOMENTAR</button>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic Example">
                                            <button type="button" id="btn-edit-proposal" class="btn btn-success" data-toggle="modal" data-target="#editProposalModal" data-id="{{$proposal->id}}">Ajukan Ulang</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        {{-- {{$comments->where('proposals_id',7)->count()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahProposalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengajuan Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.proposal.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="title">Judul Proposal</label>
                            <input type="text" class="form-control" name="title" id="title" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="fileProposal">File Proposal</label>
                            <input type="file" class="form-control" name="fileProposal" id="fileProposal" required autocomplete="off">
                            <label for="" style="color: red">File harus berupa pdf</label>
                        </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="users_id" value="{{$user->id}}">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lihatKomentar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Komntar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                    <b><span id="comment_by"></span></b> : <span id="comment_proposals"></span>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProposalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Aktivitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.proposal.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Judul Kegiatan</label>
                                <input type="text" class="form-control" name="title" id="edit-title" required autocomplete="off" disabled>
                            </div>
                            <div class="form-group">
                                <div class="form-group" id="fileProposal-area"></div>
                                <label for="fileProposal">File Proposal</label>
                                <input type="file" class="form-control" name="fileProposal" id="edit-poster">
                                <label for="" style="color: red">File harus berupa pdf</label>
                            </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="users_id" value="{{$user->id}}">
                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="old_fileProposal" id="edit-old-fileProposal">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Update</button>
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
        $(document).on('click', '#btn-edit-proposal', function(){
            let id = $(this).data('id');

            $('#image-area').empty();

            $.ajax({
                type: "get",
                url : baseurl+'/admin/ajaxadmin/dataProposal/'+id,
                dataType : 'json',
                success : function(res){
                    console.log(res);
                    $('#edit-title').val(res.title);
                    $('#edit-id').val(res.id);
                    $('#edit-old-fileProposal').val(res.old_fileProposal);
                },
            });
        });
    });

    $(function(){
        $(document).on('click', '#btn-lihat-komentar', function(){
            let id = $(this).data('id');
            console.log(id);
            $('#comment_by').empty();
            $('#comment_proposals').empty();
            $.ajax({
                type: "get",
                url : baseurl+'/admin/ajaxadmin/dataKomentar/'+id,
                dataType : 'json',
                success : function(res){
                    console.log(res);
                    $('#comment_by').append(res.comment_by);
                    $('#comment_proposals').append(res.comment);
                },
            });
        });
    });
</script>

@stop
