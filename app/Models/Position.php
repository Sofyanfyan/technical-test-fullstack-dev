<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];


    public function employee() {
      return $this->hasMany(Employee::class, 'position_id');
    }
}