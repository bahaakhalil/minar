<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Craftsman;
use Illuminate\Http\Request;

/**
 * Controller بسيط لشاشة الطلبات.
 * يتعامل مباشرة مع Model (بدون Service/Repository) لغرض العرض والتوضيح فقط.
 */
class RequestController extends Controller
{
    /**
     * عرض كل الطلبات مع اسم الحرفي (إن وُجد).
     */
    public function index()
    {
        // eager loading لجلب اسم الحرفي مع كل طلب بدون استعلامات إضافية
        $requests = ServiceRequest::with('craftsman')->latest()->get();

        return view('requests.index', compact('requests'));
    }

    /**
     * عرض نموذج إنشاء طلب جديد.
     */
    public function create()
    {
        return view('requests.create');
    }

    /**
     * حفظ طلب جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type' => 'required|string|max:100',
            'craftsman_id' => 'nullable|exists:craftsmen,id',
            'status' => 'required|in:Pending,Accepted,In Progress,Completed,Cancelled',
            'agreed_price' => 'nullable|numeric|min:0',
        ]);

        ServiceRequest::create($validated);

        return redirect()->route('requests.index')->with('success', 'تم إنشاء الطلب بنجاح.');
    }

    /**
     * عرض تفاصيل طلب واحد.
     */
    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load('craftsman');

        return view('requests.show', compact('serviceRequest'));
    }

    /**
     * عرض نموذج تعديل الطلب.
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        $craftsmen = Craftsman::all();

        return view('requests.edit', compact('serviceRequest', 'craftsmen'));
    }

    /**
     * تحديث بيانات الطلب (مثلاً: تغيير حالته أو تعيين حرفي أو تحديد السعر).
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'service_type' => 'required|string|max:100',
            'craftsman_id' => 'nullable|exists:craftsmen,id',
            'status' => 'required|in:Pending,Accepted,In Progress,Completed,Cancelled',
            'agreed_price' => 'nullable|numeric|min:0',
        ]);

        $serviceRequest->update($validated);

        return redirect()->route('requests.index')->with('success', 'تم تحديث الطلب بنجاح.');
    }

    /**
     * حذف/إلغاء طلب.
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();

        return redirect()->route('requests.index')->with('success', 'تم حذف الطلب بنجاح.');
    }
}
