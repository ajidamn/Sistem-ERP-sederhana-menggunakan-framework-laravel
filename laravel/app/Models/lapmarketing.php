<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lapmarketing extends Model
{
    use HasFactory;
    public $table="lapmarketing";
    protected $fillable = [
        'kode','marketing', 'laporan','tanggal_awal','tanggal_akhir','status', 'created_at'
      ];
}
