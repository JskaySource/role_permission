<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =[
        'dealer_id',
        'product_id',
        'jar_quantity',
    ];
    public function dealer(){
        return $this->belongsTo(Dealer::class);
    }

}

