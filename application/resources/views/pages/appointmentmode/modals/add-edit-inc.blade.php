<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">    
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.name')) }} ({{
                            config('system.settings_system_currency_symbol') }})</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="name" name="name"
                    value="{{ $appointmentmode->name  ?? '' }}">
            </div>
        </div>       
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.is_active')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="status" name="status">
                    <option value="">Select Status</option>
                    <option value="1" @if(isset($appointmentmode) && $appointmentmode->status==1) selected @endif>Active</option>
                    <option value="0" @if(isset($appointmentmode) && $appointmentmode->status==0) selected @endif>Inactive</option>
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