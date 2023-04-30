<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuans';
    protected $fillable = [
        'satuan',
        'deskripsi',
        'status'
    ];
    use HasFactory;

    public function paket()
    {
        return $this->hasMany(Paket::class, 'satuan_id', 'id');
    }
}
