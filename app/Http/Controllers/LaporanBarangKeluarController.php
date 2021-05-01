<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Models\Product;
use App\Models\LaporanBarangMasuk;

class LaporanBarangKeluarController extends Controller
{
    public function laporanBarangKeluars(){
        $user = Auth::user();
        $products = LaporanBarangKeluar::all();
        return view('laporanBarangKeluar', compact('user','products'));
    }   
    
    public function getDataItem($id){
        $product = LaporanBarangKeluar::find($id);

        return response()->json($product);
    }

    public function print_laporanBarangKeluars(){
        $items = LaporanBarangKeluar::all();

        $pdf = PDF::loadview('print_laporanBarangKeluars', ['items' => $items]);
        return $pdf->download('laporan_barang_keluar.pdf');
    }
}
