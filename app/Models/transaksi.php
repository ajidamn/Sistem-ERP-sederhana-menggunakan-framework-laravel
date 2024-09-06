<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    public $table="transactions";
    protected $fillable = [
        'id','no_transaction', 'transaction_date'
      ];
}
