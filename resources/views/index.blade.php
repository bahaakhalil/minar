<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>شاشة الطلبات</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f8f9fa; }
        h2 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #ddd; }
        th { background: #34495e; color: #fff; }
        tr:hover { background: #f1f1f1; }
        .status { padding: 4px 10px; border-radius: 12px; font-size: 13px; color: #fff; }
        .Pending { background: #f39c12; }
        .Accepted { background: #3498db; }
        .In_Progress { background: #9b59b6; }
        .Completed { background: #27ae60; }
        .Cancelled { background: #e74c3c; }
        .btn { padding: 5px 10px; border-radius: 5px; text-decoration: none; color: #fff; font-size: 13px; margin-left: 5px; }
        .btn-edit { background: #3498db; }
        .btn-delete { background: #e74c3c; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>شاشة الطلبات</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>اسم الخدمة</th>
                <th>اسم الحرفي</th>
                <th>حالة الطلب</th>
                <th>تاريخ الإنشاء</th>
                <th>السعر المتفق عليه</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $request)
                <tr>
                    {{-- اسم الخدمة --}}
                    <td>{{ $request->service_type }}</td>

                    {{-- اسم الحرفي (إذا تم التعيين) --}}
                    <td>{{ $request->craftsman->name ?? 'لم يتم التعيين بعد' }}</td>

                    {{-- حالة الطلب --}}
                    <td>
                        <span class="status {{ str_replace(' ', '_', $request->status) }}">
                            {{ $request->status }}
                        </span>
                    </td>

                    {{-- تاريخ إنشاء الطلب --}}
                    <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>

                    {{-- السعر المتفق عليه (إن وجد) --}}
                    <td>{{ $request->agreed_price ? $request->agreed_price . ' ₪' : 'غير محدد بعد' }}</td>

                    <td>
                        <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-edit">تعديل</a>
                        <form action="{{ route('requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">لا توجد طلبات حالياً</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
