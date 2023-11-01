<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','amount','status','type','created_at','updated_by'];

    public function order(): HasOne
    {
        return $this->hasOne(Orders::class);
    }
}
