<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Responses\Appointments\StoreResponse;
use App\Http\Responses\Appointments\CreateResponse;
use App\Http\Responses\Appointments\IndexResponse;
use App\Http\Responses\Appointments\EditResponse;
use App\Http\Responses\Appointments\UpdateResponse;
use App\Repositories\AppointmentsRepository;
use App\Http\Responses\Common\CommonResponse;
use Validator;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Appointments;
use App\Models\User;
use App\Models\AppointmentType;
use App\Models\AppointmentMode;
use DB;

class AppointmentsController extends Controller
{
    public function __construct(Appointments $appointments,AppointmentsRepository $appointmentsrepository,Inventory $inventory,Branch $branch,Project $projects,Invoice $invoices) {

        //parent
        parent::__construct();
        $this->branch = $branch;
        $this->projects = $projects;
        $this->invoices = $invoices;
        $this->inventory = $inventory;
        $this->appointmentsrepository = $appointmentsrepository;
        $this->appointments = $appointments;
        //authenticated
        $this->middleware('auth');               
    }

    public function index(){
        
        $appointments = DB::table('appointment')
        ->leftJoin('users','users.id','appointment.aptmnt_assignd_to')
        ->leftJoin('aptmnt_type','aptmnt_type.aptmnt_type_id','appointment.aptmnt_type_id')
		->leftJoin('leads','leads.lead_id','appointment.aptmnt_type_id')
        ->leftJoin('aptmnt_mode','aptmnt_mode.aptmnt_mode_id','appointment.aptmnt_mode')
        ->get();
       // $appointments = $this->appointmentsrepository->search();
        
        //$this->appointments->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('appointments'),
            'appointments' => $appointments,
            
        ];
        //show views
        return new IndexResponse($payload);

    }
	
	public function appointmentHistory($id){
        
        $appointments = DB::table('appointment')
        ->leftJoin('users','users.id','appointment.aptmnt_assignd_to')
        ->leftJoin('aptmnt_type','aptmnt_type.aptmnt_type_id','appointment.aptmnt_type_id')
		->leftJoin('leads','leads.lead_id','appointment.aptmnt_type_id')
        ->leftJoin('aptmnt_mode','aptmnt_mode.aptmnt_mode_id','appointment.aptmnt_mode')
		->where('appointment.aptmnt_assignd_to',$id)
        ->get();
        
        //$this->appointments->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('appointments'),
            'appointments' => $appointments,
            
        ];
        //show views
        return new IndexResponse($payload);

    }

    /**
     * Show the form for creating a new team member
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //get all team level roles
        //$inventory = $this->inventory->All();

        $branch = $this->branch->All();
        $projects = $this->projects->All();
        $invoices = $this->invoices->All();
        $this->users = new User();
        $users = DB::table('users')
        ->leftJoin('appointment','users.id','appointment.aptmnt_assignd_to')
		->select('users.*',DB::raw("SUM(appointment.aptmnt_with) as total"))
		->groupby('users.id')
		->get();
		//$this->users->All();
		
		
		$this->apment_type = new AppointmentType();
        $apment_type = $this->apment_type->All();
		
		$this->aptmnt_mode = new AppointmentMode();
        $aptmnt_mode = $this->aptmnt_mode->All();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'branch'=>$branch,
            'invoices'=>$invoices,
            'projects'=>$projects,
            'users'=>$users,
			'apment_type'=>$apment_type,
			'aptmnt_mode'=>$aptmnt_mode

        ];

        //show the form
        return new CreateResponse($payload);
    }

    
    /**
     * Store a newly created team member in storage.
     * @return \Illuminate\Http\Response
     */
    public function store() {

        //custom error messages
        $messages = [];

        //validate
        $validator = Validator::make(request()->all(), [
            'aptmnt_assignd_to' => 'required',
        ], $messages);

        //errors
        /*if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }*/
        $this->appointmentsrepository->create();

        /*
        if (!$inventory = $this->appointmentsrepository->create()) {
            abort(409);
        }
        */

        //get the user
        $appointments = $this->appointments->All();

        //reponse payload
        $payload = [
            'appointments' => $appointments,
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    public function edit($id) {

        //get all team level roles
       // $inventory = $this->inventory->All();

        $branch = $this->branch->All();
        $projects = $this->projects->All();
        $invoices = $this->invoices->All();

        //get the user
        $appointment = $this->appointmentsrepository->get($id);
		$this->users = new User();
        $users = $this->users->All();
		
		$this->apment_type = new AppointmentType();
        $apment_type = $this->apment_type->All();
		
		$this->aptmnt_mode = new AppointmentMode();
        $aptmnt_mode = $this->aptmnt_mode->All();

        

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'projects' => $projects,
            'invoices' => $invoices,
            'branch'=>$branch,
            'appointments'=>$appointment,
			'users'=>$users,
			'apment_type'=>$apment_type,
			'aptmnt_mode'=>$aptmnt_mode
        ];

        //process reponse
        return new EditResponse($payload);

    }

    /**
     * Update profile
     * @param int $id team member id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {

        //get the user
        $appointment = $this->appointmentsrepository->get($id);

        

        //custom error messages
        $messages = [];

        //validate the form
        $validator = Validator::make(request()->all(), [
            'aptmnt_assignd_to' => 'required'
        ], $messages);

        //validation errors
        /*if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }*/

        //update the user
        if (!$this->appointmentsrepository->update($id)) {
            abort(409);
        }

        
        //reponse payload
        $payload = [
            'appointments' => $appointment,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    public function destroy($id) {

        
        
        $this->appointments->find($id)->delete();

        $payload = [
            'type' => 'remove-basic',
            'element' => "#appointments_$id",
        ];
        //generate a response
        return new CommonResponse($payload);
    }


    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.appointment'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'appointment',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_settings' => 'active',
            'mainmenu_team' => 'active',
            'submenu_team' => 'active',
            'sidepanel_id' => 'sidepanel-filter-team',
            'dynamic_search_url' => 'appointment/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'appointment',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_appointment'),
            'add_modal_create_url' => url('appointment/create'),
            'add_modal_action_url' => url('appointment'),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //contracts list page
        if ($section == 'appointments') {
            $page += [
                'meta_title' => __('lang.appointment'),
                'heading' => __('lang.appointment'),
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //create new resource
        if ($section == 'create') {
            $page += [
                'section' => 'create',
                'create_type' => 'appointment',
            ];
            return $page;
        }

        //edit new resource
        if ($section == 'edit') {
            $page += [
                'section' => 'edit',
            ];
            return $page;
        }

        //ext page settings
        if ($section == 'ext') {

            $page += [
                'list_page_actions_size' => 'col-lg-12',

            ];

            return $page;
        }

        //return
        return $page;
    }
}
