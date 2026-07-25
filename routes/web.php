<?php

use App\Http\Controllers\RequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CraftsmanController;
use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// شاشة الطلبات — CRUD كامل بسطر واحد
Route::resource('requests', RequestController::class);

// مساحة عمل الحرفي: بروفايل، توفر، طلبات واردة (تتطلب تسجيل دخول كحرفي)
Route::middleware('auth')->prefix('craftsman')->name('craftsman.')->group(function () {
    Route::get('/profile', [CraftsmanController::class, 'profile'])->name('profile');
    Route::put('/profile', [CraftsmanController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/availability/toggle', [CraftsmanController::class, 'toggleAvailability'])->name('toggleAvailability');
    Route::get('/incoming-requests', [CraftsmanController::class, 'incomingRequests'])->name('incoming');
});

/*
هاد السطر بيولّد تلقائيًا كل الـ Routes التالية:

GET     /requests            -> index    (عرض كل الطلبات)
GET     /requests/create      -> create   (نموذج إنشاء)
POST    /requests             -> store    (حفظ)
GET     /requests/{id}        -> show     (تفاصيل طلب)
GET     /requests/{id}/edit   -> edit     (نموذج تعديل)
PUT     /requests/{id}        -> update   (تحديث)
DELETE  /requests/{id}        -> destroy  (حذف)
*/
