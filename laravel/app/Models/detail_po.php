<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_po extends Model
{
    use HasFactory;
    public $table="detail_po";
    protected $fillable = [
        'kode_po','kode_brg', 'harga','harga_beli','qty','keterangan','jumlah','rate', 
      ];
}