@extends('adminlte::page')

@section('title', 'Pengelolaan Kategori Barang')

@section('content_header')
    <h1>Kategori Barang</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Kategori Barang')}}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahCategorieModal"><i class="fa fa-plus"></i> Tambah Kategori</button>
                        <hr>
                        <table id="table-data" class="table table-striped table-bordered" style="width:100%">
                            <thead align="center">
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>KETERANGAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @php $no=1; @endphp
                                @foreach($categories as $categorie)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$categorie->name}}</td>
                                        <td>{{$categorie->description}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                <button type="button" id="btn-edit-categorie" class="btn btn-success" data-toggle="modal" data-target="#editCategorieModal" data-id="{{$categorie->id}}">Edit</button>
                                                <button type="button" id="btn-delete-categorie" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategorieModal" data-id="{{$categorie->id}}" data-name="{{$categorie->name}}">Hapus</button>
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

    <div class="modal fade" id="tambahCategorieModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.categorie.submit') }}" enctype="multipart/form-data">
                    @csrf 
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control" name="name" id="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="description">Ketarangan</label>
                            <input type="text" class="form-control" name="description" id="description" required autocomplete="off">
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

    <div class="modal fade" id="editCategorieModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.categorie.update') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-name">Nama Kategori</label>
                                <input type="text" class="form-control" name="name" id="edit-name" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Keterangan</label>
                                <input type="text" class="form-control" name="description" id="edit-description" required autocomplete="off">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCategorieModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus Kategori <strong><span id="caption"></span></strong>? 
                <br>
                <hr>
                <strong style="color:red">DANGER! </strong> : Seluruh Produk dengan Kategori ini akan ikut terhapus.
                <hr>
                <form method="post" action="{{ route('admin.categorie.delete') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Hapus</button>
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
            $(document).on('click', '#btn-edit-categorie', function(){
                let id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url : baseurl+'/admin/ajaxadmin/dataCategorie/'+id,
                    dataType : 'json',
                    success : function(res){
                        $('#edit-name').val(res.name);
                        $('#edit-description').val(res.description);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });
    </script>

    <script>
        $(document).on('click','#btn-delete-categorie', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#delete-id').val(id);
            $('#caption').text(name);
        })
    </script>
@stop
