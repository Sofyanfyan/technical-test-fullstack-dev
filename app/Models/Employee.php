<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
         'id',
         'name',
         'NIP',
         'tahun_lahir',
         'alamat',
         'no_telp',
         'agama',
         'status',
         'position_id',
         'path_image',
    ];


    public function position(){
      return $this->belongsTo(Position::class, 'position_id');
    }
}