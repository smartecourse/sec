<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class JenisKelas extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'kelas_jenis';
    protected $primaryKey = 'id';
}
