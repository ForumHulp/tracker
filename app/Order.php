<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'name',
        'email',
        'address',
        'city',
        'country',
        'telephone',
        'issue_id',
        'payment_id',
        'title',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function total()
    {
        $total = 0;
        foreach($this->items as $item)
        {
            $total += $item->qty * $item->unit_price;
        }

        return number_format($total, 2, '.', '');
    }
}