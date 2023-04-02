@extends('layouts.bsreportlayout')
@section('title')
Apseva Linelist
@endsection
@section('content')

<table class="table table-bordered table-sm">
  <thead>
    <tr>
      <th colspan="6" class="text-center">APSEVA PBSLA Line List</th>
    </tr>
    <tr>
      <th>Slno</th>
      <th>Mandal</th>
      <th>Secretariate Name</th>
      <th>Service Name</th>
      <th>Request Id</th>
      <th>Remarks</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($apseva_linelist as $item)
    <tr>
      <td> {{$loop->iteration}} </td>
      <td> {{$item->new_mandal_name}} </td>
      <td> {{$item->sec_name}} </td>
      <td> {{$item->service_name}} </td>
      <td> {{$item->app_number}} </td>
      <td> {{$item->sla_status}} </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection