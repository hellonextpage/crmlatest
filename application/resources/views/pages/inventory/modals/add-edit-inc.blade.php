<!--used for all types of users (team, contacts etc-->
<div class="row">
    <div class="col-lg-12">
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.project')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="form-control form-control-sm"  id="proj_id" name="proj_id">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                    <option value="{{$project->project_id}}" >{{$project->project_title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.plot_villa_flat_no')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="plot_villa_flat_no" name="plot_villa_flat_no"
                    value="{{ $inventory->plot_villa_flat_no  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.area')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="area" name="area"
                    value="{{ $inventory->area  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.facing')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="facing" name="facing"
                    value="{{ $inventory->facing  ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="status" name="status">
                    <option value="">Select Status</option>
                    <option value="1" >Ongoing</option>
                    <option value="0">Completed</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.measurements')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="measurements" name="measurements"
                    value="{{ $inventory->measurements  ?? '' }}">
            </div>
        </div>
        
        <!--[edit] city-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.invoice')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="form-control form-control-sm"  id="invoice_id" name="invoice_id">
                    <option value="">Select Invoice</option>
                    @foreach($invoices as $invoice)
                    <option value="{{$invoice->invoice_id}}" >{{$invoice->bill_invoiceid}}</option>
                    @endforeach
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