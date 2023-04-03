@extends('layouts.bsreportlayout')
@section('title')
Apseva Service wise Abstract
@endsection
@section('content')
<div>

  <table class="table table-bordered table-sm">
    <thead style=" font-size: 9pt;" class="verticle-align-middle text-center">
      <tr>
        <th colspan=13 class="fs-5 text-center">
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
    <tbody style=" font-size: 9pt;">
      @foreach($apseva_abstract as $item)
      <tr>
        <td class="fw-bold">
          {{$item->service_name}}
        </td>

        @foreach($columnHeadings as $heading)
        <td class="text-center align-middle @if($item->$heading>0) fw-bold fs-6 @endif">
          {{$item->$heading}}
        </td>
        @endforeach
        <td class="text-center align-middle @if($item->Total>0) fw-bold fs-6 @endif">
          {{$item->Total}}
        </td>
      </tr>
      @endforeach
      @foreach($mandal_total_pivot as $item)
      <tr class="text-center align-middle @if($item->$heading>0) fw-bold fs-6 @endif">
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