<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use PDF;
use App\Models\Categorie;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Book;
use App\Exports\BooksExport;
use App\Imports\BooksImport;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function books(){
        $user = Auth::user();
        $books = Book::all();
        return view('book', compact('user','books'));
    }

    public function products(){
        $user = Auth::user();
        $products = Product::all();
        $categories = Categorie::all();
        $brands = Brand::all();
        return view('product', compact('user','products','categories','brands'));
    }

    public function categories(){
        $user = Auth::user();
        $categories = Categorie::all();
        return view('categorie', compact('user','categories'));
    }

    public function brands(){
        $user = Auth::user();
        $brands = Brand::all();
        return view('brand', compact('user','brands'));
    }

    public function submit_book(Request $req){
        $book = new Book;

        $book->judul = $req->get('judul');
        $book->penulis = $req->get('penulis');
        $book->tahun = $req->get('tahun');
        $book->penerbit = $req->get('penerbit');

        if($req->hasFile('cover')){
            $extension = $req->file('cover')->extension();

            $filename = 'cover_buku'.time().'.'.$extension;

            $req->file('cover')->storeAs(
                'public/cover_buku',$filename
            );

            $book->cover = $filename;
        }

        $book->save();
        $notification = array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.books')->with($notification);
    }

    public function submit_product(Request $req){
        $product = new Product;

        $product->name = $req->get('name');
        $product->qty = $req->get('qty');
        $product->brands_id = $req->get('brands_id');
        $product->categories_id = $req->get('categories_id');

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

    public function getDataBuku($id){
        $buku = Book::find($id);

        return response()->json($buku);
    }

    public function getDataCategorie($id){
        $categorie = Categorie::find($id);

        return response()->json($categorie);
    }

    public function getDataBrand($id){
        $brand = Brand::find($id);

        return response()->json($brand);
    }

    public function update_book(Request $req){
        $book = Book::find($req->get('id'));

        $book->judul = $req->get('judul');
        $book->penulis = $req->get('penulis');
        $book->tahun = $req->get('tahun');
        $book->penerbit = $req->get('penerbit');

        if($req->hasFile('cover')){
            $extension = $req->file('cover')->extension();

            $filename = 'cover_buku'.time().'.'.$extension;

            $req->file('cover')->storeAs(
                'public/cover_buku',$filename
            );

            Storage::delete('public/cover_buku/'.$req->get('old_cover'));
            $book->cover = $filename;
        }

        $book->save();
        $notification = array(
            'message' => 'Data buku berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.books')->with($notification);
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

    public function delete_book(Request $req){
        $book = Book::find($req->get('id'));

        $book->delete();

        $notification = array(
            'message' => 'Buku berhasil dihapus',
            'alert-type' => 'success'
            
        );
        return redirect()->route('admin.books')->with($notification);
    }

    public function delete_product(Request $req){
        $product = Product::find($req->get('id'));

        $product->delete();

        $notification = array(
            'message' => 'Product berhasil dihapus',
            'alert-type' => 'success'
            
        );
        return redirect()->route('admin.products')->with($notification);
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

    public function delete_brand(Request $req){
        $brand = Brand::find($req->get('id'));

        $brand->delete();

        $notification = array(
            'message' => 'Brand berhasil dihapus',
            'alert-type' => 'success'
            
        );
        return redirect()->route('admin.brands')->with($notification);
    }

    public function print_books(){
        $books = Book::all();

        $pdf = PDF::loadview('print_books', ['books' => $books]);
        return $pdf->download('data_buku.pdf');
    }

    public function export(){
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    public function import(Request $req){
        Excel::import(new BooksImport, $req->file('file'));
        $notification = array(
            'message' => 'Import Data Berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.books')->with($notification);
    }

}
