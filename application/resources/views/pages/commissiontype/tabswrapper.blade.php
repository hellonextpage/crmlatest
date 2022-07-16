<!-- action buttons -->
@include('pages.commissiontype.components.misc.list-page-actions')
<!-- action buttons -->

<!--stats panel-->
@if(auth()->user()->is_team)
<div id="team-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($commissiontype) > 0) @include('misc.list-pages-stats') @endif
</div>
@endif
<!--stats panel-->

<!--team table-->
<div class="card-embed-fix">
@include('pages.commissiontype.components.table.wrapper')
</div>
<!--team table-->