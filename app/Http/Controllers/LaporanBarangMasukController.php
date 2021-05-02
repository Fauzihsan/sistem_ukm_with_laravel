<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Models\LaporanBarangMasuk;

class LaporanBarangMasukController extends Controller
{
    public function laporanBarangMasuks(){
        $user = Auth::user();
        $products = LaporanBarangMasuk::all();
        return view('laporanBarangMasuk', compact('user','products'));
    }   
    
    public function getDataItem($id){
        $product = LaporanBarangMasuk::find($id);

        return response()->json($product);
    }

    public function print_laporanBarangMasuks(){
        $items = LaporanBarangMasuk::all();

        $pdf = PDF::loadview('print_laporanBarangMasuks', ['items' => $items]);
        return $pdf->download('laporan_barang_masuk.pdf');
    }
}
