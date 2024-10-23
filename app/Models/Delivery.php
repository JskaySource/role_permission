<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'deliveries';
    // Specify the fillable fields
    protected $fillable = [
        'user_id',
        'invoice_id',
        'product_id',
        'dealer_id',
        'invoice_number',
        'delivery_date',
        'full_qty',
        'empty_qty',
        'remark',
    ];

    // Relationships

    

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
