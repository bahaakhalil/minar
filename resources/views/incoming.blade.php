<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الطلبات الواردة</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 30px; }
        h2 { color: #2c3e50; }
        .request-card { background: #fff; padding: 18px; border-radius: 8px; margin-bottom: 12px; box-shadow: 0 1px 4px rgba(0,0,0,.08); display: flex; justify-content: space-between; align-items: center; }
        .info strong { display: block; color: #2c3e50; }
        .info span { color: #7f8c8d; font-size: 13px; }
        .btn-offer { background: #27ae60; color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; }
        .empty { text-align: center; color: #7f8c8d; margin-top: 40px; }
    </style>
</head>
<body>

    <h2>الطلبات الواردة المطابقة لتخصصك</h2>

    @forelse ($requests as $request)
        <div class="request-card">
            <div class="info">
                <strong>{{ $request->service_type }}</strong>
                <span>{{ $request->description }}</span><br>
                <span>{{ $request->address ?? 'بدون عنوان محدد' }} — {{ $request->created_at->diffForHumans() }}</span>
            </div>
            {{-- تقديم عرض على هذا الطلب — رابط جاهز لربطه لاحقًا بـ OfferController@create --}}
            <a href="#" class="btn-offer">قدّم عرض</a>
        </div>
    @empty
        <p class="empty">لا توجد طلبات جديدة تطابق تخصصك حاليًا.</p>
    @endforelse

</body>
</html>
