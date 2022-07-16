<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommissionModel extends Model
{
    use HasFactory;
	protected $table = 'user_commissions';
	protected $primaryKey = 'id';
	const CREATED_AT = 'created_on';
	const UPDATED_AT = 'modified_on';
}
