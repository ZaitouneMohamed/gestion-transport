<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_number", 
        "customer_name",
        "customer_email",
        "customer_phone",
        "delivery_date",
        "adresse",
        "category",
        "subCategory",
        "product",
        "payement",
        "branch",
        "qty",
    ];
}
