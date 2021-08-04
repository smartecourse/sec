<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class KebijakanPrivasi extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'kebijakan_privasi';
    protected $primaryKey = 'id';
}
