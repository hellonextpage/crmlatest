<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Responses\Inventory\StoreResponse;
use App\Http\Responses\Inventory\CreateResponse;
use App\Http\Responses\Inventory\IndexResponse;
use App\Http\Responses\Inventory\EditResponse;
use App\Http\Responses\Inventory\UpdateResponse;
use App\Repositories\InventoryRepository;
use App\Http\Responses\Common\CommonResponse;
use Validator;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Project;
use App\Models\Invoice;

class InventoryController extends Controller
{
    public function __construct(InventoryRepository $inventoryrepo,Inventory $inventory,Branch $branch,Project $projects,Invoice $invoices) {

        //parent
        parent::__construct();
        $this->branch = $branch;
        $this->projects = $projects;
        $this->invoices = $invoices;
        $this->inventory = $inventory;
        $this->inventoryrepo = $inventoryrepo;
        //authenticated
        $this->middleware('auth');               
    }

    public function index(){
        $inventory = $this->inventory->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('team'),
            'inventory' => $inventory,
            
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

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'branch'=>$branch,
            'invoices'=>$invoices,
            'projects'=>$projects

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
            'plot_villa_flat_no' => 'required',
            'proj_id' => 'required',
            'area' => 'required',
            'facing' => 'required',
            'status' => 'required',
            'measurements' => 'required',
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
        $this->inventoryrepo->create();

        /*
        if (!$inventory = $this->inventoryrepo->create()) {
            abort(409);
        }
        */

        //get the user
        $inventory = $this->inventory->All();

        //reponse payload
        $payload = [
            'inventory' => $inventory,
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
        $inventory = $this->inventoryrepo->get($id);

        

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'projects' => $projects,
            'invoices' => $invoices,
            'branch'=>$branch,
            'inventory'=>$inventory
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
        $inventory = $this->inventoryrepo->get($id);

        

        //custom error messages
        $messages = [];

        //validate the form
        $validator = Validator::make(request()->all(), [
            'plot_villa_flat_no' => 'required'
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
        if (!$this->inventoryrepo->update($id)) {
            abort(409);
        }

        
        //reponse payload
        $payload = [
            'inventory' => $inventory,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    public function destroy($id) {

        
        
        $this->inventory->find($id)->delete();

        $payload = [
            'type' => 'remove-basic',
            'element' => "#inventory_$id",
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
            'dynamic_search_url' => 'team/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'inventory',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_inventory'),
            'add_modal_create_url' => url('inventory/create'),
            'add_modal_action_url' => url('inventory'),
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
                'create_type' => 'inventory',
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
