<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'user_id',
        'dealer_id',
        'total',
        'vat',
        'discount',
        'payable',
        'status', 
        
    ];

    protected $casts = [
        'invoice_date' => 'date:Y-m-d',
    ];

    // Auto-generate invoice number
    public static function generateInvoiceNumber()
    {
        // বর্তমান বছরের ইনভয়েসগুলো থেকে সর্বশেষটি খুঁজে বের করুন
        $currentYear = date('Y'); // যেমন 2024
        $lastInvoice = self::where('invoice_number', 'like', $currentYear . '%')
                            ->latest('invoice_number')
                            ->first();
    
        // সর্বশেষ ইনভয়েস নম্বর থেকে পরবর্তী সিরিয়াল নম্বর বের করা
        if ($lastInvoice) {
            $lastSerialNumber = intval(substr($lastInvoice->invoice_number, 4));
            $newSerialNumber = $lastSerialNumber + 1;
        } else {
            $newSerialNumber = 1;
        }
    
        // 5 সংখ্যার সিরিয়াল নম্বর তৈরি করুন, যেমন 00001, 00002
        $serial = str_pad($newSerialNumber, 5, '0', STR_PAD_LEFT);
    
        // বছর + ধারাবাহিক সিরিয়াল নম্বর (যেমন 202400001)
        return $currentYear . $serial;
    }
    

    // Relation to User
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Relation to Dealer
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    // Relation to InvoiceProduct
    public function products()
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    public function InvoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }


}