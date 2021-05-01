@extends('adminlte::page')

@section('title', 'Pengelolaan Brands')

@section('content_header')
    <h1>Daftar Brands</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Brands')}}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBrandModal"><i class="fa fa-plus"></i> Tambah Brands</button>
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
                                @foreach($brands as $brand)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td>{{$brand->description}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic Example">
                                                <button type="button" id="btn-edit-brand" class="btn btn-success" data-toggle="modal" data-target="#editBrandModal" data-id="{{$brand->id}}">Edit</button>
                                                <button type="button" id="btn-delete-brand" class="btn btn-danger" data-toggle="modal" data-target="#deleteBrandModal" data-id="{{$brand->id}}" data-name="{{$brand->name}}">Hapus</button>
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

    <div class="modal fade" id="tambahBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Brands</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.brand.submit') }}" enctype="multipart/form-data">
                    @csrf 
                        <div class="form-group">
                            <label for="name">Nama Brand</label>
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

    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.brand.update') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-name">Nama Brand</label>
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

    <div class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus Brand <strong><span id="caption"></span></strong>?
                <br>
                <hr>
                <strong style="color:red">DANGER! </strong> : Seluruh Produk dengan Brands ini akan ikut terhapus.
                <hr>
                <form method="post" action="{{ route('admin.brand.delete') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id">
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
            $(document).on('click', '#btn-edit-brand', function(){
                let id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url : baseurl+'/admin/ajaxadmin/dataBrand/'+id,
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
         $(document).on('click','#btn-delete-brand', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#delete-id').val(id);
            $('#caption').text(name);
        })
    </script>
@stop
