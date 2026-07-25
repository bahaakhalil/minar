# Mimar Platform (معمار)

> **"ابنِ بثقة، ابدأ بمعمار"**

منصة رقمية **Two-Sided Marketplace** تربط الحرفيين المهرة (سباكين، كهربائيين، نجارين، بنّائين...) بأصحاب المنازل والشركات والمنظمات في فلسطين، ضمن بيئة موثوقة وشفافة وآمنة.

---

## 1. About

Mimar (معمار) هي منصة تربط طالبي خدمات الصيانة والبناء بحرفيين موثوقين تم فحصهم عبر آلية اعتماد من 5 مراحل، مع نظام دفع مُعلّق (Escrow) وضمان جودة لمدة 30 يومًا.

المشروع مبني بلغة **PHP / Laravel** كتطبيق ويب متكامل (Blade Views + Controllers + Services + Repositories)، بدون فصل REST API منفصل — أي أن الواجهة الأمامية والخلفية ضمن نفس تطبيق Laravel.

## 2. Project Vision

أن تكون "معمار" المنصة الأولى والأكثر ثقة لربط الحرفيين بالعملاء في فلسطين، عبر بناء منظومة ثقة (دفع آمن + ضمان + فحص صارم) يصعب تقليدها، والاستفادة من ميزة الريادة (First-Mover Advantage) في سوق إعادة الإعمار.

## 3. Business Problem

1. **عدم تماثل المعلومات** — لا معلومات موثوقة عن جودة الحرفي أو سعره.
2. **غياب الشفافية السعرية** — تفاوت حاد بالأسعار واستغلال.
3. **صعوبة الوصول** — الاعتماد على مجموعات فيسبوك غير المنظمة.
4. **غياب الحماية القانونية** — لا عقود رسمية ولا آلية لاسترداد الحقوق.

## 4. Solution

منصة رقمية تدير دورة حياة كاملة للطلب: إنشاء الطلب → مطابقة جغرافية للحرفيين → عروض أسعار → قبول عرض → دفع Escrow → تنفيذ العمل → تأكيد وتحرير الدفعة → ضمان 30 يوم → تقييم.

## 5. Main Features

- تسجيل ودخول للعملاء (B2C/B2B/B2NGO) والحرفيين والأدمن.
- آلية اعتماد الحرفيين من 5 مراحل (Vetting Process).
- إنشاء طلبات خدمة مع صور وموقع GPS.
- خوارزمية مطابقة جغرافية للحرفيين المؤهلين.
- عروض أسعار (Offers) من الحرفيين.
- نظام دفع معلّق (Escrow) مع عمولة 15%.
- إدارة المهام (Jobs) من الحجز حتى الإتمام.
- ضمان "معمار" لمدة 30 يومًا بعد إتمام العمل.
- نظام تقييمات ثنائي الاتجاه (عميل ↔ حرفي).
- نظام نزاعات (Disputes) وصندوق تعويض طارئ (Emergency Fund).
- اشتراكات مميزة للحرفيين (Premium) واشتراكات مؤسسية (Enterprise).
- لوحة تحكم أدمن لإدارة الفحص، النزاعات، والتقارير.

## 6. User Roles

| الدور | الوصف |
|---|---|
| **Client (B2C/B2B/B2NGO)** | ينشئ طلبات خدمة، يقبل عروضًا، يدفع، يقيّم |
| **Craftsman** | يمر بعملية اعتماد، يستقبل إشعارات الطلبات، يقدّم عروضًا، ينفذ المهام |
| **Admin (COO)** | يدير عملية فحص الحرفيين، يحل النزاعات، يراقب النظام |

راجع `docs/ROLES.md` للتفاصيل الكاملة للصلاحيات.

## 7. Project Structure

```
mimar-platform/
├── README.md
├── docs/
│   ├── DATABASE.md        # مخطط قاعدة البيانات والعلاقات
│   ├── FLOW.md             # دورة حياة الطلب والعمليات الأساسية
│   ├── ROUTES.md           # كل الـ Routes (Web، لا يوجد API منفصل)
│   ├── BUSINESS_RULES.md   # قواعد العمل والقيود
│   ├── ROLES.md            # الأدوار والصلاحيات
│   ├── DEPLOYMENT.md       # خطوات التثبيت والنشر
│   └── SEQUENCE.md         # Sequence Diagrams بالنص
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   ├── Models/
│   ├── Services/
│   ├── Repositories/
│   └── Policies/
│
├── database/
│   └── migrations/
│
└── resources/views/
```

## 8. Database Design

راجع `docs/DATABASE.md` لكل الجداول والعلاقات، و`database/migrations/` لملفات الـ Migration الفعلية.

## 9. Installation

```bash
git clone <repo-url> mimar-platform
cd mimar-platform
composer install
cp .env.example .env
php artisan key:generate
```

عدّل `.env` لإعدادات قاعدة البيانات (MySQL):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mimar
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan migrate --seed
php artisan storage:link
```

## 10. Environment Variables

| المتغير | الوصف | مثال |
|---|---|---|
| `APP_ENV` | بيئة التشغيل | `local` / `production` |
| `DB_CONNECTION` | نوع قاعدة البيانات | `mysql` |
| `DB_DATABASE` | اسم القاعدة | `mimar` |
| `COMMISSION_RATE` | نسبة عمولة المنصة | `0.15` |
| `GUARANTEE_DAYS` | مدة الضمان بالأيام | `30` |
| `EMERGENCY_FUND_RATE` | نسبة صندوق التعويض من صافي الربح | `0.02` |
| `GOOGLE_MAPS_API_KEY` | مفتاح خرائط جوجل | — |

## 11. Running Project

```bash
php artisan serve
```

التطبيق يعمل على `http://127.0.0.1:8000`.

## 12. Screens (شاشات Blade)

- شاشات المصادقة: تسجيل دخول/تسجيل حساب (عميل، حرفي).
- Dashboard لكل دور (عميل / حرفي / أدمن).
- شاشة إنشاء طلب خدمة.
- شاشة عرض الطلبات وحالتها (اسم الخدمة، الحرفي المعيّن، الحالة، تاريخ الإنشاء، السعر المتفق عليه).
- شاشة عروض الأسعار على طلب معيّن.
- شاشة تفاصيل المهمة (Job) وتتبع حالتها.
- شاشة الدفع (Escrow).
- شاشة التقييمات.
- شاشة إدارة اعتماد الحرفيين (Admin).
- شاشة النزاعات (Admin).

## 13. System Flow

راجع `docs/FLOW.md` للتفصيل الكامل لكل دورات العمل (طلب، عرض، دفع، ضمان، نزاع، اشتراك).

## 14. API Endpoints (Routes)

لا يوجد REST API منفصل في هذه النسخة — كل التطبيق مبني على Blade + Web Routes. راجع `docs/ROUTES.md` لكل الـ Routes.

## 15. Folder Structure

راجع القسم 7 أعلاه.

## 16. Coding Standards

- نمط الطبقات: `Route → Controller → Service → Repository → Model → Database`.
- كل Controller "نحيف" (Thin Controller) — المنطق في الـ Service.
- كل استعلامات قاعدة البيانات المعقدة تمر عبر Repository.
- تعليقات PHPDoc واضحة فوق كل دالة عامة.
- تسمية بصيغة PascalCase للـ Classes، camelCase للدوال والمتغيرات، snake_case لأعمدة القاعدة.
- Form Requests لكل عملية Validation بدل التحقق داخل الـ Controller.
- Policies للتحكم بالصلاحيات (مثلاً: هل يملك العميل هذا الطلب؟).

## 17. Future Work

- إضافة قسم "توريد مواد البناء" (المرحلة 2 من خارطة الطريق).
- منصة تدريب مهني رقمية (المرحلة 3).
- تفعيل REST API منفصل لدعم تطبيق React Native مستقبلاً.
- تكامل فعلي مع Jawwal Pay / PalPay / بنك فلسطين.
- تفعيل خوارزمية مطابقة جغرافية حقيقية عبر Google Maps API.

