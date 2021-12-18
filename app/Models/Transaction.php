<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'amount',
        'date',
        'type_id',
        'category_id',
        'user_id',
        'isbudget'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
