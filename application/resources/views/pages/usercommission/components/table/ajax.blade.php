@foreach( $usercommission as $com)
<!--each row-->
<tr id="usercommission_{{ $com->id }}">
    <td class="team_col_position">
        {{ runtimeCheckBlank($com->user_id) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($com->commission_amt) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($com->sale_id) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($com->is_settled) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($com->settled_on) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($com->is_active) }}
    </td>
    <td class="team_col_position">
    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="{{ urlResource('/usercommission/'.$com->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.edit_user')) }}"
                data-action-url="{{ urlResource('/usercommission/'.$com->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_user')) }}"
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                data-url="{{ url('/') }}/usercommission/{{ $com->id ?? '' }}">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
@endforeach
<!--each row-->