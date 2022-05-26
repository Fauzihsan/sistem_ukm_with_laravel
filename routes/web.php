<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


//MENGGUNAKAN METODE GROUP
Route::prefix('admin')->group(function(){
    Route::get('home',[App\Http\Controllers\HomeController::class,'index'])->name('admin.home');

    Route::get('users',[App\Http\Controllers\UserController::class,'users'])->name('admin.users');
    Route::get('activities',[App\Http\Controllers\ActivityController::class,'activities'])->name('admin.activities');
    Route::get('proposals',[App\Http\Controllers\ProposalController::class,'proposals'])->name('admin.proposals');

    Route::get('validasi_proposals',[App\Http\Controllers\ProposalValidationController::class,'validasi_proposals'])->name('admin.validasi_proposals');

    Route::get('transactions',[App\Http\Controllers\TransactionController::class,'transactions'])->name('admin.transactions');

    Route::post('users',[App\Http\Controllers\UserController::class, 'submit_user'])->name('admin.user.submit');
    Route::post('activities',[App\Http\Controllers\ActivityController::class, 'submit_activity'])->name('admin.activity.submit');
    Route::post('proposals',[App\Http\Controllers\ProposalController::class, 'submit_proposal'])->name('admin.proposal.submit');
    Route::post('feedbacks',[App\Http\Controllers\ProposalController::class, 'submit_feedback'])->name('admin.feedback.submit');
    Route::post('transactions',[App\Http\Controllers\TransactionController::class, 'submit_transaction'])->name('admin.transaction.submit');

    Route::patch('users/update',[App\Http\Controllers\UserController::class, 'update_user'])->name('admin.user.update');
    Route::patch('activities/update',[App\Http\Controllers\ActivityController::class, 'update_activity'])->name('admin.activity.update');
    Route::patch('proposals/update',[App\Http\Controllers\ProposalController::class, 'update_proposal'])->name('admin.proposal.update');

    Route::patch('validasi_proposals/updatebem',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_bem'])->name('admin.validasi_proposal_bem.update');
    Route::patch('validasi_proposals/updateblm',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_blm'])->name('admin.validasi_proposal_blm.update');
    Route::patch('validasi_proposals/updatepembimbing',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_pembimbing'])->name('admin.validasi_proposal_pembimbing.update');
    Route::patch('validasi_proposals/updatewd3',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_wd3'])->name('admin.validasi_proposal_wd3.update');
    Route::patch('validasi_proposals/updatedekan',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_dekan'])->name('admin.validasi_proposal_dekan.update');

    Route::delete('users/delete',[App\Http\Controllers\UserController::class,'delete_user'])->name('admin.user.delete');
    Route::delete('activities/delete',[App\Http\Controllers\ActivityController::class,'delete_activity'])->name('admin.activity.delete');
    Route::delete('proposals/delete',[App\Http\Controllers\ProposalController::class,'delete_proposal'])->name('admin.proposal.delete');
});

Route::get('reports',[App\Http\Controllers\ReportController::class, 'reports'])->name('admin.reports')->prefix('admin');
Route::get('admin/print_report_proposal',
[App\Http\Controllers\ReportController::class,'print_report_proposal'])->name('admin.print.reportProposal');


Route::get('admin/download_proposal/{filename}',[App\Http\Controllers\ProposalController::class,'downloadProposal']);

// Route::get('laporan',[App\Http\Controllers\ReportValidationController::class, 'reports'])->name('admin.laporanBarangMasuks')->prefix('admin.reports');
// Route::get('laporan_proposals_accepted',[App\Http\Controllers\LaporanBarangKeluarController::class, 'laporanBarangKeluars'])->name('admin.laporanBarangKeluars')->prefix('admin');

Route::get('admin/ajaxadmin/dataUser/{id}',
[App\Http\Controllers\UserController::class,'getDataUser']);
Route::get('admin/ajaxadmin/dataActivity/{id}',
[App\Http\Controllers\ActivityController::class,'getDataActivity']);
Route::get('admin/ajaxadmin/dataProposal/{id}',
[App\Http\Controllers\ProposalController::class,'getDataProposal']);
Route::get('admin/ajaxadmin/dataKomentar/{id}',
[App\Http\Controllers\ProposalController::class,'getKomentar']);
Route::get('admin/ajaxadmin/dataBrand/{id}',
[App\Http\Controllers\BrandController::class,'getDataBrand']);
// Route::get('admin/ajaxadmin/laporanBarangMasuk/{id}',
// [App\Http\Controllers\LaporanBarangMasukController::class,'getDataItem']);



// Route::get('admin/print_laporanBarangMasuks',
// [App\Http\Controllers\LaporanBarangMasukController::class,'print_laporanBarangMasuks'])->name('admin.print.laporanBarangMasuks')->middleware('is_baak');
// Route::get('admin/print_laporanBarangKeluars',
// [App\Http\Controllers\LaporanBarangKeluarController::class,'print_laporanBarangKeluars'])->name('admin.print.laporanBarangKeluars')->middleware('is_baak');

// Route::get('admin/activities/export',[App\Http\Controllers\ActivityController::class,'export'])->name('admin.product.export')->middleware('is_baak');




// PENGELOLAAN BUKU

// Route::get('admin/home',[App\Http\Controllers\AdminController::class,'index'])->name('admin.home')->middleware('is_admin');
// Route::get('admin/books',[App\Http\Controllers\AdminController::class,'books'])->name('admin.books')->middleware('is_admin');

// Route::post('admin/books',[App\Http\Controllers\AdminController::class, 'submit_book'])->name('admin.book.submit')->middleware('is_admin');
// Route::get('books',[App\Http\Controllers\AdminController::class,'books'])->name('admin.books');
// Route::post('books',[App\Http\Controllers\AdminController::class, 'submit_book'])->name('admin.book.submit');
// Route::patch('books/update',[App\Http\Controllers\AdminController::class, 'update_book'])->name('admin.book.update');
// Route::delete('books/delete',[App\Http\Controllers\AdminController::class,'delete_book'])->name('admin.book.delete');
// Route::get('admin/ajaxadmin/dataBuku/{id}',[App\Http\Controllers\AdminController::class,'getDataBuku']);
// Route::get('admin/print_books',[App\Http\Controllers\AdminController::class,'print_books'])->name('admin.print.books')->middleware('is_admin');
// Route::get('admin/books/export',[App\Http\Controllers\AdminController::class,'export'])->name('admin.book.export')->middleware('is_admin');
// Route::post('admin/books/import',[App\Http\Controllers\AdminController::class,'import'])->name('admin.book.import')->middleware('is_admin');

