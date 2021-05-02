<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Models\LaporanBarangKeluar;

class LaporanBarangKeluarController extends Controller
{
    public function laporanBarangKeluars(){
        $user = Auth::user();
        $transactions = LaporanBarangKeluar::all();
        return view('laporanBarangKeluar', compact('user','transactions'));
    }   
    
    public function getDataItem($id){
        $product = LaporanBarangKeluar::find($id);

        return response()->json($product);
    }

    public function print_laporanBarangKeluars(){
        $transactions = LaporanBarangKeluar::all();

        $pdf = PDF::loadview('print_laporanBarangKeluars', ['transactions' => $transactions]);
        return $pdf->download('laporan_barang_Keluar.pdf');
    }
}
