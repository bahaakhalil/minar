<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model بسيط للحرفي — نحتاج بس اسمه لعرضه بشاشة الطلبات.
 */
class Craftsman extends Model
{
    protected $fillable = [
        'name',       // اسم الحرفي
        'specialty',  // تخصصه
    ];

    /**
     * كل حرفي ممكن يكون مرتبط بأكثر من طلب.
     */
    public function requests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
}
