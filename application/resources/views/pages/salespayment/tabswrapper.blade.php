<!-- action buttons -->
@include('pages.salespayment.components.misc.list-page-actions')
<!-- action buttons -->

<!--stats panel-->
@if(auth()->user()->is_team)
<div id="team-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($salespayment) > 0) @include('misc.list-pages-stats') @endif
</div>
@endif
<!--stats panel-->

<!--team table-->
<div class="card-embed-fix">
@include('pages.salespayment.components.table.wrapper')
</div>
<!--team table-->