@extends('layouts.bsreportlayout')
@section('title')
Apseva Service wise Abstract
@endsection
@section('content')
<div>

  <table class="table table-bordered table-sm border-dark break-word">
    <thead style=" font-size: 12pt;" class="verticle-align-middle text-center">
      <tr>
        <th colspan=14 class="fs-5 text-center">
          APSEVA (Revenue & CS) Service wise PBSLA
        </th>
      </tr>
      <tr>
        <th>
          Service
        </th>
        @foreach($columnHeadings as $heading)
        <th>
          {{ucfirst(strtolower($heading))}}
        </th>
        @endforeach
        <th>Total</th>
      </tr>
    </thead>
    <tbody style=" font-size: 12pt;">
      @foreach($apseva_abstract as $item)
      <tr>
        <td class="w-auto" style="font-size:11pt">
          {{ucfirst(strtolower($item->service_name))}}
          
        </td>

        @foreach($columnHeadings as $heading)
        <td class="text-center align-middle w-auto @if($item->$heading>0) bg-danger text-white @endif">
          {{$item->$heading}}
        </td>
        @endforeach
        <td class="text-center align-middle w-auto @if($item->Total>0) bg-danger text-white @endif">
          {{$item->Total}}
        </td>
      </tr>
      @endforeach
      @foreach($mandal_total_pivot as $item)
      <tr class="text-center align-middle @if($item->$heading>0) fw-bold fs-5 @endif">
        <td>
          {{$item->service_name}}
        </td>

        @foreach($columnHeadings as $heading)
        <td class="bg-danger text-white">
          {{$item->$heading}}
        </td>
        @endforeach
        <td class="bg-danger text-white">
          {{$item->Total}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
@endsection

@push('styles')
<style type="text/css">
 .table td.fit, 
.table th.fit {
    white-space: nowrap;
    width: 1%;
}
</style>
@endpush