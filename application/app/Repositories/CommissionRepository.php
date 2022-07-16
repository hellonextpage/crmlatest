<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\CommissionModel;
use App\Models\User;
use App\Models\Sale;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class CommissionRepository {

    protected $commission;

    /**
     * Inject dependecies
     */
    public function __construct(CommissionModel $commission,Branch $branch,User $user,Sale $sale) {
        $this->commission = $commission;
        $this->branch = $branch;
		$this->sale = $sale;
		$this->user = $user;
    }
    public function get($id = '') {

        //new query
        $commission = $this->commission->newQuery();

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        $commission->where('commission_type_id', $id);

        

        return $commission->first();
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
        $commission = new $this->commission;

        //data
        $commission->commission_perc = request('commission_perc');
        $commission->commission_name = request('commission_name');
		$commission->is_active = request('is_active');
        $commission->created_by = Auth()->user()->id;
		$commission->modified_by = Auth()->user()->id;
        

        //save
        if ($commission->save()) {
            if ($returning == 'id') {
                return $commission->commission_type_id;
            } else {
                return $commission;
            }
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    public function update($id) {

        $commission = $this->commission->find($id);
        //data

        $commission->commission_perc = request('commission_perc');
        $commission->commission_name = request('commission_name');
		$commission->is_active = request('is_active');
        $commission->created_by = Auth()->user()->id;
		$commission->modified_by = Auth()->user()->id;
        

        //save
        if ($commission->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


}