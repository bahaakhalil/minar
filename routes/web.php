<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

// شاشة الطلبات — CRUD كامل بسطر واحد
Route::resource('requests', RequestController::class);

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
