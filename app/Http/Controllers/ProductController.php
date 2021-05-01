<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Categorie;
use App\Models\Brand;
use App\Models\LaporanBarangMasuk;

class ProductController extends Controller
{
    public function products(){
        $user = Auth::user();
        $products = Product::all();
        $categories = Categorie::all();
        $brands = Brand::all();
        return view('product', compact('user','products','categories','brands'));
    }

    
    public function getDataProduct($id){
        $product = Product::find($id);

        return response()->json($product);
    }
    
    public function submit_product(Request $req){
        $product = new Product;

        $product->name = $req->get('name');
        $product->qty = $req->get('qty');
        $product->harga = $req->get('harga');
        $product->brands_id = $req->get('brands_id');
        $product->categories_id = $req->get('categories_id');
        $product->users_id = $req->get('users_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();

            $filename = 'photo_product'.time().'.'.$extension;

            $req->file('photo')->storeAs(
                'public/photo_product',$filename
            );

            $product->photo = $filename;
        }

        $product->save();
        $notification = array(
            'message' => 'Data Product berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.products')->with($notification);
    }

    
    public function update_product(Request $req){
        $product = Product::find($req->get('id'));

        $product->name = $req->get('name');
        $product->qty = $req->get('qty');
        $product->harga = $req->get('harga');
        $product->categories_id = $req->get('categories_id');
        $product->brands_id = $req->get('brands_id');
        $product->users_id = $req->get('users_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();

            $filename = 'photo_product'.time().'.'.$extension;

            $req->file('photo')->storeAs(
                'public/photo_product',$filename
            );

            Storage::delete('public/photo_product/'.$req->get('old_photo'));
            $product->photo = $filename;
        }

        $product->save();
        $notification = array(
            'message' => 'Data Product berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.products')->with($notification);
    }

    
    public function delete_product(Request $req){
        $product = Product::find($req->get('id'));

        Storage::delete('public/photo_product/'.$req->get('old_photo'));
        $product->delete();

        $notification = array(
            'message' => 'Product berhasil dihapus',
            'alert-type' => 'success'
            
        );
        return redirect()->route('admin.products')->with($notification);
    }

}
