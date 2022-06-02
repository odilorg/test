<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\payment;

class OrderPixel extends Model
{
    use HasFactory;
    public $table = "order_pixel";

    protected $fillable = [
        'user_id',
        'name_gif',
        'size',
        'X',
        'Y',
        'X2',
        'Y2',
        'url',
    ];

    public function payment()
    {
        return $this->hasOne(payment::class, 'order_id', 'id');
    }
}
