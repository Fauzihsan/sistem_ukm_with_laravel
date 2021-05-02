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
    Route::get('users',[App\Http\Controllers\UserController::class,'users'])->name('admin.users');
    Route::get('products',[App\Http\Controllers\ProductController::class,'products'])->name('admin.products');
    Route::get('categories',[App\Http\Controllers\CategorieController::class,'categories'])->name('admin.categories');
    Route::get('brands',[App\Http\Controllers\BrandController::class,'brands'])->name('admin.brands');
    Route::get('transactions',[App\Http\Controllers\TransactionController::class,'transactions'])->name('admin.transactions');
    Route::get('payments',[App\Http\Controllers\TransactionController::class,'payments'])->name('admin.payments');
    
    Route::post('books',[App\Http\Controllers\AdminController::class, 'submit_book'])->name('admin.book.submit');
    Route::post('users',[App\Http\Controllers\UserController::class, 'submit_user'])->name('admin.user.submit');
    Route::post('products',[App\Http\Controllers\ProductController::class, 'submit_product'])->name('admin.product.submit');
    Route::post('categories',[App\Http\Controllers\CategorieController::class, 'submit_categorie'])->name('admin.categorie.submit');
    Route::post('brands',[App\Http\Controllers\BrandController::class, 'submit_brand'])->name('admin.brand.submit');
    Route::post('transactions',[App\Http\Controllers\TransactionController::class, 'submit_transaction'])->name('admin.transaction.submit');
    Route::post('payments',[App\Http\Controllers\TransactionController::class, 'submit_payment'])->name('admin.payment.submit');
    Route::patch('books/update',[App\Http\Controllers\AdminController::class, 'update_book'])->name('admin.book.update');
    Route::patch('users/update',[App\Http\Controllers\UserController::class, 'update_user'])->name('admin.user.update');
    Route::patch('products/update',[App\Http\Controllers\ProductController::class, 'update_product'])->name('admin.product.update');
    Route::patch('categories/update',[App\Http\Controllers\CategorieController::class, 'update_categorie'])->name('admin.categorie.update');
    Route::patch('brands/update',[App\Http\Controllers\BrandController::class, 'update_brand'])->name('admin.brand.update');
    Route::patch('laporanBarangMasuks/update',[App\Http\Controllers\LaporanBarangMasukController::class, 'update_laporanBarangMasuks'])->name('admin.laporanBarangMasuks.update');
    Route::delete('books/delete',[App\Http\Controllers\AdminController::class,'delete_book'])->name('admin.book.delete');
    Route::delete('users/delete',[App\Http\Controllers\UserController::class,'delete_user'])->name('admin.user.delete');
    Route::delete('products/delete',[App\Http\Controllers\ProductController::class,'delete_product'])->name('admin.product.delete');
    Route::delete('categories/delete',[App\Http\Controllers\CategorieController::class,'delete_categorie'])->name('admin.categorie.delete');
    Route::delete('brands/delete',[App\Http\Controllers\BrandController::class,'delete_brand'])->name('admin.brand.delete');
    Route::delete('laporanBarangMasuks/delete',[App\Http\Controllers\LaporanBarangMasukController::class, 'delete_laporanBarangMasuks'])->name('admin.laporanBarangMasuks.delete');
});

Route::get('laporanBarangMasuks',[App\Http\Controllers\LaporanBarangMasukController::class, 'laporanBarangMasuks'])->name('admin.laporanBarangMasuks')->prefix('admin');
Route::get('laporanBarangKeluars',[App\Http\Controllers\LaporanBarangKeluarController::class, 'laporanBarangKeluars'])->name('admin.laporanBarangKeluars')->prefix('admin');

Route::get('admin/ajaxadmin/dataBuku/{id}',
[App\Http\Controllers\AdminController::class,'getDataBuku']);

Route::get('admin/ajaxadmin/dataUser/{id}',
[App\Http\Controllers\UserController::class,'getDataUser']);

Route::get('admin/ajaxadmin/dataProduct/{id}',
[App\Http\Controllers\ProductController::class,'getDataProduct']);

Route::get('admin/ajaxadmin/dataCategorie/{id}',
[App\Http\Controllers\CategorieController::class,'getDataCategorie']);


Route::get('admin/ajaxadmin/dataBrand/{id}',
[App\Http\Controllers\BrandController::class,'getDataBrand']);

Route::get('admin/ajaxadmin/laporanBarangMasuk/{id}',
[App\Http\Controllers\LaporanBarangMasukController::class,'getDataItem']);

Route::get('admin/print_books',
[App\Http\Controllers\AdminController::class,'print_books'])->name('admin.print.books')->middleware('is_admin');
Route::get('admin/print_laporanBarangMasuks',
[App\Http\Controllers\LaporanBarangMasukController::class,'print_laporanBarangMasuks'])->name('admin.print.laporanBarangMasuks')->middleware('is_admin');
Route::get('admin/print_laporanBarangKeluars',
[App\Http\Controllers\LaporanBarangKeluarController::class,'print_laporanBarangKeluars'])->name('admin.print.laporanBarangKeluars')->middleware('is_admin');


Route::get('admin/books/export',
[App\Http\Controllers\AdminController::class,'export'])->name('admin.book.export')->middleware('is_admin');

Route::post('admin/books/import',
[App\Http\Controllers\AdminController::class,'import'])->name('admin.book.import')->middleware('is_admin');

Route::post('admin/products/import',
[App\Http\Controllers\AdminController::class,'import'])->name('admin.product.import')->middleware('is_admin');

