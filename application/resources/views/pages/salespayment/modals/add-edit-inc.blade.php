<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
	<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.aptmnt_id')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="aptmnt_id" name="aptmnt_id">
                    <option value="">Select Appointment</option>
                    @foreach($appointment as $app)
                    <option value="{{$app->aptmnt_id}}" @if(isset($salespayment) && $salespayment->aptmnt_id==$app->aptmnt_id) selected @endif>{{$app->aptmnt_id}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.pay_schedl_sub_total')) }} ({{
                            config('system.settings_system_currency_symbol') }})</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="pay_schedl_sub_total" name="pay_schedl_sub_total"
                    value="{{ $salespayment->pay_schedl_sub_total  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.pay_schedl_tax')) }} ({{
                            config('system.settings_system_currency_symbol') }})</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="pay_schedl_tax" name="pay_schedl_tax"
                    value="{{ $salespayment->pay_schedl_tax  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.pay_schedl_grand_total')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="pay_schedl_grand_total" name="pay_schedl_grand_total"
                    value="{{ $salespayment->pay_schedl_grand_total  ?? '' }}">
            </div>
        </div>
		
		
		<div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.payment_schedled_on')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="payment_schedled_on" name="payment_schedled_on"
                    value="{{ $salespayment->payment_schedled_on  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.payment_due_date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="payment_due_date" name="payment_due_date"
                    value="{{ $salespayment->payment_due_date  ?? '' }}">
            </div>
        </div>
		

        

        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.is_active')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_active" name="is_active">
                    <option value="">Select Status</option>
                    <option value="1" @if(isset($salespayment) && $salespayment->is_active==1) selected @endif>Active</option>
                    <option value="0" @if(isset($salespayment) && $salespayment->is_active==0) selected @endif>Inactive</option>
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