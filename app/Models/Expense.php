<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'value', 'category_id', 'is_done'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
