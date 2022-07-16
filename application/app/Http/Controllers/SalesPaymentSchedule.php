<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Responses\SalesPayment\StoreResponse;
use App\Http\Responses\SalesPayment\CreateResponse;
use App\Http\Responses\SalesPayment\IndexResponse;
use App\Http\Responses\SalesPayment\EditResponse;
use App\Http\Responses\SalesPayment\UpdateResponse;
use App\Repositories\SalesPaymentRepository;
use App\Http\Responses\Common\CommonResponse;
use Validator;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\SalesPaymentModel;
use App\Models\User;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Appointments;

class SalesPaymentSchedule extends Controller
{
    public function __construct(Appointments $appointment,SalesPaymentRepository $salespaymentrepo,SalesPaymentModel $salespayment,User $users,Inventory $inventory,Branch $branch,Project $projects,Invoice $invoices) {

        //parent
        parent::__construct();
        $this->branch = $branch;
        $this->projects = $projects;
        $this->invoices = $invoices;
        $this->inventory = $inventory;
        $this->salespaymentrepo = $salespaymentrepo;
		$this->salespayment = $salespayment;
		$this->users = $users;
		$this->appointment = $appointment;
        //authenticated
        $this->middleware('auth');               
    }

    public function index(){
        $salespayment = $this->salespayment->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('team'),
            'salespayment' => $salespayment,
            
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
        $inventory = $this->inventory->All();

        $branch = $this->branch->All();
        $projects = $this->projects->All();
        $invoices = $this->invoices->All();
		$users = $this->users->All();
		$appointment = $this->appointment->All();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'branch'=>$branch,
            'invoices'=>$invoices,
            'projects'=>$projects,
			'users'=>$users,
			'appointment'=>$appointment,
			'inventory'=>$inventory

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
            'payment_schedled_on' => 'required',
            'payment_due_date' => 'required',
            'pay_schedl_sub_total' => 'required',
            'pay_schedl_tax' => 'required',
            'pay_schedl_grand_total' => 'required',
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
        $this->salespaymentrepo->create();

        /*
        if (!$inventory = $this->inventoryrepo->create()) {
            abort(409);
        }
        */

        //get the user
        $salespayment = $this->salespayment->All();

        //reponse payload
        $payload = [
            'salespayment' => $salespayment,
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    public function edit($id) {

        //get all team level roles
        $inventory = $this->inventory->All();

        $branch = $this->branch->All();
        $projects = $this->projects->All();
        $invoices = $this->invoices->All();
		$users = $this->users->All();
		$appointment = $this->appointment->All();

        //get the user
        $salespayment = $this->salespaymentrepo->get($id);

        

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'projects' => $projects,
            'invoices' => $invoices,
            'branch'=>$branch,
            'inventory'=>$inventory,
			'salespayment'=>$salespayment,
			'users'=>$users,
			'appointment'=>$appointment
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
        $salespayment = $this->salespaymentrepo->get($id);

        

        //custom error messages
        $messages = [];

        //validate the form
        $validator = Validator::make(request()->all(), [
            'payment_schedled_on' => 'required',
            'payment_due_date' => 'required',
            'pay_schedl_sub_total' => 'required',
            'pay_schedl_tax' => 'required',
            'pay_schedl_grand_total' => 'required',
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
        if (!$this->salespaymentrepo->update($id)) {
            abort(409);
        }

        
        //reponse payload
        $payload = [
            'salespayment' => $salespayment,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    public function destroy($id) {

        
        
        $this->salespayment->find($id)->delete();

        $payload = [
            'type' => 'remove-basic',
            'element' => "#salespayment_$id",
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
            'dynamic_search_url' => 'salespayment/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'salespayment',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_inventory'),
            'add_modal_create_url' => url('salespayment/create'),
            'add_modal_action_url' => url('salespayment'),
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
                'create_type' => 'salespayment',
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
