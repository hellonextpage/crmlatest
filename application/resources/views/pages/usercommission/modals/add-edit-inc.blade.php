<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
    <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.user_id')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="user_id" name="user_id">
                    <option value="">Select Users</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}" @if(isset($usercommission) && $usercommission->user_id==$user->id) selected @endif>{{$user->first_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.sale_id')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="sale_id" name="sale_id">
                    <option value="">Select Sale</option>
                    @foreach($sales as $sale)
                    <option value="{{$sale->sale_id}}" @if(isset($usercommission) && $usercommission->sale_id==$sale->sale_id) selected @endif>{{$sale->sale_id}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.is_settled')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_settled" name="is_settled">
                    <option value=""></option>
                    <option value="1" @if(isset($usercommission) && $usercommission->is_settled==1) selected @endif>Settled</option>
                    <option value="0" @if(isset($usercommission) && $usercommission->is_settled==0) selected @endif>Un Settled</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.settled_on')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" id="settled_on" name="settled_on"
                    value="{{ $usercommission->settled_on  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.commission_amt')) }} ({{
                            config('system.settings_system_currency_symbol') }})</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="commission_amt" name="commission_amt"
                    value="{{ $usercommission->commission_amt  ?? '' }}">
            </div>
        </div>

        
        

        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.is_active')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="is_active" name="is_active">
                    <option value="">Select Status</option>
                    <option value="1" @if(isset($usercommission) && $usercommission->is_active==1) selected @endif>Active</option>
                    <option value="0" @if(isset($usercommission) && $usercommission->is_active==0) selected @endif>Inactive</option>
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