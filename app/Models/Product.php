<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'p_name',
        'p_price',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoices(){
        return $this->hasMany(InvoiceProduct::class);
    }

    //for deliveries function
    public function deliveries()
{
    return $this->hasMany(Delivery::class);
}
   
}
