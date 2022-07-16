<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    protected $table = 'appointment';
    protected $primaryKey = 'aptmnt_id';
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';

}
