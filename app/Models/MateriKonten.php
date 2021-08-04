<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MateriKonten extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'materi_konten';
    protected $primaryKey = 'id';
}
