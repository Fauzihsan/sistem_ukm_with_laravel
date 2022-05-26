@extends('adminlte::page')

@section('title', 'Aktivitas UKM')

@section('content_header')
    <h1>Kelola Aktivitas UKM</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Aktivitas UKM')}}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addActivity"><i class="fa fa-plus"></i> Tambah Aktivitas</button>
                        <hr>
                        <table id="table-data" class="table table-striped table-bordered" style="width:100%">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Poster</th>
                                    <th>Penulis</th>
                                    <th>Tanggal Posting</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @php $no=1; @endphp
                                @foreach($activities as $activity)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$activity->title}}</td>
                                        <td>{{$activity->description}}</td>
                                        <td>
                                            @if($activity->poster != null)
                                                <img src="{{asset('storage/poster_activity/'.$activity->poster)}}" width="100px">
                                            @else
                                                [Poster Kosong]
                                            @endif
                                        </td>
                                        <td><a href="/admin/users/">{{$activity->user->name}}</a></td>
                                        <td>{{$activity->created_at->toDateString()}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                <button type="button" id="btn-edit-activity" class="btn btn-success" data-toggle="modal" data-target="#editActivityModal" data-id="{{$activity->id}}">Edit</button>
                                                <button type="button" id="btn-delete-activity" class="btn btn-danger" data-toggle="modal" data-target="#deleteActivityModal" data-id="{{$activity->id}}" data-title="{{$activity->title}}"  data-poster="{{$activity->poster}}">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addActivity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Aktivitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.activity.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="title">Judul Kegiatan</label>
                            <input type="text" class="form-control" name="title" id="title" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10" required autocomplete="off"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="poster">Poster</label>
                            <input type="file" class="form-control" name="poster" id="poster">
                            <label for="" style="color: red">Poster harus berupa png/jpg/jpeg</label>
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

    <div class="modal fade" id="deleteActivityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Aktivitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus Produk <strong><span id="caption"></span></strong>?
                <form method="post" action="{{ route('admin.activity.delete') }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id">
                <input type="hidden" name="old_poster" id="delete-old-poster">
                <button type="submit" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editActivityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Aktivitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.activity.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Judul Kegiatan</label>
                                <input type="text" class="form-control" name="title" id="edit-title" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="edit-description" cols="30" rows="10" required autocomplete="off"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-group" id="image-area"></div>
                                <label for="poster">Poster</label>
                                <input type="file" class="form-control" name="poster" id="edit-poster">
                                <label for="" style="color: red">Poster harus berupa png/jpg/jpeg</label>
                            </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="users_id" value="{{$user->id}}">
                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="old_poster" id="edit-old-poster">
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
            $(document).on('click', '#btn-edit-activity', function(){
                let id = $(this).data('id');

                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url : baseurl+'/admin/ajaxadmin/dataActivity/'+id,
                    dataType : 'json',
                    success : function(res){
                        $('#edit-title').val(res.title);
                        $('#edit-description').val(res.description);
                        $('#edit-users').val(res.users_id);
                        $('#edit-id').val(res.id);
                        $('#edit-old-poster').val(res.old_poster);

                        if(res.poster !== null){
                            $('#image-area').append(
                                "<img src='"+baseurl+"/storage/poster_activity/"+res.poster+"' width='200px'>"
                            );
                        }
                        else{
                            $('#image-area').append('[POSTER TIDAK TERSEDIA]');
                        }
                    },
                });
            });
        });
    </script>

    <script>
        $(document).on('click','#btn-delete-activity', function(){
            let id = $(this).data('id');
            let title = $(this).data('title');
            let poster = $(this).data('poster');

            $('#delete-old-poster').val(poster);
            $('#delete-id').val(id);
            $('#caption').text(title);
        })
    </script>
@stop
