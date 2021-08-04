<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class MateriPostTest extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'materi_post_test';
    protected $primaryKey = 'id';
}
