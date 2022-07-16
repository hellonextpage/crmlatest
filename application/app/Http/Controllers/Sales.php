<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Responses\Sales\StoreResponse;
use App\Http\Responses\Sales\CreateResponse;
use App\Http\Responses\Sales\IndexResponse;
use App\Http\Responses\Sales\EditResponse;
use App\Http\Responses\Sales\UpdateResponse;
use App\Repositories\SalesRepository;
use App\Http\Responses\Common\CommonResponse;
use Validator;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\User;
use App\Models\Project;
use App\Models\Invoice;

class Sales extends Controller
{
    public function __construct(SalesRepository $salesrepo,Sale $sales,User $users,Inventory $inventory,Branch $branch,Project $projects,Invoice $invoices) {

        //parent
        parent::__construct();
        $this->branch = $branch;
        $this->projects = $projects;
        $this->invoices = $invoices;
        $this->inventory = $inventory;
        $this->salesrepo = $salesrepo;
		$this->sales = $sales;
		$this->users = $users;
        //authenticated
        $this->middleware('auth');               
    }

    public function index(){
        $sales = $this->sales->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('team'),
            'sales' => $sales,
            
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

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'branch'=>$branch,
            'invoices'=>$invoices,
            'projects'=>$projects,
			'users'=>$users,
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
            'customer_id' => 'required',
            'proj_id' => 'required',
            'inventory_id' => 'required',
            'actual_amt' => 'required',
            'sale_grand_total' => 'required',
            'sold_on' => 'required',
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
        $this->salesrepo->create();

        /*
        if (!$inventory = $this->inventoryrepo->create()) {
            abort(409);
        }
        */

        //get the user
        $sales = $this->sales->All();

        //reponse payload
        $payload = [
            'sales' => $sales,
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

        //get the user
        $sales = $this->salesrepo->get($id);

        

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'projects' => $projects,
            'invoices' => $invoices,
            'branch'=>$branch,
            'inventory'=>$inventory,
			'sales'=>$sales,
			'users'=>$users
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
        $sales = $this->salesrepo->get($id);

        

        //custom error messages
        $messages = [];

        //validate the form
        $validator = Validator::make(request()->all(), [
            'customer_id' => 'required',
            'proj_id' => 'required',
            'inventory_id' => 'required',
            'actual_amt' => 'required',
            'sale_grand_total' => 'required',
            'sold_on' => 'required',
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
        if (!$this->salesrepo->update($id)) {
            abort(409);
        }

        
        //reponse payload
        $payload = [
            'sales' => $sales,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    public function destroy($id) {

        
        
        $this->sales->find($id)->delete();

        $payload = [
            'type' => 'remove-basic',
            'element' => "#sales_$id",
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
            'dynamic_search_url' => 'sales/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'sales',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_inventory'),
            'add_modal_create_url' => url('sales/create'),
            'add_modal_action_url' => url('sales'),
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
                'create_type' => 'sales',
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
