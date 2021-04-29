<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Brand;

class BrandController extends Controller
{
    public function brands(){
        $user = Auth::user();
        $brands = Brand::all();
        return view('brand', compact('user','brands'));
    }

    public function getDataBrand($id){
        $brand = Brand::find($id);

        return response()->json($brand);
    }

    public function submit_brand(Request $req){
        $brand = new Brand;

        $brand->name = $req->get('name');
        $brand->description = $req->get('description');

        $brand->save();
        $notification = array(
            'message' => 'Brand baru berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.brands')->with($notification);
    }

    
    public function update_brand(Request $req){
        $brand = Brand::find($req->get('id'));

        $brand->name = $req->get('name');
        $brand->description = $req->get('description');

        $brand->save();
        $notification = array(
            'message' => 'Brand berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.brands')->with($notification);
    }

    public function delete_brand(Request $req){
        $brand = Brand::find($req->get('id'));

        $brand->delete();

        $notification = array(
            'message' => 'Brand berhasil dihapus',
            'alert-type' => 'success'
            
        );
        return redirect()->route('admin.brands')->with($notification);
    }
}
