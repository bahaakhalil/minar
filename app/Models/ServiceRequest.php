<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model بسيط لطلب الخدمة.
 * يمثل جدول service_requests، ومرتبط بجدولين آخرين:
 * - Craftsman (الحرفي المعيّن، إن وُجد)
 * - الحقول المباشرة: service_type, status, created_at, agreed_price
 */
class ServiceRequest extends Model
{
    // الحقول المسموح تعبئتها عبر Controller
    protected $fillable = [
        'service_type',     // اسم الخدمة (سباكة، كهرباء، نجارة...)
        'craftsman_id',     // الحرفي المعيّن (nullable لو لسا ما تعيّن حدا)
        'status',           // Pending / Accepted / In Progress / Completed / Cancelled
        'agreed_price',     // السعر المتفق عليه (nullable)
    ];

    /**
     * العلاقة مع الحرفي: كل طلب ممكن يتبع لحرفي واحد (أو null لو لسا مش معيّن).
     */
    public function craftsman()
    {
        return $this->belongsTo(Craftsman::class);
    }
}
