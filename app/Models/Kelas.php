<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Kelas extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'kelas';
    protected $primaryKey = 'id';
}
