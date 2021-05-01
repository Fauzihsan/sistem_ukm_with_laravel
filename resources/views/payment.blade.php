@extends('adminlte::page')

@section('title', 'Payment')

@section('content_header')
    <h1>Payment</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-header">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Payment')}}</div>
                    <div class="card-body">
                    <form method="post" action="{{ route('admin.payment.submit') }}" enctype="multipart/form-data">
                    @csrf 
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="text" value="{{$transaction->total}}" class="form-control" name="total" id="total" required autocomplete="off">
                          
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
