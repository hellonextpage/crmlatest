<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
	<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.customer_id')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="customer_id" name="customer_id">
                    <option value="">Select Users</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}" @if(isset($sales) && $sales->customer_id==$user->id) selected @endif>{{$user->first_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
		
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.project')) }}*</label>
            <div class="col-sm-12 col-lg-9">                
                <select class="form-control form-control-sm"  id="proj_id" name="proj_id">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                    <option value="{{$project->project_id}}" @if(isset($sales) && $sales->project_id==$project->project_id) selected @endif>{{$project->project_title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.inventory_id')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="inventory_id" name="inventory_id">
                    <option value="">Select Inventory</option>
                    @foreach($inventory as $inv)
                    <option value="{{$inv->inventory_id}}" @if(isset($sales) && $sales->customer_id==$inv->inventory_id) selected @endif >{{$inv->inventory_id}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.plot_villa_flat_no')) }} ({{
                            config('system.settings_system_currency_symbol') }})</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="actual_amt" name="actual_amt"
                    value="{{ $sales->actual_amt  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.discount_amt')) }} ({{
                            config('system.settings_system_currency_symbol') }})</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="discount_amt" name="discount_amt"
                    value="{{ $sales->discount_amt  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.sale_sub_total')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="sale_sub_total" name="sale_sub_total"
                    value="{{ $sales->sale_sub_total  ?? '' }}">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.sale_tax')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="sale_tax" name="sale_tax"
                    value="{{ $sales->sale_tax  ?? '' }}">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.sale_grand_total')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="sale_grand_total" name="sale_grand_total"
                    value="{{ $sales->sale_grand_total  ?? '' }}">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.sold_on')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="sold_on" name="sold_on"
                    value="{{ $sales->sold_on  ?? '' }}">
            </div>
        </div>
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.sold_by')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="sold_by" name="sold_by">
                    <option value="">Select Users</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}" @if(isset($sales) && $sales->sold_by==$user->id) selected @endif >{{$user->first_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.sale_status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="sale_status" name="sale_status">
                    <option value="">Select Status</option>
                    <option value="1" @if(isset($sales) && $sales->sale_status==1) selected @endif>Ongoing</option>
                    <option value="0" @if(isset($sales) && $sales->sale_status==0) selected @endif>Completed</option>
                </select>
            </div>
        </div>
		
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.payment_status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="payment_status" name="payment_status">
                    <option value="">Select Status</option>
                    <option value="1" @if(isset($sales) && $sales->payment_status==1) selected @endif>Ongoing</option>
                    <option value="0" @if(isset($sales) && $sales->payment_status==0) selected @endif>Completed</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.comments')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="comments" name="comments"
                    value="{{ $sales->comments  ?? '' }}">
            </div>
        </div>
        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.is_active')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_active" name="is_active">
                    <option value="">Select Status</option>
                    <option value="1" @if(isset($sales) && $sales->is_active==1) selected @endif>Active</option>
                    <option value="0" @if(isset($sales) && $sales->is_active==0) selected @endif>Inactive</option>
                </select>
            </div>
        </div>
        <!--/#[edit] city-->

         <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* {{ cleanLang(__('lang.required')) }}</strong></small></div>
            </div>
        </div>
    </div>
</div>