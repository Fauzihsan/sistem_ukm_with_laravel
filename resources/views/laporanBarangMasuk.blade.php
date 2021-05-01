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

    <div class="modal fade" id="editlaporanBarangMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.laporanBarangMasuks.update') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('PATCH')
                            <div class="form-group">
                                <label for="edit-name">Nama</label>
                                <input type="text" class="form-control" name="name" id="edit-name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-created_at">Tanggal Masuk</label>
                                <input type="text" class="form-control" name="created_at" id="edit-created_at" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-qty">Jumlah</label>
                                <input type="year" class="form-control" name="qty" id="edit-qty" required>
                            </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletelaporanBarangMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus laporan barang tersebut?
                <form method="post" action="{{ route('admin.laporanBarangMasuks.delete') }}" enctype="multipart/form-data">
                    @csrf 
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
            $(document).on('click', '#btn-edit-laporanBarangMasuk', function(){
                let id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url : baseurl+'/admin/ajaxadmin/laporanBarangMasuk/'+id,
                    dataType : 'json',
                    success : function(res){
                        $('#edit-name').val(res.name);
                        $('#edit-qty').val(res.qty);
                        $('#edit-created_at').val(res.created_at);
                    },
                });
            });
        });
    </script>

    <script>
        $(document).on('click','#btn-delete-laporanBarangMasuk', function(){
            let id = $(this).data('id');

            $('#delete-id').val(id);
        })
    </script>
@stop
