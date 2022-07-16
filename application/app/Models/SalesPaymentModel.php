<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPaymentModel extends Model
{
    use HasFactory;
	protected $table = 'sales_payment_schedule';
	protected $primaryKey = 'pay_schedl_id';
	const CREATED_AT = 'created_on';
	const UPDATED_AT = 'modified_on';
}
