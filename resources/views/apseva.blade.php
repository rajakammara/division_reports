@extends('layouts.bsreportlayout')
@section('title')
APSEVA Revenue & Civil Supplies Mandal Abstract
@endsection
@section('content')
<table class="table table-bordered table-sm text-center">
  <thead>
    <tr>
      <th colspan="7">APSEVA Revenue & Civil Supplies Abstract</th>
    </tr>
    <tr>
      <th rowspan="2" style="vertical-align:middle">Mandal Name</th>
      <th colspan="3">Revenue</th>
      <th colspan="3">Civil Supplies</th>
    </tr>
    <tr>
      <th>
        Beyond SLA
      </th>
      <th>
        Lapsing in 24 Hours
      </th>
      <th>
        Lapsing in 48 Hours
      </th>
      <th>
        Beyond SLA
      </th>
      <th>
        Lapsing in 24 Hours
      </th>
      <th>
        Lapsing in 48 Hours
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($apseva_abstract as $item)
    <tr>
      <td>{{$item->new_mandal_name}}</td>
      <td>{{$item->bsla_rev_req}}</td>
      <td>{{$item->lapsing24hrs_rev_req}}</td>
      <td>{{$item->lapsing48hrs_rev_req}}</td>
      <td>{{$item->bsla_cs_req}}</td>
      <td>{{$item->lapsing24hrs_cs_req}}</td>
      <td>{{$item->lapsing48hrs_cs_req}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection