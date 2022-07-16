<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Http\Responses\UserCommission\StoreResponse;
use App\Http\Responses\UserCommission\CreateResponse;
use App\Http\Responses\UserCommission\IndexResponse;
use App\Http\Responses\UserCommission\EditResponse;
use App\Http\Responses\UserCommission\UpdateResponse;
use App\Repositories\UserCommissionRepository;
use App\Http\Responses\Common\CommonResponse;
use Validator;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\User;
use App\Models\Project;
use App\Models\UserCommissionModel;

class UserCommission extends Controller
{
    public function __construct(UserCommissionRepository $usercommissionrepo,UserCommissionModel $usercommission,User $users,Sale $sales) {

        //parent
        parent::__construct();
        $this->usercommissionrepo = $usercommissionrepo;
		$this->usercommission = $usercommission;
		$this->sales = $sales;
		$this->users = $users;
        //authenticated
        $this->middleware('auth');               
    }

    public function index(){
        $usercommission = $this->usercommission->All();
        //reponse payload
        $payload = [
            'page'=>$this->pageSettings('team'),
            'usercommission' => $usercommission,
            
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
        $sales = $this->sales->All();

      
		$users = $this->users->All();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
			'users'=>$users,
			'sales'=>$sales

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
            'user_id' => 'required',
            'commission_amt' => 'required',
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
        $this->usercommissionrepo->create();

        /*
        if (!$inventory = $this->inventoryrepo->create()) {
            abort(409);
        }
        */

        //get the user
        $sales = $this->sales->All();
		$users = $this->users->All();
		$usercommission = $this->usercommission->All();

        //reponse payload
        $payload = [
            'usercommission' => $usercommission,
			'users'=>$users
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    public function edit($id) {

        //get all team level roles
        $sales = $this->sales->All();

		$users = $this->users->All();

        //get the user
        $usercommission = $this->usercommissionrepo->get($id);

        

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'usercommission' => $usercommission,
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
        $usercommission = $this->usercommissionrepo->get($id);

        

        //custom error messages
        $messages = [];

        //validate the form
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required',
            'commission_amt' => 'required',
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
        if (!$this->usercommissionrepo->update($id)) {
            abort(409);
        }

        
        //reponse payload
        $payload = [
            'usercommission' => $usercommission,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    public function destroy($id) {

        
        
        $this->usercommission->find($id)->delete();

        $payload = [
            'type' => 'remove-basic',
            'element' => "#usercommission_$id",
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
            'dynamic_search_url' => 'usercommission/search?source=' . request('source') . '&action=search',
            'add_button_classes' => '',
            'load_more_button_route' => 'usercommission',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_inventory'),
            'add_modal_create_url' => url('usercommission/create'),
            'add_modal_action_url' => url('usercommission'),
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
                'create_type' => 'usercommission',
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
