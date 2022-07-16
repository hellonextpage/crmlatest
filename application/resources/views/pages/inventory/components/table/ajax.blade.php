@foreach( $inventory as $inv)
<!--each row-->
<tr id="inventory_{{ $inv->inventory_id }}">
    <td class="team_col_position">
        {{ runtimeCheckBlank($inv->proj_id) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($inv->area) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($inv->facing) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($inv->measurements) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($inv->status) }}
    </td>
    <td class="team_col_position">
        {{ runtimeCheckBlank($inv->plot_villa_flat_no) }}
    </td>
    <td class="team_col_position">
    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal" data-url="{{ urlResource('/inventory/'.$inv->inventory_id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.edit_user')) }}"
                data-action-url="{{ urlResource('/inventory/'.$inv->inventory_id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="team-td-container">
                <i class="sl-icon-note"></i>
            </button>

            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_user')) }}"
                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                data-url="{{ url('/') }}/inventory/{{ $inv->inventory_id ?? '' }}">
                <i class="sl-icon-trash"></i>
            </button>
    </td>
</tr>
@endforeach
<!--each row-->