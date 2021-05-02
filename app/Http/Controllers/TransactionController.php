<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Transaction;
class TransactionController extends Controller
{
    
    public function laporanBarangKeluars(){
        $user = Auth::user();
        $products = LaporanBarangKeluar::all();
        return view('laporanBarangKeluar', compact('user','products'));
    }  
    public function transactions(){
        $user = Auth::user();
        $products = Product::all();
        return view('transaction', compact('user','products'));
    }    

    public function kategori(){
        return $this->belongsTo('App\Models\Categorie', 'categories_id');
    }

    public function submit_transaction(Request $req){
        $transaction = new Transaction;

        $transaction->cashier = $req->get('cashier');
        $transaction->customer = $req->get('customer');
        $transaction->products_id = $req->get('products_id');
        $transaction->qty = $req->get('qty');
        $harga = $transaction->product->harga;
        $qty = $req->get('qty');
        $jumlah = $harga * $qty;
        $transaction->total = $jumlah;

        $transaction->save();
        return redirect()->route('admin.transactions');
    }
}
