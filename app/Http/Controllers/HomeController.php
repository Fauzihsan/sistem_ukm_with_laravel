<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahProduct = Product::all()->count();
        $jumlahCategorie = Categorie::all()->count();
        $jumlahBrand = Brand::all()->count();
        $jumlahPegawai = User::all()->count();
        return view('home',compact('user','jumlahProduct','jumlahCategorie','jumlahBrand','jumlahPegawai'));
    }
}
