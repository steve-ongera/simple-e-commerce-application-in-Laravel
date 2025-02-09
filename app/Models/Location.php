<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'delivery_fee'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
