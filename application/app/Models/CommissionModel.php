<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionModel extends Model
{
    use HasFactory;
	protected $table = 'commission_type';
	protected $primaryKey = 'commission_type_id';
	const CREATED_AT = 'created_on';
	const UPDATED_AT = 'modified_on';
}
