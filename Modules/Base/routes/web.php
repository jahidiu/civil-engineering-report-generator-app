<?php

use Illuminate\Support\Facades\Route;
use Modules\Base\App\Http\Controllers\SignatoryController;
use Modules\Base\App\Http\Controllers\GeneralSettingController;
use Modules\Base\App\Http\Controllers\MailConfigController;
use Modules\Base\App\Http\Controllers\CertificateController;

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
        Route::get('/setting', 'index')->name('setting.index');
        Route::post('/setting', 'store')->name('setting.store');
        // Route::get('/setting/Qr-code', 'qrCodeSetting')->name('setting.qr_code');
    });

    Route::controller(MailConfigController::class)->group(function () {
        Route::get('/mail-setup', 'mailSetup')->name('mail.setup');
        Route::post('/test-mail', 'testMail')->name('mail.test');
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
    Route::controller(CertificateController::class)->middleware('auth')->group(function () {
        Route::get('/certificate', 'index')->name('certificate.index');
        Route::get('/certificate/create', 'create')->name('certificate.create');
        Route::post('/certificate', 'store')->name('certificate.store');
        Route::get('/certificate/{id}', 'show')->name('certificate.show');
        Route::get('/certificate/{id}/edit', 'edit')->name('certificate.edit');
        Route::put('/certificate/{id}', 'update')->name('certificate.update');
        Route::post('/certificate/delete', 'destroy')->name('certificate.delete');
    });
});
