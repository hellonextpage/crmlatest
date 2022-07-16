<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\SalesPaymentModel;
use App\Models\User;
use App\Models\Sale;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class SalesPaymentRepository {

    protected $salepayment;

    /**
     * Inject dependecies
     */
    public function __construct(SalesPaymentModel $salepayment,Branch $branch,User $user,Sale $sale) {
        $this->salepayment = $salepayment;
        $this->branch = $branch;
		$this->sale = $sale;
		$this->user = $user;
    }
    public function get($id = '') {

        //new query
        $salepayment = $this->salepayment->newQuery();

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        $salepayment->where('pay_schedl_id', $id);

        

        return $salepayment->first();
    }

    /**
     * Create a new user
     * @param string $password bcrypted password
     * @param string $type team or client
     * @param string $returning return id|obj
     * @return bool
     */
    public function create($returning = 'id') {

        //save new inventory
        $salepayment = new $this->salepayment;

        //data
        $salepayment->payment_schedled_on = request('payment_schedled_on');
        $salepayment->payment_due_date = request('payment_due_date');
        $salepayment->pay_schedl_sub_total   = request('pay_schedl_sub_total');
        $salepayment->pay_schedl_tax = request('pay_schedl_tax');
        $salepayment->aptmnt_id = request('aptmnt_id');
        $salepayment->pay_schedl_grand_total = request('pay_schedl_grand_total');
		$salepayment->is_active = request('is_active');
        $salepayment->created_by = Auth()->user()->id;
		$salepayment->modified_by = Auth()->user()->id;
        

        //save
        if ($salepayment->save()) {
            if ($returning == 'id') {
                return $salepayment->pay_schedl_id;
            } else {
                return $salepayment;
            }
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    public function update($id) {

        $salepayment = $this->salepayment->find($id);
        //data

        //data
        $salepayment->payment_schedled_on = request('payment_schedled_on');
        $salepayment->payment_due_date = request('payment_due_date');
        $salepayment->pay_schedl_sub_total   = request('pay_schedl_sub_total');
        $salepayment->pay_schedl_tax = request('pay_schedl_tax');
        $salepayment->aptmnt_id = request('aptmnt_id');
        $salepayment->pay_schedl_grand_total = request('pay_schedl_grand_total');
		$salepayment->is_active = request('is_active');
        $salepayment->created_by = Auth()->user()->id;
		$salepayment->modified_by = Auth()->user()->id;
        

        //save
        if ($salepayment->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


}