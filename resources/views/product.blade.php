@extends('adminlte::page')

@section('title', 'Pengelolaan Barang')

@section('content_header')
    <h1>Pengelolaan Barang</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Barang')}}</div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahProductModal"><i class="fa fa-plus"></i> Tambah Barang</button>
                        <hr>
                        <table id="table-data" class="table table-borderer" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Kategori</th>
                                    <th>Merk</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td><a href="/admin/categories/">{{$product->categorie->name}}</a></td>
                                        <td><a href="/admin/brands/">{{$product->brand->name}}</a></td>
                                        <td>
                                            @if($product->photo != null)
                                                <img src="{{asset('storage/photo_product/'.$product->photo)}}" width="100px">
                                            @else
                                                [Foto Produk Kosong]
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basuc Example">
                                                <button type="button" id="btn-edit-product" class="btn btn-success" data-toggle="modal" data-target="#editProductModal" data-id="{{$product->id}}"data-categorie="{{$product->categorie->name}}">Edit</button>
                                                <button type="button" id="btn-delete-product" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal" data-id="{{$product->id}}" data-name="{{$product->name}}"  data-photo="{{$product->photo}}">Hapus</button>
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

    <div class="modal fade" id="tambahProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.product.submit') }}" enctype="multipart/form-data">
                    @csrf 
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="text" class="form-control" name="name" id="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input type="number" min="0" class="form-control" name="qty" id="qty" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="categories">Kategori</label>
                            <select name="categories_id" class="form-control" id="categories" required autocomplete="off">
                                <option value="" selected disabled>Pilih Kategori : </option>
                            @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brands">Merk</label>
                            <select name="brands_id" class="form-control" id="brands" required>
                                <option value="" selected disabled>Pilih Brand : </option>
                            @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input type="number" min="0" class="form-control" name="qty" id="edit-qty" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="categories">Kategori</label>
                            <select name="categories_id" class="form-control" id="edit-categories" required autocomplete="off">
                                <option value="" selected disabled>Pilih Kategori : </option>
                            @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brands">Merk</label>
                            <select name="brands_id" class="form-control" id="edit-brands" required>
                                <option value="" selected disabled>Pilih Brand : </option>
                            @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="image-area"></div>
                            <div class="form-group">
                                <label for="edit-photo">Foto Produk</label>
                                <input type="file" class="form-control" name="photo" id="edit-photo">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="old_photo" id="edit-old-photo">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus Produk <strong><span id="caption"></span></strong>?
                <form method="post" action="{{ route('admin.product.delete') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id">
                <input type="hidden" name="old_photo" id="delete-old-photo">
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
            $(document).on('click', '#btn-edit-product', function(){
                let id = $(this).data('id');

                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url : baseurl+'/admin/ajaxadmin/dataProduct/'+id,
                    dataType : 'json',
                    success : function(res){
                        $('#edit-name').val(res.name);
                        $('#edit-qty').val(res.qty);
                        $('#edit-categories').val(res.categories_id);
                        $('#edit-brands').val(res.brands_id);
                        $('#edit-id').val(res.id);
                        $('#edit-old-photo').val(res.old-photo);

                        if(res.photo !== null){
                            $('#image-area').append(
                                "<img src='"+baseurl+"/storage/photo_product/"+res.photo+"' width='200px'>"
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
        $(document).on('click','#btn-delete-product', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let photo = $(this).data('photo');

            $('#delete-old-photo').val(photo);
            $('#delete-id').val(id);
            $('#caption').text(name);
        })
    </script>
@stop
