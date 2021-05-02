<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Categorie;

class CategorieController extends Controller
{
    public function categories(){
        $user = Auth::user();
        $categories = Categorie::all();
        return view('categorie', compact('user','categories'));
    }


    public function getDataCategorie($id){
        $categorie = Categorie::find($id);

        return response()->json($categorie);
    }

    public function submit_categorie(Request $req){
        $categorie = new Categorie;

        $categorie->name = $req->get('name');
        $categorie->description = $req->get('description');

        $categorie->save();
        $notification = array(
            'message' => 'Kategori Barang berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories')->with($notification);
    }

    
    public function update_categorie(Request $req){
        $categorie = Categorie::find($req->get('id'));

        $categorie->name = $req->get('name');
        $categorie->description = $req->get('description');

        $categorie->save();
        $notification = array(
            'message' => 'Kategori Barang berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.categories')->with($notification);
    }

    public function delete_categorie(Request $req){
        $categorie = Categorie::find($req->get('id'));
        $categorie->delete();

        $notification = array(
            'message' => 'Kategori Barang berhasil dihapus',
            'alert-type' => 'success'
            
        );
        return redirect()->route('admin.categories')->with($notification);
    }
}
