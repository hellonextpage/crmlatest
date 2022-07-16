<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Inventory;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class InventoryRepository {

    protected $inventory;

    /**
     * Inject dependecies
     */
    public function __construct(Inventory $inventory,Branch $branch) {
        $this->inventory = $inventory;
        $this->branch = $branch;
    }
    public function get($id = '') {

        //new query
        $inventory = $this->inventory->newQuery();

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        $inventory->where('inventory_id', $id);

        

        return $inventory->first();
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
        $inventory = new $this->inventory;

        //data
        $inventory->proj_id = 1;//request('proj_id');
        $inventory->plot_villa_flat_no = request('plot_villa_flat_no');
        $inventory->area   = request('area');
        $inventory->facing = request('facing');
        $inventory->status = request('status');
        $inventory->measurements = request('measurements');
        $inventory->invoice_id = 1;//request('invoice_id');
        $inventory->created_by = Auth()->user()->id;
        

        //save
        if ($inventory->save()) {
            if ($returning == 'id') {
                return $inventory->inventory_id;
            } else {
                return $inventory;
            }
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    public function update($id) {

        $inventory = $this->inventory->find($id);
        //data
        $inventory->proj_id = 1;//request('proj_id');
        $inventory->plot_villa_flat_no = request('plot_villa_flat_no');
        $inventory->area   = request('area');
        $inventory->facing = request('facing');
        $inventory->status = request('status');
        $inventory->measurements = request('measurements');
        $inventory->invoice_id = 1;//request('invoice_id');
        $inventory->created_by = Auth()->user()->id;
        

        //save
        if ($inventory->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


}