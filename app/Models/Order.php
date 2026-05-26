<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $table = 'orders';
    
    protected $fillable = [
        'user_id', 
        'invoice_number', 
        'total_amount', 
        'status', 
        'shipping_address', 
        'phone', 
        'order_date'
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Accessor untuk format tanggal WIB
    public function getOrderDateWibAttribute()
    {
        return Carbon::parse($this->order_date)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i:s');
    }
}