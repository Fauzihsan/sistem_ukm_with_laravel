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


Auth::routes();

Route::get('/', [App\Http\Controllers\WebController::class, 'landing']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){

    Route::get('users',[App\Http\Controllers\UserController::class,'users'])->name('admin.users')->middleware('is_superadmin');
    Route::post('users',[App\Http\Controllers\UserController::class, 'submit_user'])->name('admin.user.submit')->middleware('is_superadmin');
    Route::patch('users/update',[App\Http\Controllers\UserController::class, 'update_user'])->name('admin.user.update')->middleware('is_superadmin');
    Route::delete('users/delete',[App\Http\Controllers\UserController::class,'delete_user'])->name('admin.user.delete')->middleware('is_superadmin');

    Route::get('activities',[App\Http\Controllers\ActivityController::class,'activities'])->name('admin.activities')->middleware('is_ukm');
    Route::post('activities',[App\Http\Controllers\ActivityController::class, 'submit_activity'])->name('admin.activity.submit')->middleware('is_ukm');
    Route::patch('activities/update',[App\Http\Controllers\ActivityController::class, 'update_activity'])->name('admin.activity.update')->middleware('is_ukm');
    Route::delete('activities/delete',[App\Http\Controllers\ActivityController::class,'delete_activity'])->name('admin.activity.delete')->middleware('is_ukm');

    Route::get('proposals',[App\Http\Controllers\ProposalController::class,'proposals'])->name('admin.proposals')->middleware('is_ukm');
    Route::post('proposals',[App\Http\Controllers\ProposalController::class, 'submit_proposal'])->name('admin.proposal.submit')->middleware('is_ukm');
    Route::patch('proposals/update',[App\Http\Controllers\ProposalController::class, 'update_proposal'])->name('admin.proposal.update')->middleware('is_ukm');

    Route::get('validasi_proposals',[App\Http\Controllers\ProposalValidationController::class,'validasi_proposals'])->name('admin.validasi_proposals')->middleware('is_validator');
    Route::patch('validasi_proposals/updatebem',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_bem'])->name('admin.validasi_proposal_bem.update')->middleware('is_bem');
    Route::patch('validasi_proposals/updateblm',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_blm'])->name('admin.validasi_proposal_blm.update')->middleware('is_blm');;
    Route::patch('validasi_proposals/updatepembimbing',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_pembimbing'])->name('admin.validasi_proposal_pembimbing.update')->middleware('is_pembimbing');
    Route::patch('validasi_proposals/updatewd3',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_wd3'])->name('admin.validasi_proposal_wd3.update')->middleware('is_wakildekan');;
    Route::patch('validasi_proposals/updatedekan',[App\Http\Controllers\ProposalValidationController::class, 'update_validasi_proposal_dekan'])->name('admin.validasi_proposal_dekan.update')->middleware('is_dekan');

    Route::post('feedbacks',[App\Http\Controllers\ProposalController::class, 'submit_feedback'])->name('admin.feedback.submit');
});


Route::get('admin/ajaxadmin/dataUser/{id}', [App\Http\Controllers\UserController::class,'getDataUser']);
Route::get('admin/ajaxadmin/dataActivity/{id}', [App\Http\Controllers\ActivityController::class,'getDataActivity']);
Route::get('admin/ajaxadmin/dataProposal/{id}', [App\Http\Controllers\ProposalController::class,'getDataProposal']);
Route::get('admin/ajaxadmin/dataKomentar/{id}', [App\Http\Controllers\ProposalController::class,'getKomentar']);

Route::get('reports',[App\Http\Controllers\ReportController::class, 'reports'])->name('admin.reports')->prefix('admin')->middleware('is_baak');
Route::get('admin/print_report_proposal', [App\Http\Controllers\ReportController::class,'print_report_proposal'])->name('admin.print.reportProposal')->middleware('is_baak');
Route::get('admin/print_all_proposal', [App\Http\Controllers\ReportController::class,'print_all_proposal'])->name('admin.print.allProposal')->middleware('is_baak');
Route::get('admin/download_proposal/{filename}',[App\Http\Controllers\ProposalController::class,'downloadProposal']);
