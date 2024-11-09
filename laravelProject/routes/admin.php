<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Management;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CronController;
use App\Http\Controllers\Admin\FundController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawController;

// ****************** ADMIN ROUTES ******************

/********************************************************  AdminController *************************************************/
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin-register', 'registerview')->name('admin/register');
    Route::post('/admin-register-post', 'registerPOST')->name('AdminregisterPOST');
    Route::get('/admin-login', 'loginview')->name('admin/login');
    Route::post('/admin-login-post', 'AdminloginPost')->name('AdminloginPost');
    Route::get('/admin-logout', 'logout')->name('admin/logout');
});


/********************************************************  Management *************************************************/
Route::controller(Management::class)->middleware('isadmin:admin')->group(function () {
    Route::get('/admin-index', 'index')->name('admin/index');
    Route::get('/userLogin/{user_id}', 'userLogin')->name('userLogin');
    Route::get('/blockStatus/{user_id}/{status}', 'blockStatus')->name('blockStatus');
    Route::match(['get', 'post'], '/send-income', 'Send_Income')->name('send-income');
});


/********************************************************  SettingsController *************************************************/
Route::controller(SettingsController::class)->middleware('isadmin:admin')->group(function () {
    Route::match(['get', 'post'], '/admin-editUser/{user_id}', 'EditUser')->name('admin.EditUser');
    Route::match(['get', 'post'], '/news-create', 'CreateNews')->name('news-create');
    Route::match(['get', 'post'], '/edit-qrcode', 'Edit_qrcode')->name('edit_qrcode');
    Route::match(['get', 'post'], '/upload-popup', 'upload_popup')->name('upload-popup');
    Route::match(['get', 'post'], '/popuponoff', 'popuponoff')->name('popuponoff');
    Route::match(['get', 'post'], '/edit-news/{id}', 'EditNews')->name('edit-news');
    Route::match(['get', 'post'], '/delete-news/{id}', 'deleteNews')->name('delete-news');
    Route::match(['get', 'post'], '/kyc-verify/{id}', 'Kyc_verify')->name('kycverify');
});


/********************************************************  FundController *************************************************/
Route::controller(FundController::class)->middleware('isadmin:admin')->group(function () {
    Route::match(['get', 'post'], '/send-wallet', 'SendWallet')->name('send-wallet');
    Route::match(['get', 'post'], '/update-fund-request/{id}', 'Update_fund_request')->name('update-fund-request');
});


/********************************************************  UserController *************************************************/
Route::controller(UserController::class)->middleware('isadmin:admin')->group(function () {
    Route::get('/admin-AllUsers', 'Allusers')->name('admin/AllUsers');
    Route::get('/Today-Join', 'todayJoin')->name('Today-Join');
    Route::get('/income/{type}', 'incomes')->name('income');
});


/********************************************************  SupportController *************************************************/
Route::controller(SupportController::class)->middleware('isadmin:admin')->group(function () {
    Route::match(['get', 'post'], '/support', 'Support')->name('support');
    Route::match(['get', 'post'], '/Outbox-Report', 'Outbox')->name('Outbox-Report');
    Route::match(['get', 'post'], '/Inbox-Report', 'Inbox')->name('Inbox-Report');
    Route::match(['get', 'post'], '/mail-verify/{id}', 'supportview')->name('mail_verify');
});


/********************************************************  WithdrawController *************************************************/
Route::controller(WithdrawController::class)->middleware('isadmin:admin')->group(function () {
    Route::get('/withdraw-history/{status}', 'Withdraw_history')->name('withdrawhistory');
    Route::match(['get', 'post'], '/withdraw-verify/{id}', 'withdraw_verify')->name('withdrawverify');
    Route::match(['get', 'post'], '/Withdraw_on_off', 'Withdraw_on_off')->name('Withdraw_on_off');
});


/********************************************************  ReportsController *************************************************/
Route::controller(ReportsController::class)->middleware('isadmin:admin')->group(function () {
    Route::get('/income-ledgar', 'Income_ledgar')->name('income-ledgar');
    Route::get('/payout-summary', 'payout_summary')->name('payout_summary');
    Route::get('/date-wise-payout-summary/{date}', 'Date_wise_payout')->name('date-wise-payout-summary');
    Route::get('/fund-history/{status}', 'fund_history')->name('fundhistory');
    Route::get('/admin-fund-history', 'Admin_Fund_History')->name('admin_fund_history');
    Route::get('/news', 'ShowNews')->name('news');
    Route::get('/kyc-history/{status}', 'kyc_history')->name('kychistory');
});


/********************************************************  CronController *************************************************/
Route::controller(CronController::class)->middleware('isadmin:admin')->group(function () {
    Route::get('/rewardCron', 'rewardCron')->name('rewardCron');
    Route::get('/roiCron', 'roiCron')->name('roiCron');
});


/********************************************************  AdminController *************************************************/
Route::get('/check-user-session', [AdminController::class, 'checkUserSession']);


// ****************** END ADMIN ROUTES ******************
