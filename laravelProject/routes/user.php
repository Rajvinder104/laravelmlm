<?php

use App\Http\Controllers\User\FundController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Activation;
use App\Http\Controllers\User\UserSettings;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SupportController;
use App\Http\Controllers\User\UserManageController;
use App\Http\Controllers\User\RegisterController as UserRegisterController;
use App\Http\Controllers\User\ReportsController;
use App\Http\Controllers\User\TransferController;
use App\Http\Controllers\User\WithdrawController;

// ****************** USER ROUTES ******************


/********************************************************  AuthController *************************************************/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login-post', 'loginPost')->name('loginPost');
    Route::get('/session', 'session')->name('session');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/forgot-password', 'forgot')->name('forgot_password');
    Route::post('/forgot_pass', 'forgot_pass')->name('forgot_pass');
    Route::get('/get_user{user_id}', 'get_user')->name('get_user');
});


/********************************************************  UserRegisterController *************************************************/
Route::controller(UserRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    if (registration == 0) {
        Route::post('/register-post', 'registerPOST')->name('registerPOST');
    } else {
        Route::post('/register-post', 'binaryregisterPOST')->name('binaryregisterPOST');
    }
});


/********************************************************  UserManageController *************************************************/
Route::controller(UserManageController::class)->middleware('isUser:reader')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/tree/{user_id}', 'Tree')->name('tree');
});


/********************************************************  UserSettings *************************************************/
Route::controller(UserSettings::class)->middleware('isUser:reader')->group(function () {
    Route::match(['get', 'post'], '/reset-passaword', 'reset_password')->name('reset_passaword');
});


/********************************************************  ProfileController *************************************************/
Route::controller(ProfileController::class)->group(function () {
    Route::match(['get', 'post'], '/bank-detail-update', 'bank_detail')->name('bank-detail-update');
    Route::match(['get', 'post'], '/profile-update', 'profile_update')->name('profile-update');
});


/********************************************************  Activation *************************************************/
Route::controller(Activation::class)->middleware('isUser:reader')->group(function () {
    Route::get('/activate-account', 'index')->name('activate-account');
    Route::post('/activate', 'activate')->name('activate');
});


/********************************************************  SupportController *************************************************/
Route::controller(SupportController::class)->middleware('isUser:reader')->group(function () {
    Route::match(['get', 'post'], '/user-support', 'Compose_mail')->name('user-support');
    Route::match(['get', 'post'], '/user-outbox-report', 'Outbox')->name('user-outbox-report');
    Route::match(['get', 'post'], '/user-inbox-report', 'Inbox')->name('user-inbox-report');
});


/********************************************************  FundController *************************************************/
Route::controller(FundController::class)->middleware('isUser:reader')->group(function () {
    Route::match(['get', 'post'], '/request-fund', 'Request_fund')->name('request_fund');
});


/********************************************************  WithdrawController *************************************************/
Route::controller(WithdrawController::class)->middleware('isUser:reader')->group(function () {
    if (withdraw == 1) {
        Route::match(['get', 'post'], '/withdraw-wallet', 'Direct_Income_Withdraw_Wallet')->name('withdraw');
    } else {
        Route::match(['get', 'post'], '/withdraw-bank', 'Direct_Withdraw_Bank')->name('withdraw');
    }
});


/********************************************************  ReportsController *************************************************/
Route::controller(ReportsController::class)->middleware('isUser:reader')->group(function () {
    Route::get('/activation-history', 'Activation_History')->name('activation_history');
    Route::get('/my-directs', 'My_directs')->name('my_directs');
    Route::get('/my-downline-team', 'My_downline_team')->name('my-downline-team');
    Route::get('/user-income/{type}', 'incomes')->name('userincome');
    Route::get('/fund-request-history', 'fund_request_history')->name('fund_history');
    Route::get('/all-fund-history', 'Wallet_ledger')->name('wallet_ledger');
    Route::get('/withdraw-history', 'Withdraw_history')->name('withdraw_history');
    Route::get('/level-wise-report', 'levelreport')->name('levelreport');
    Route::get('/level-wise-users/{level}', 'level_users')->name('level-wise-users');
});


/********************************************************  TransferController *************************************************/
Route::controller(TransferController::class)->middleware('isUser:reader')->group(function () {
    Route::match(['get', 'post'], '/income-to-ewallet-transfer', 'income_to_eWallet_Transfer')->name('income-to-ewallet-transfer');
    Route::match(['get', 'post'], '/income-transfer', 'Income_transfer')->name('income-transfer');
    Route::match(['get', 'post'], '/wallet-transfer', 'Wallet_transfer')->name('wallet-transfer');
});

// ****************** END USER ROUTES ******************
