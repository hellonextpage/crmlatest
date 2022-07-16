<div class="card" id="team-table-wrapper" id="team-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (!$appointmenttype->isEmpty())
            <table id="team-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <th class="team_col_first_name"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_first_name" href="javascript:void(0)"
                                data-url="{{ urlResource('/team?action=sort&orderby=first_name&sortorder=asc') }}">{{ cleanLang(__('lang.name')) }}<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a></th>
                        <th class="team_col_position"><a class="js-ajax-ux-request js-list-sorting" id="sort_position"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/team?action=sort&orderby=position&sortorder=asc') }}">{{ cleanLang(__('lang.created')) }}<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="team_col_role"><a class="js-ajax-ux-request js-list-sorting" id="sort_role_id"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/team?action=sort&orderby=role_id&sortorder=asc') }}">{{ cleanLang(__('lang.status')) }}<span
                                    class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        
                        <th class="team_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a>
                        </th>
                    </tr>
                </thead>
                <tbody id="appointmenttype-view-wrapper">
                    <!--ajax content here-->
                    @include('pages.appointmenttype.components.table.ajax')
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            @else
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>