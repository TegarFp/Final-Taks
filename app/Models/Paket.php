<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'pakets';
    protected $fillable = [
      'paket', 'berat', 'harga', 'cabang', 'status', 'satuan_id'
    ];
      use HasFactory;
  
      public function satuan()
    {
      return $this->belongsTo(Satuan::class);
    }
}
