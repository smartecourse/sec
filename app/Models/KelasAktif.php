<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class KelasAktif extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'kelas_aktif';
    protected $primaryKey = 'id';
}
