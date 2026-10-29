<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['code', 'token', 'customer_name', 'customer_phone', 'total', 'cost_total', 'status', 'payment_status', 'notes'];
    protected $casts = ['total' => 'integer', 'cost_total' => 'integer'];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
