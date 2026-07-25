<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>طلب خدمة جديد</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 30px; }
        .card { max-width: 500px; margin: auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        button { margin-top: 20px; width: 100%; padding: 12px; background: #27ae60; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
        .error { color: #e74c3c; font-size: 13px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>احجز خدمة</h2>

        {{-- عرض أخطاء التحقق إن وُجدت --}}
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('requests.store') }}" method="POST">
            @csrf

            <label>نوع الخدمة</label>
            <select name="service_type" required>
                <option value="">اختر الخدمة</option>
                @foreach (['سباكة', 'كهرباء', 'نجارة', 'بناء', 'أخرى'] as $type)
                    <option value="{{ $type }}" {{ request('service_type') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>

            <label>وصف المشكلة</label>
            <textarea name="description" rows="4" placeholder="مثال: تسريب مياه تحت الحوض..." required></textarea>

            <label>العنوان</label>
            <input type="text" name="address" placeholder="اسم الحي / الشارع">

            {{-- الموقع الفعلي (lat/lng) يُملأ تلقائيًا عبر JS من متصفح الجوال في نسخة الإنتاج --}}
            <input type="hidden" name="lat" value="31.9522">
            <input type="hidden" name="lng" value="35.2332">

            <label>الوقت المفضل (اختياري)</label>
            <input type="datetime-local" name="preferred_time">

            <button type="submit">إرسال الطلب</button>
        </form>
    </div>

</body>
</html>
