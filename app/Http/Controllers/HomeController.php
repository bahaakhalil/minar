<?php

namespace App\Http\Controllers;

use App\Models\Craftsman;
use App\Models\ServiceRequest;

/**
 * Controller بسيط للصفحة الرئيسية.
 * يعرض إحصائيات سريعة + أشهر التخصصات، بدون منطق معقد.
 */
class HomeController extends Controller
{
    public function index()
    {
        // عدد الحرفيين المعتمدين (للعرض فقط، ما في فلترة حسب status هون لتبسيط الكود)
        $craftsmenCount = Craftsman::count();

        // عدد الطلبات المفتوحة حاليًا
        $openRequestsCount = ServiceRequest::where('status', 'Pending')->count();

        // قائمة التخصصات المتاحة للبحث السريع من الصفحة الرئيسية
        $specialties = ['سباكة', 'كهرباء', 'نجارة', 'بناء', 'أخرى'];

        return view('home', compact('craftsmenCount', 'openRequestsCount', 'specialties'));
    }
}
