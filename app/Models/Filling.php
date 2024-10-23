<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filling extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'date',
        'zara_filling',
        'refil_filling',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
