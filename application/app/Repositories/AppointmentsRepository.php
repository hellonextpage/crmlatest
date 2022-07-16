<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Inventory;
use App\Models\Appointments;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class AppointmentsRepository {

    protected $appointments;

    /**
     * Inject dependecies
     */
    public function __construct(Appointments $appointments,Inventory $inventory,Branch $branch) {
        $this->inventory = $inventory;
        $this->branch = $branch;
		$this->appointment = $appointments;
    }
    public function get($id = '') {

        //new query
        $appointment = $this->appointment->newQuery();

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        $appointment->where('aptmnt_id', $id);

        

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
        
		
		$this->users = new User();
        $users = $this->users->All();
		foreach($users as $user){
			$i=0;
			$user_appointments = request('user_id'.$user->id);
			for($i;$i<$user_appointments;$i++){
				$appointment = new $this->appointment;
				$appointment->aptmnt_on = date('Y-m-d');//request('aptmnt_on');
				$appointment->aptmnt_assignd_to = $user->id;//request('aptmnt_assignd_to');
				$appointment->aptmnt_with   = 1;//request('aptmnt_with');
				$appointment->aptmnt_type_id = 1;//request('aptmnt_type_id');
				$appointment->aptmnt_mode = 1;//request('aptmnt_mode');
				$appointment->cmnts_after_aptmnt = request('cmnts_after_aptmnt');
				$appointment->aptmnt_positivity_rate = 1;//request('aptmnt_positivity_rate');
				$appointment->created_by = Auth()->user()->id;
				$appointment->aptmnt_created_by = Auth()->user()->id;
				$appointment->is_active = 1;//request('status');
				$appointment->modified_by = Auth()->user()->id;
				$appointment->save();
			}
			
		}

        
        

        //save
        if ($appointment->save()) {
            return true;   
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    public function update($id) {

        $appointment = $this->appointment->find($id);
        //data
        
        $appointment->cmnts_after_aptmnt = request('cmnts_after_aptmnt');
        $appointment->aptmnt_positivity_rate = 1;//request('aptmnt_positivity_rate');        
		$appointment->is_active = request('status');
        
		if(request('status')==2){
			$newappointment = new $this->appointment;
			$newappointment->aptmnt_on = request('aptmnt_on');
			$newappointment->aptmnt_assignd_to = $appointment->aptmnt_assignd_to;//request('aptmnt_assignd_to');
			$newappointment->aptmnt_with   = $appointment->aptmnt_with;//request('aptmnt_with');
			$newappointment->aptmnt_type_id = $appointment->aptmnt_type_id;//request('aptmnt_type_id');
			$newappointment->aptmnt_mode = $appointment->aptmnt_mode;//request('aptmnt_mode');
			$newappointment->cmnts_after_aptmnt = request('cmnts_after_aptmnt');
			$newappointment->aptmnt_positivity_rate = $appointment->aptmnt_positivity_rate;//request('aptmnt_positivity_rate');
			$newappointment->created_by = $appointment->aptmnt_assignd_to;
			$newappointment->aptmnt_created_by = $appointment->aptmnt_assignd_to;
			$newappointment->is_active = 1;//request('status');
			$newappointment->modified_by = $appointment->aptmnt_assignd_to;
			$newappointment->save();
		}
        //save
        if ($appointment->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


}