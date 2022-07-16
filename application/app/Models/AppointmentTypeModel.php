<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTypeModel extends Model
{
    use HasFactory;
	protected $table = 'aptmnt_type';
	protected $primaryKey = 'aptmnt_type_id';
	const CREATED_AT = 'created_on';
	const UPDATED_AT = 'updated_on';
}

