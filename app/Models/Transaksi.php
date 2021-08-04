<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Transaksi extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
}
