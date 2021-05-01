@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    <h1>Transaksi</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Transaksi')}}</div>
                    <div class="card-body">
                    <form method="post" action="{{ route('admin.transaction.submit') }}" enctype="multipart/form-data">
                    @csrf 
                        <div class="form-group">
                            <label for="cashier">Kasir</label>
                            <input type="text" class="form-control" name="cashier" id="cashier" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="customer">Customer</label>
                            <input type="text" class="form-control" name="customer" id="customer" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="barang">Barang</label>
                            <select name="products_id" class="form-control" id="products" required autocomplete="off">
                                <option value="" selected disabled>Pilih Produk : </option>
                            @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}} - Rp.{{$product->harga}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Jumlah</label>
                            <input type="number" min="0" class="form-control" name="qty" id="qty" required autocomplete="off">
                        </div>
                        <input type="hidden" name="users_id" value="{{$user->id}}"> 
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
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
@stop
