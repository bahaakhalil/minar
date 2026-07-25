<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>معمار | ابنِ بثقة</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f8f9fa; color: #2c3e50; }
        .hero { background: #2c3e50; color: #fff; padding: 60px 30px; text-align: center; }
        .hero h1 { font-size: 32px; margin-bottom: 10px; }
        .hero p { font-size: 16px; color: #cdd6e0; }
        .stats { display: flex; justify-content: center; gap: 40px; margin: 30px 0; }
        .stat-box { background: #fff; padding: 20px 30px; border-radius: 8px; text-align: center; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        .stat-box h3 { margin: 0; color: #3498db; font-size: 26px; }
        .specialties { display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; margin: 30px; }
        .chip { background: #3498db; color: #fff; padding: 8px 18px; border-radius: 20px; text-decoration: none; font-size: 14px; }
        .cta { display: block; width: 220px; margin: 30px auto; text-align: center; background: #27ae60; color: #fff; padding: 14px; border-radius: 8px; text-decoration: none; font-size: 16px; }
    </style>
</head>
<body>

    <div class="hero">
        <h1>معمار</h1>
        <p>ابنِ بثقة — اطلب حرفيًا موثوقًا خلال دقائق</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <h3>{{ $craftsmenCount }}</h3>
            <p>حرفي على المنصة</p>
        </div>
        <div class="stat-box">
            <h3>{{ $openRequestsCount }}</h3>
            <p>طلب مفتوح حاليًا</p>
        </div>
    </div>

    <h3 style="text-align:center;">اختر نوع الخدمة</h3>
    <div class="specialties">
        @foreach ($specialties as $specialty)
            <a href="{{ route('requests.create') }}?service_type={{ $specialty }}" class="chip">
                {{ $specialty }}
            </a>
        @endforeach
    </div>

    <a href="{{ route('requests.create') }}" class="cta">اطلب حرفي الآن</a>

</body>
</html>
