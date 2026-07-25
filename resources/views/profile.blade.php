<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>بروفايلي</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 30px; }
        .card { max-width: 480px; margin: auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 18px; border: none; border-radius: 6px; cursor: pointer; color: #fff; }
        .btn-save { background: #3498db; }
        .toggle-box { display: flex; justify-content: space-between; align-items: center; background: #f1f2f6; padding: 15px; border-radius: 8px; margin-top: 20px; }
        .available { background: #27ae60; }
        .unavailable { background: #e74c3c; }
        .rating { color: #f39c12; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card">
        <h2>بروفايلي</h2>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        {{-- حالة التوفر --}}
        <div class="toggle-box">
            <div>
                <strong>حالة التوفر:</strong>
                <span>{{ $craftsman->is_available ? 'متاح الآن' : 'غير متاح' }}</span>
            </div>
            <form action="{{ route('craftsman.toggleAvailability') }}" method="POST">
                @csrf
                <button type="submit" class="{{ $craftsman->is_available ? 'available' : 'unavailable' }}">
                    {{ $craftsman->is_available ? 'إيقاف الاستقبال' : 'تفعيل الاستقبال' }}
                </button>
            </form>
        </div>

        <p class="rating">التقييم: {{ $craftsman->rating ?? '—' }} / 5</p>

        {{-- تعديل البيانات الأساسية --}}
        <form action="{{ route('craftsman.updateProfile') }}" method="POST">
            @csrf

            <label>الاسم</label>
            <input type="text" name="name" value="{{ $craftsman->name }}" required>

            <label>رقم الهاتف</label>
            <input type="text" name="phone" value="{{ $craftsman->phone }}" required>

            <label>التخصص</label>
            <select name="specialty" required>
                @foreach (['سباكة', 'كهرباء', 'نجارة', 'بناء', 'أخرى'] as $type)
                    <option value="{{ $type }}" {{ $craftsman->specialty == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn-save">حفظ التعديلات</button>
        </form>
    </div>

</body>
</html>
