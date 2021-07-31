<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    public CONST MONTHLY = 1;
    public CONST WEEKLY  = 2;

    protected $fillable = ['name', 'maxAmount', 'amount', 'recurrence'];

    public static function getRecurrences(): array
    {
        return [
            self::MONTHLY => 'Mensal',
            self::WEEKLY  => 'Semanal'
        ];
    }

    public function recurrence()
    {
        return match ($this->recurrence) {
            self::MONTHLY => $this->getRecurrences()[self::MONTHLY],
            self::WEEKLY  => $this->getRecurrences()[self::WEEKLY]
        };
    }
    
}
