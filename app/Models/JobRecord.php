<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model بسيط للمهمة (Job) — تُنشأ بعد ما العميل يقبل عرض حرفي معيّن.
 * جدول jobs_records (وليس jobs) لتفادي التعارض مع نظام قوائم الانتظار في Laravel.
 */
class JobRecord extends Model
{
    protected $table = 'jobs_records';

    protected $fillable = [
        'client_id',      // صاحب الطلب
        'craftsman_id',   // الحرفي المكلّف بالتنفيذ
        'agreed_price',
        'status',         // booked / in_progress / pending_confirmation / completed
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function craftsman()
    {
        return $this->belongsTo(Craftsman::class);
    }
}
