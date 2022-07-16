@foreach( $appointments as $app)
<!--each row-->
<tr id="appointments_{{ $app->aptmnt_id }}">
    <td class="team_col_position">
        {{ runtimeCheckBlank($app->aptmnt_on) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($app->lead_firstname) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($app->lead_phone) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($app->name) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($app->aptmnt_mode) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($app->first_name) }}
    </td>
    <td class="team_col_position">
    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="{{ urlResource('/appointment/'.$app->aptmnt_id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.edit_user')) }}"
                data-action-url="{{ urlResource('/appointment/'.$app->aptmnt_id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_user')) }}"
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                data-url="{{ url('/') }}/appointment/{{ $app->aptmnt_id ?? '' }}">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
@endforeach
<!--each row-->