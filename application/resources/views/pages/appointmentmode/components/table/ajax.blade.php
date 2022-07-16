@foreach( $appointmentmode as $apt)
<!--each row-->
<tr id="appointmentmode_{{ $apt->aptmnt_mode_id }}">
    <td class="team_col_position">
        {{ runtimeCheckBlank($apt->aptmnt_mode) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($apt->created_on) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($apt->status) }}
    </td>
    <td class="team_col_position">
    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="{{ urlResource('/appointmentmode/'.$apt->aptmnt_mode_id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.edit_user')) }}"
                data-action-url="{{ urlResource('/appointmentmode/'.$apt->aptmnt_mode_id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_user')) }}"
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                data-url="{{ url('/') }}/appointmentmode/{{ $apt->aptmnt_mode_id ?? '' }}">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
@endforeach
<!--each row-->