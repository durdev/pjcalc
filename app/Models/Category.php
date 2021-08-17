<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'alert_value'];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

}
