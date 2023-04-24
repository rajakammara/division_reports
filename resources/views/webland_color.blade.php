@extends('layouts.bsreportlayout')

@section('title')
Mutation for Correction & Transaction
@endsection
@section('content')
<div class="container">

  <table class="table table-bordered text-center table-sm border-dark">
    <thead>
      <tr>
        <th colspan=17 class="text-center">Mutation for Correction</th>
      </tr>
      <tr>
        <th rowspan=2>Sl.No</th>
        <th style="width:150 px" rowspan=2>Mandal</th>
        <th colspan=2>Form-8</th>
        <th colspan=3>VRO</th>
        <th colspan=3>Tahsildar</th>
        <th colspan=3>SC/RDO Recommendations</th>
        <th colspan=3>Disposal by Tahsildar After SC/RDO Scrutiny</th>
        <th rowspan=3>Total PBSLA</th>
      </tr>
      <tr>
        <th>Pending</th>
        <th style="width:70 px">Beyond SLA</th>
        <!-- VRO  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>
        <!--  Tahsildar  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>

        <!--  RDO  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>

        <!--  After Scrutiny  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($mtc_response['Data'] as $items)
      <tr>
        @if ($items['mand_name']=='Total')
        <td></td>
        @else
        <td>{{$loop->iteration}}</td>
        @endif
        <td style="width:150 px">{{$items['mand_name']}}</td>
        <td>{{$items['sla7']}}</td>
        <td class="bg-danger text-white">{{$items['sla8']}}</td>
        <!--  VRO  -->
        <td>{{$items['sla11']}}</td>
        <td class="bg-warning text-dark">{{$items['sla12']}}</td>
        <td class="bg-danger text-white">{{$items['sla13']}}</td>
        <!--  Tahsildar  -->
        <td>{{$items['sla18']}}</td>
        <td class="bg-warning text-dark">{{$items['sla19']}}</td>
        <td class="bg-danger text-white">{{$items['sla20']}}</td>
        <!--  RDO  -->
        <td>{{$items['sla25']}}</td>
        <td class="bg-warning text-dark">{{$items['sla26']}}</td>
        <td class="bg-danger text-white">{{$items['sla27']}}</td>
        <!--  After Scrutiny  -->
        <td>{{$items['sla32']}}</td>
        <td class="bg-warning text-dark">{{$items['sla33']}}</td>
        <td class="bg-danger text-white">{{$items['sla34']}}</td>
        <td class="bg-danger text-white">{{ $items['sla13'] + $items['sla20'] + $items['sla27'] + $items['sla34']}}</td>
      </tr>
      @endforeach
    </tbody>
</div>
{{-- MTT --}}

<div class="container">
  <table class="table table-bordered text-center table-sm border-dark">
    <thead>
      <tr>
        <th colspan=17 class="text-center">Mutation for Transaction</th>
      </tr>
      <tr>
        <th rowspan=2>Sl.No</th>
        <th style="width:150 px" rowspan=2>Mandal</th>
        <th colspan=2>Form-8</th>
        <th colspan=3>VRO</th>
        <th colspan=3>Tahsildar</th>
        <th colspan=3>SC/RDO Recommendations</th>
        <th colspan=3>Disposal by Tahsildar After SC/RDO Scrutiny</th>
        <th rowspan=3>Total PBSLA</th>
      </tr>
      <tr>
        <th>Pending</th>
        <th style="width:70 px">Beyond SLA</th>
        <!-- VRO  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>
        <!--  Tahsildar  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>

        <!--  RDO  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>

        <!--  After Scrutiny  -->
        <th style="width:60 px">With in SLA</th>
        <th style="width:80 px">Lapsing in 24 Hours</th>
        <th style="width:70 px">Beyond SLA</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($mtt_response['Data'] as $items)
      <tr>
        @if ($items['mand_name']=='Total')
        <td></td>
        @else
        <td>{{$loop->iteration}}</td>
        @endif
        <td style="width:150 px">{{$items['mand_name']}}</td>
        @if ($items['mand_name']=='Total')
        <td>{{$items['sla8']}}</td>
        <td class="bg-danger text-white">{{$items['sla7']}}</td>
        @else
        <td>{{$items['sla7']}}</td>
        <td class="bg-danger text-white">{{$items['sla8']}}</td>
        @endif

        <!--  VRO  -->
        <td>{{$items['sla11']}}</td>
        <td class="bg-warning text-dark">{{$items['sla12']}}</td>
        <td class="bg-danger text-white">{{$items['sla13']}}</td>
        <!--  Tahsildar  -->
        <td>{{$items['sla18']}}</td>
        <td class="bg-warning text-dark">{{$items['sla19']}}</td>
        <td class="bg-danger text-white">{{$items['sla20']}}</td>
        <!--  RDO  -->
        <td>{{$items['sla25']}}</td>
        <td class="bg-warning text-dark">{{$items['sla26']}}</td>
        <td class="bg-danger text-white">{{$items['sla27']}}</td>
        <!--  After Scrutiny  -->
        <td>{{$items['sla32']}}</td>
        <td class="bg-warning text-dark">{{$items['sla33']}}</td>
        <td class="bg-danger text-white">{{$items['sla34']}}</td>
        <td class="bg-danger text-white">{{ $items['sla13'] + $items['sla20'] + $items['sla27'] + $items['sla34']}}</td>
      </tr>
      @endforeach
    </tbody>
</div>
{{-- /MTT --}}
@endsection