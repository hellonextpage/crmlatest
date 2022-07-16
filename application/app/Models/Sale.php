<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
	protected $table = 'sales';
	protected $primaryKey = 'sale_id';
	const CREATED_AT = 'created_on';
	const UPDATED_AT = 'modified_on';
}
