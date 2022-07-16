<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Inventory;
use App\Models\User;
use App\Models\Sale;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class SalesRepository {

    protected $inventory;

    /**
     * Inject dependecies
     */
    public function __construct(Inventory $inventory,Branch $branch,User $user,Sale $sale) {
        $this->inventory = $inventory;
        $this->branch = $branch;
		$this->sale = $sale;
		$this->user = $user;
    }
    public function get($id = '') {

        //new query
        $sale = $this->sale->newQuery();

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        $sale->where('sale_id', $id);

        

        return $sale->first();
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
        $sale = new $this->sale;

        //data
        $sale->proj_id = request('proj_id');
        $sale->customer_id = request('customer_id');
        $sale->inventory_id   = request('inventory_id');
        $sale->actual_amt = request('actual_amt');
        $sale->discount_amt = request('discount_amt');
        $sale->sale_sub_total = request('sale_sub_total');
        $sale->sale_tax = request('sale_tax');
		$sale->sale_grand_total = request('sale_grand_total');
		$sale->sold_on = request('sold_on');
		$sale->sold_by = request('sold_by');
		$sale->sale_status = request('sale_status');
		$sale->payment_status = request('payment_status');
		$sale->comments = request('comments');
		$sale->is_active = request('is_active');
        $sale->created_by = Auth()->user()->id;
		$sale->modified_by = Auth()->user()->id;
        

        //save
        if ($sale->save()) {
            if ($returning == 'id') {
                return $sale->sale_id;
            } else {
                return $sale;
            }
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    public function update($id) {

        $sale = $this->sale->find($id);
        //data
        $sale->proj_id = request('proj_id');
        $sale->customer_id = request('customer_id');
        $sale->inventory_id   = request('inventory_id');
        $sale->actual_amt = request('actual_amt');
        $sale->discount_amt = request('discount_amt');
        $sale->sale_sub_total = request('sale_sub_total');
        $sale->sale_tax = request('sale_tax');
		$sale->sale_grand_total = request('sale_grand_total');
		$sale->sold_on = request('sold_on');
		$sale->sold_by = request('sold_by');
		$sale->sale_status = request('sale_status');
		$sale->payment_status = request('payment_status');
		$sale->comments = request('comments');
		$sale->is_active = request('is_active');
		$sale->modified_by = Auth()->user()->id;
        

        //save
        if ($sale->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


}