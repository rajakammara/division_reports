@extends('layouts.bslayout')
@section('content')
<div class="mt-5">
    <div class="list-group fs-4">
        <a href="/get_apseva_service_abstract" target="_blank" class="list-group-item list-group-item-action">APSEVA
            Revenue and CS
            Service wise Abstract</a>
        <a href="/get_apseva_mandal_abstract" target="_blank" class="list-group-item list-group-item-action">APSEVA
            Revenue and CS
            Mandal wise Abstract</a>
        <a href="/mutation_report" target="_blank" class="list-group-item list-group-item-action">Mutation for
            Correction & Transaction
            Abstract</a>
        <a href="/otc_report" target="_blank" class="list-group-item list-group-item-action">Land Conversion & One Time
            Conversion
            Abstract</a>
        <a href="apseva_linelist" target="_blank" class="list-group-item list-group-item-action">APSEVA PBSLA
            Linelist</a>

        <a href="/technical_issues" target="_blank" class="list-group-item list-group-item-action">Technical Issues</a>
        @can('isAdmin')
        <h4>You are admin</h4>
        @else
        <h4>You are User</h4>
        @endcan
    </div>
</div>
@stop