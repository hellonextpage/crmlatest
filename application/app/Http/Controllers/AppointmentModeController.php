<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Responses\AppointmentMode\StoreResponse;
use App\Http\Responses\AppointmentMode\CreateResponse;
use App\Http\Responses\AppointmentMode\IndexResponse;
use App\Http\Responses\AppointmentMode\EditResponse;
use App\Http\Responses\AppointmentMode\UpdateResponse;
use App\Repositories\AppointmentModeRepository;
use App\Http\Responses\Common\CommonResponse;
use Validator;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\SalesPaymentModel;
use App\Models\User;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\AppointmentMode;

class AppointmentModeController extends Controller
{
    public function __construct(AppointmentMode $appointmentmode,AppointmentModeRepository $appointmentmoderepo) {

        //parent
        parent::__construct();
        $this->appointmentmode = $appointmentmode;
        $this->appointmentmoderepo = $appointmentmoderepo;
        //authenticated
        $this->middleware('auth');               
    }

    public function index(){
        $appointmentmode = $this->appointmentmode->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('team'),
            'appointmentmode' => $appointmentmode,
            
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
        $appointmentmode = $this->appointmentmode->All();

        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create')
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
            'name' => 'required',
        ], $messages);

        //errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }
        $this->appointmentmoderepo->create();
        /*
        if (!$inventory = $this->inventoryrepo->create()) {
            abort(409);
        }
        */

        //get the user
        $appointmentmode = $this->appointmentmode->All();

        //reponse payload
        $payload = [
            'appointmentmode' => $appointmentmode,
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    public function edit($id) {

        

        //get the user
        $appointmentmode = $this->appointmentmoderepo->get($id);

        

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
			'appointmentmode'=>$appointmentmode
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
        $appointmentmode = $this->appointmentmoderepo->get($id);

        

        //custom error messages
        $messages = [];

        //validate the form
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
        ], $messages);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }

        //update the user
        if (!$this->appointmentmoderepo->update($id)) {
            abort(409);
        }

        
        //reponse payload
        $payload = [
            'appointmentmode' => $appointmentmode,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    public function destroy($id) {

        
        
        $this->appointmentmode->find($id)->delete();

        $payload = [
            'type' => 'remove-basic',
            'element' => "#appointmentmode_$id",
        ];
        //generate a response
        return new CommonResponse($payload);
    }


    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.inventory'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'Inventory',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_settings' => 'active',
            'mainmenu_team' => 'active',
            'submenu_team' => 'active',
            'sidepanel_id' => 'sidepanel-filter-team',
            'dynamic_search_url' => 'appointmentmode/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'appointmentmode',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_inventory'),
            'add_modal_create_url' => url('appointmentmode/create'),
            'add_modal_action_url' => url('appointmentmode'),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //contracts list page
        if ($section == 'team') {
            $page += [
                'meta_title' => __('lang.inventory'),
                'heading' => __('lang.inventory'),
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
                'create_type' => 'appointmentmode',
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
