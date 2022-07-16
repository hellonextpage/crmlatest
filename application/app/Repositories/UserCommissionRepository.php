<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\UserCommissionModel;
use App\Models\User;
use App\Models\Sale;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class UserCommissionRepository {

    protected $salepayment;

    /**
     * Inject dependecies
     */
    public function __construct(UserCommissionModel $usercommission_mod,Branch $branch,User $user,Sale $sale) {
        $this->usercommission_mod = $usercommission_mod;
        $this->branch = $branch;
		$this->sale = $sale;
		$this->user = $user;
    }
    public function get($id = '') {

        //new query
        $usercommission_mod = $this->usercommission_mod->newQuery();

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        $usercommission_mod->where('id', $id);

        

        return $usercommission_mod->first();
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
        $usercommission_mod = new $this->usercommission_mod;

        //data
        $usercommission_mod->user_id = request('user_id');
        $usercommission_mod->commission_amt = request('commission_amt');
        $usercommission_mod->sale_id   = 1;//request('sale_id');
        $usercommission_mod->is_settled = request('is_settled');
        $usercommission_mod->settled_on = request('settled_on');
		$usercommission_mod->is_active = request('is_active');
        $usercommission_mod->created_by = Auth()->user()->id;
		$usercommission_mod->modified_by = Auth()->user()->id;
        

        //save
        if ($usercommission_mod->save()) {
            if ($returning == 'id') {
                return $usercommission_mod->id;
            } else {
                return $usercommission_mod;
            }
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    public function update($id) {

        $usercommission_mod = $this->usercommission_mod->find($id);
        //data

        $usercommission_mod->user_id = request('user_id');
        $usercommission_mod->commission_amt = request('commission_amt');
        $usercommission_mod->sale_id   = 1;//request('sale_id');
        $usercommission_mod->is_settled = request('is_settled');
        $usercommission_mod->settled_on = request('settled_on');
		$usercommission_mod->is_active = request('is_active');
        $usercommission_mod->created_by = Auth()->user()->id;
		$usercommission_mod->modified_by = Auth()->user()->id;
        

        //save
        if ($usercommission_mod->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


}