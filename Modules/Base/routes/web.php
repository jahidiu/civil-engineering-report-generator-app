<?php

use Illuminate\Support\Facades\Route;
use Modules\Base\App\Http\Controllers\SignatoryController;
use Modules\Base\App\Http\Controllers\GeneralSettingController;
use Modules\Base\App\Http\Controllers\MailConfigController;
use Modules\Base\App\Http\Controllers\ReportController;

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


Route::group(['middleware' => 'auth', 'prefix' => 'base'], function () {

    Route::controller(GeneralSettingController::class)->group(function () {
        Route::get('/setting', 'index')->name('setting.index')->middleware('permission:general.setting');
        Route::get('/donation-setting', 'donationSetting')->name('setting.donation')->middleware('permission:general.setting');
        Route::post('/setting', 'store')->name('setting.store');
        Route::get('/setting/Qr-code', 'qrCodeSetting')->name('setting.qr_code')->middleware('permission:setting.qr_code');
    });

    Route::controller(MailConfigController::class)->group(function () {
        Route::get('/mail-setup', 'mailSetup')->name('mail.setup')->middleware('permission:mail.setup');
        Route::post('/test-mail', 'testMail')->name('mail.test')->middleware('permission:mail.test');
        Route::post('/update-mail-settings', 'updateMailSettings')->name('mail.update_settings');
    });

    Route::controller(SignatoryController::class)->middleware('auth')->group(function () {
        Route::get('/signatory', 'index')->name('signatory.index');
        Route::get('/signatory/create', 'create')->name('signatory.create');
        Route::post('/signatory', 'store')->name('signatory.store');
        Route::get('/signatory/{id}/edit', 'edit')->name('signatory.edit');
        Route::put('/signatory/{id}', 'update')->name('signatory.update');
        Route::post('/signatory/delete', 'destroy')->name('signatory.delete');
        Route::get('/signatory/get-list', 'get_for_select')->name('signatory.list');
    });
    Route::controller(ReportController::class)->middleware('auth')->group(function () {
        Route::get('/report', 'index')->name('report.index');
        Route::get('/report/create', 'create')->name('report.create');
        Route::post('/report', 'store')->name('report.store');
        Route::get('/report/{id}', 'show')->name('report.show');
        Route::get('/report/{id}/edit', 'edit')->name('report.edit');
        Route::put('/report/{id}', 'update')->name('report.update');
        Route::post('/report/delete', 'destroy')->name('report.delete');
    });
});
