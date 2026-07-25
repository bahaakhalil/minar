<?php

namespace App\Http\Controllers;

use App\Models\Craftsman;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

/**
 * Controller بسيط لمساحة عمل الحرفي: البروفايل، حالة التوفر، والطلبات الواردة.
 * ملاحظة: للتبسيط نستخدم هون auth()->user()->craftsman كإفتراض إن كل مستخدم
 * مسجّل كحرفي مرتبط بسجل Craftsman واحد (علاقة One-to-One).
 */
class CraftsmanController extends Controller
{
    /**
     * عرض بروفايل الحرفي الحالي.
     */
    public function profile()
    {
        $craftsman = auth()->user()->craftsman;

        return view('craftsman.profile', compact('craftsman'));
    }

    /**
     * تحديث بيانات البروفايل الأساسية (الاسم، رقم الهاتف، التخصص).
     */
    public function updateProfile(Request $request)
    {
        $craftsman = auth()->user()->craftsman;

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:20',
            'specialty' => 'required|string|max:100',
        ]);

        $craftsman->update($validated);

        return back()->with('success', 'تم تحديث البروفايل بنجاح.');
    }

    /**
     * تبديل حالة التوفر (متاح / غير متاح) بضغطة واحدة.
     * لو الحرفي "غير متاح"، ما بيظهر بنتائج المطابقة الجغرافية لطلبات جديدة.
     */
    public function toggleAvailability()
    {
        $craftsman = auth()->user()->craftsman;

        $craftsman->update(['is_available' => ! $craftsman->is_available]);

        return back()->with('success', $craftsman->is_available
            ? 'أصبحت متاحًا لاستقبال طلبات جديدة.'
            : 'أصبحت غير متاح مؤقتًا.');
    }

    /**
     * عرض الطلبات الواردة (المفتوحة) التي تطابق تخصص الحرفي.
     * بدون خوارزمية مسافة معقدة هون — فلترة بسيطة حسب التخصص وحالة الطلب فقط.
     */
    public function incomingRequests()
    {
        $craftsman = auth()->user()->craftsman;

        $requests = ServiceRequest::where('service_type', $craftsman->specialty)
            ->where('status', 'Pending')
            ->latest()
            ->get();

        return view('craftsman.incoming', compact('requests'));
    }
}
