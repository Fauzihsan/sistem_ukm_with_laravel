<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('profile', function(){
    //hanya pengguna yang telah terotentikasi yang dalam mengakses rute ini
})->middleware('auth');

// Route::get('admin/home',[App\Http\Controllers\AdminController::class,'index'])->name('admin.home')->middleware('is_admin');

// Route::get('admin/books',[App\Http\Controllers\AdminController::class,'books'])->name('admin.books')->middleware('is_admin');

//PENGELOLAAN BUKU
// Route::post('admin/books',[App\Http\Controllers\AdminController::class, 'submit_book'])->name('admin.book.submit')->middleware('is_admin');

//MENGGUNAKAN METODE GROUP
Route::middleware('is_admin')->prefix('admin')->group(function(){
    Route::get('home',[App\Http\Controllers\AdminController::class,'index'])->name('admin.home');
    Route::get('books',[App\Http\Controllers\AdminController::class,'books'])->name('admin.books');
    Route::get('products',[App\Http\Controllers\AdminController::class,'products'])->name('admin.products');
    Route::get('categories',[App\Http\Controllers\AdminController::class,'categories'])->name('admin.categories');
    Route::get('brands',[App\Http\Controllers\AdminController::class,'brands'])->name('admin.brands');
    Route::post('books',[App\Http\Controllers\AdminController::class, 'submit_book'])->name('admin.book.submit');
    Route::post('products',[App\Http\Controllers\AdminController::class, 'submit_product'])->name('admin.product.submit');
    Route::post('categories',[App\Http\Controllers\AdminController::class, 'submit_categorie'])->name('admin.categorie.submit');
    Route::post('brands',[App\Http\Controllers\AdminController::class, 'submit_brand'])->name('admin.brand.submit');
    Route::patch('books/update',[App\Http\Controllers\AdminController::class, 'update_book'])->name('admin.book.update');
    Route::patch('products/update',[App\Http\Controllers\AdminController::class, 'update_product'])->name('admin.product.update');
    Route::patch('categories/update',[App\Http\Controllers\AdminController::class, 'update_categorie'])->name('admin.categorie.update');
    Route::patch('brands/update',[App\Http\Controllers\AdminController::class, 'update_brand'])->name('admin.brand.update');
    Route::delete('books/delete',[App\Http\Controllers\AdminController::class,'delete_book'])->name('admin.book.delete');
    Route::delete('products/delete',[App\Http\Controllers\AdminController::class,'delete_product'])->name('admin.product.delete');
    Route::delete('categories/delete',[App\Http\Controllers\AdminController::class,'delete_categorie'])->name('admin.categorie.delete');
    Route::delete('brands/delete',[App\Http\Controllers\AdminController::class,'delete_brand'])->name('admin.brand.delete');
});

Route::get('admin/ajaxadmin/dataBuku/{id}',
[App\Http\Controllers\AdminController::class,'getDataBuku']);

Route::get('admin/ajaxadmin/dataCategorie/{id}',
[App\Http\Controllers\AdminController::class,'getDataCategorie']);


Route::get('admin/ajaxadmin/dataBrand/{id}',
[App\Http\Controllers\AdminController::class,'getDataBrand']);

Route::get('admin/print_books',
[App\Http\Controllers\AdminController::class,'print_books'])->name('admin.print.books')->middleware('is_admin');


Route::get('admin/books/export',
[App\Http\Controllers\AdminController::class,'export'])->name('admin.book.export')->middleware('is_admin');

Route::post('admin/books/import',
[App\Http\Controllers\AdminController::class,'import'])->name('admin.book.import')->middleware('is_admin');

Route::post('admin/products/import',
[App\Http\Controllers\AdminController::class,'import'])->name('admin.product.import')->middleware('is_admin');

