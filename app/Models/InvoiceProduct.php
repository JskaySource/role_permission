<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;




class InvoiceProduct extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_id',
        'user_id',
        'p_name',
        'qty',
        'sale_price',
    ];

    // Relation to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    
}