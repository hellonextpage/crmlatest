<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\AppointmentMode;
use App\Models\User;
use App\Models\Sale;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class AppointmentModeRepository {

    protected $appointment;

    /**
     * Inject dependecies
     */
    public function __construct(AppointmentMode $appointment) {
        $this->appointment = $appointment;
    }
    public function get($id = '') {
        //new query
        $appointment = $this->appointment->newQuery();
        //validation
        if (!is_numeric($id)) {
            return false;
        }
        $appointment->where('aptmnt_type_id', $id);
        return $appointment->first();
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
        $appointment = new $this->appointment;

        //data
        $appointment->name = request('name');
		$appointment->status = request('status');
        $appointment->created_by = Auth()->user()->id;
		$appointment->modified_by = Auth()->user()->id;
        

        //save
        if ($appointment->save()) {
            if ($returning == 'id') {
                return $appointment->aptmnt_type_id;
            } else {
                return $appointment;
            }
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    public function update($id) {

        $appointment = $this->appointment->find($id);
        //data

        $appointment->name = request('name');
		$appointment->status = request('status');
        $appointment->created_by = Auth()->user()->id;
		$appointment->modified_by = Auth()->user()->id;
        

        //save
        if ($appointment->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


}