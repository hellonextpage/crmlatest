<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Responses\CommissionType\StoreResponse;
use App\Http\Responses\CommissionType\CreateResponse;
use App\Http\Responses\CommissionType\IndexResponse;
use App\Http\Responses\CommissionType\EditResponse;
use App\Http\Responses\CommissionType\UpdateResponse;
use App\Repositories\CommissionRepository;
use App\Http\Responses\Common\CommonResponse;
use Validator;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\SalesPaymentModel;
use App\Models\User;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\CommissionModel;

class CommissionManagement extends Controller
{
     public function __construct(CommissionModel $commission,CommissionRepository $commissiontyperepo) {

        //parent
        parent::__construct();
        $this->commission = $commission;
        $this->commissionrepo = $commissiontyperepo;
        //authenticated
        $this->middleware('auth');               
    }

    public function index(){
        $commission = $this->commission->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('team'),
            'commission' => $commission,
            
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
        $commission_m = $this->commission->All();

        
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'commission_m'=>$commission_m
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
            'commission_perc' => 'required',
            'commission_name' => 'required',
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
        $this->commissionrepo->create();

        /*
        if (!$inventory = $this->inventoryrepo->create()) {
            abort(409);
        }
        */

        //get the user
        $commissiontype = $this->commission->All();

        //reponse payload
        $payload = [
            'commission' => $commission,
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    public function edit($id) {

        

        //get the user
        $commission = $this->commissionrepo->get($id);

        

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
			'commission'=>$commission
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
        $commission = $this->commissionrepo->get($id);

        

        //custom error messages
        $messages = [];

        //validate the form
        $validator = Validator::make(request()->all(), [
            'commission_perc' => 'required',
            'commission_name' => 'required',
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
        if (!$this->commissionrepo->update($id)) {
            abort(409);
        }

        
        //reponse payload
        $payload = [
            'commission' => $commission,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    public function destroy($id) {

        
        
        $this->commission->find($id)->delete();

        $payload = [
            'type' => 'remove-basic',
            'element' => "#commissiontype_$id",
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
            'dynamic_search_url' => 'commissiontype/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'commissiontype',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_inventory'),
            'add_modal_create_url' => url('commissiontype/create'),
            'add_modal_action_url' => url('commissiontype'),
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
                'create_type' => 'commissiontype',
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
