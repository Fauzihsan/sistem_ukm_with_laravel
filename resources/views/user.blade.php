@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>User</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('User')}}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i> Tambah User</button>
                        <hr>
                        <table id="table-data" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($users as $user)
                                    <tr><td>
                                            @if($user->photo != null)
                                                <img src="{{asset('storage/photo_user/'.$user->photo)}}" width="100px">
                                            @else
                                                [Foto User Kosong]
                                            @endif
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role->name}}</td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basuc Example">
                                                <button type="button" id="btn-edit-user" class="btn btn-success" data-toggle="modal" data-target="#editUserModal" data-id="{{$user->id}}">Edit</button>
                                                <button type="button" id="btn-delete-user" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal" data-id="{{$user->id}}" data-name="{{$user->name}}"  data-photo="{{$user->photo}}">Hapus</button>
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

    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.user.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="roles">Role</label>
                            <select name="roles_id" class="form-control" id="roles" required autocomplete="off">
                                <option value="" selected disabled>Pilih Kategori : </option>
                            @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                            <label for="" style="color: red">Photo harus berupa jpg/jpeg/png</label>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim</button>

                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.user.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="edit-username" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="edit-email" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="roles">Role</label>
                            <select name="roles_id" class="form-control" id="edit-roles" required autocomplete="off">
                                <option value="" selected disabled>Pilih Kategori : </option>
                            @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="image-area"></div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                                <label for="" style="color: red">Photo harus berupa jpg/jpeg/png</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="old_photo" id="edit-old-photo">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus User <strong><span id="caption"></span></strong>?
                <br>
                <hr>
                <strong style="color:red">DANGER! </strong> : Seluruh history yang berkaitan dengan user ini akan ikut terhapus.
                <hr>
                <form method="post" action="{{ route('admin.user.delete') }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id">
                <input type="hidden" name="old_photo" id="delete-old-photo">
                <button type="submit" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
            $(document).on('click', '#btn-edit-user', function(){
                let id = $(this).data('id');

                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url : baseurl+'/admin/ajaxadmin/dataUser/'+id,
                    dataType : 'json',
                    success : function(res){
                        $('#edit-name').val(res.name);
                        $('#edit-username').val(res.username);
                        $('#edit-email').val(res.email);
                        $('#edit-password').val(res.password);
                        $('#edit-roles').val(res.roles_id);
                        $('#edit-id').val(res.id);
                        $('#edit-old-photo').val(res.old-photo);

                        if(res.photo !== null){
                            $('#image-area').append(
                                "<img src='"+baseurl+"/storage/photo_user/"+res.photo+"' width='200px'>"
                            );
                        }
                        else{
                            $('#image-area').append('[GAMBAR TIDAK TERSEDIA]');
                        }
                    },
                });
            });
        });
    </script>

    <script>
        $(document).on('click','#btn-delete-user', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let photo = $(this).data('photo');

            $('#delete-old-photo').val(photo);
            $('#delete-id').val(id);
            $('#caption').text(name);
        })
    </script>
@stop
