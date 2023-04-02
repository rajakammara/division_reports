@extends('layouts.bsreportlayout')
@section('title')
One Time Conversion and Land Conversion
@endsection
@section('content')
<div class="container">
  <table class="table table-bordered table-sm">
    <thead class="fw-bold">
      <tr class="text-center">
        <td colspan=11>Land Conversion Abstract (G.O.Ms.No.98)
        </td>
      </tr>
      <tr>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>S.no</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>District Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Division Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Rdo Initiated</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Tahsildar report Submitted</b></td>
        <td colspan="3" align="center" style="vertical-align:middle"><b>RDO final orders passed</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>incorporation in revenue records</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Tahsildar report</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Rdo orders on report submitted by
            Tahsildar</b></td>
      </tr>
      <tr>
        <td align="center" style="vertical-align:middle"><b>Approved</b></td>
        <td align="center" style="vertical-align:middle"><b>Rejected</b></td>
        <td align="center" style="vertical-align:middle"><b>Total</b></td>
      </tr>
      <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
        <td align="center">(5)</td>
        <td align="center">(6)</td>
        <td align="center">(7)</td>
        <td align="center">(8)</td>
        <td align="center">(9)</td>
        <td align="center">10=(4-5/4*100)</td>
        <td align="center">11=(5-8/5*100)</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($lc_dist_response['Data'] as $item)
      @php
      $RDoinitiated =$item['Tot'] - $item['NotIntiated'];
      $TahReportSub = $RDoinitiated - $item['EnquiryPending'];
      $Approved=$item['Approve'] + $item['Pending'];
      $Reject =$item['Rej'];
      $Total = $Approved + $Reject;
      $Incorporation =$item['Approve'];
      $PercentageData=100 * ($RDoinitiated-$TahReportSub)/$RDoinitiated;
      $PercentageofRdo = 100 * ($TahReportSub-$Total)/$TahReportSub
      @endphp
      <tr>
        @if ($item['dist_name']=='Total')
        <td colspan=3 align="center">Total</td>

        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$item['Approve']}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @else
        <td>{{$loop->iteration}}</td>
        <td>{{$item['dist_name']}}</td>
        <td>{{$item['div_name']}}</td>
        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$item['Approve']}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="container">
  <table class="table table-bordered table-sm">
    <thead class="fw-bold">
      <tr class="text-center">
        <td colspan=12>Land Conversion Abstract (G.O.Ms.No.98)
        </td>
      </tr>
      <tr>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>S.no</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>District Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Division Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Mandal Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Rdo Initiated</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Tahsildar report Submitted</b></td>
        <td colspan="3" align="center" style="vertical-align:middle"><b>RDO final orders passed</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>incorporation in revenue records</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Tahsildar report</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Rdo orders on report submitted by
            Tahsildar</b></td>
      </tr>
      <tr>
        <td align="center" style="vertical-align:middle"><b>Approved</b></td>
        <td align="center" style="vertical-align:middle"><b>Rejected</b></td>
        <td align="center" style="vertical-align:middle"><b>Total</b></td>
      </tr>
      <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
        <td align="center">(5)</td>
        <td align="center">(6)</td>
        <td align="center">(7)</td>
        <td align="center">(8)</td>
        <td align="center">(9)</td>
        <td align="center">(10)</td>
        <td align="center">11=(5-6/5*100)</td>
        <td align="center">12=(6-9/6*100)</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($lc_div_response['Data'] as $item)
      @php
      $RDoinitiated =$item['Tot'] - $item['NotIntiated'];
      $TahReportSub = $RDoinitiated - $item['EnquiryPending'];
      $Approved=$item['Approve'] + $item['Pending'];
      $Reject =$item['Rej'];
      $Total = $Approved + $Reject;
      $Incorporation =$item['Approve'];
      $PercentageData=100 * ($RDoinitiated-$TahReportSub)/$RDoinitiated;
      $PercentageofRdo = 100 * ($TahReportSub-$Total)/$TahReportSub
      @endphp
      <tr>
        @if ($item['dist_name']=='Total')
        <td colspan="4" align="center">Total</td>
        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$Incorporation}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @else
        <td>{{$loop->iteration}}</td>
        <td>{{$item['dist_name']}}</td>
        <td>{{$item['div_name']}}</td>
        <td>{{$item['mand_name']}}</td>
        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$Incorporation}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @endif

      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{-- OTC --}}
<div class="container">
  <table class="table table-bordered table-sm">
    <thead class="fw-bold">
      <tr class="text-center">
        <td colspan=12>One Time Conversion Abstract (G.O.Ms.No.227)
        </td>
      </tr>
      <tr>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>S.no</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>District Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Division Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Rdo Initiated</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Tahsildar report Submitted</b></td>
        <td colspan="3" align="center" style="vertical-align:middle"><b>RDO final orders passed</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>incorporation in revenue records</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Tahsildar report</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Rdo orders on report submitted by
            Tahsildar</b></td>
      </tr>
      <tr>
        <td align="center" style="vertical-align:middle"><b>Approved</b></td>
        <td align="center" style="vertical-align:middle"><b>Rejected</b></td>
        <td align="center" style="vertical-align:middle"><b>Total</b></td>
      </tr>
      <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
        <td align="center">(5)</td>
        <td align="center">(6)</td>
        <td align="center">(7)</td>
        <td align="center">(8)</td>
        <td align="center">(9)</td>
        <td align="center">10=(4-5/4*100)</td>
        <td align="center">11=(5-8/5*100)</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($otc_dist_response['Data'] as $item)
      @php
      $RDoinitiated =$item['totalcount'] - $item['notintiated'];
      $TahReportSub = $item['totalcount'] - ( $item['notintiated'] + $item['tahsildarpending']);
      $Approved=$item['pendingatdt'] + $item['approve'];
      $Reject =$item['reject'];
      $Total = $Approved + $Reject;
      $Incorporation =$item['approve'];
      $PercentageData=100 * ($RDoinitiated-$TahReportSub)/$RDoinitiated;
      $PercentageofRdo = 100 * ($TahReportSub-$Total)/$TahReportSub
      @endphp
      <tr>
        @if ($item['dist_name']=="Total")
        <td colspan=3 align="center">Total</td>

        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$Incorporation}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @else
        <td>{{$loop->iteration}}</td>
        <td>{{$item['dist_name']}}</td>
        <td>{{$item['div_name_tel']}}</td>
        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$Incorporation}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @endif

      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{-- division otc --}}
<div class="container">
  <table class="table table-bordered table-sm">
    <thead class="fw-bold">
      <tr class="text-center">
        <td colspan=12>One Time Conversion Abstract (G.O.Ms.No.227)
        </td>
      </tr>
      <tr>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>S.no</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>District Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Division Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Mandal Name</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Rdo Initiated</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>Tahsildar report Submitted</b></td>
        <td colspan="3" align="center" style="vertical-align:middle"><b>RDO final orders passed</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>incorporation in revenue records</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Tahsildar report</b></td>
        <td rowspan="2" align="center" style="vertical-align:middle"><b>% Pending Rdo orders on report submitted by
            Tahsildar</b></td>
      </tr>
      <tr>
        <td align="center" style="vertical-align:middle"><b>Approved</b></td>
        <td align="center" style="vertical-align:middle"><b>Rejected</b></td>
        <td align="center" style="vertical-align:middle"><b>Total</b></td>
      </tr>
      <tr>
        <td align="center">(1)</td>
        <td align="center">(2)</td>
        <td align="center">(3)</td>
        <td align="center">(4)</td>
        <td align="center">(5)</td>
        <td align="center">(6)</td>
        <td align="center">(7)</td>
        <td align="center">(8)</td>
        <td align="center">(9)</td>
        <td align="center">(10)</td>
        <td align="center">11=(5-6/5*100)</td>
        <td align="center">12=(6-9/6*100)</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($otc_div_response['Data'] as $item)
      @php
      $RDoinitiated =$item['totalcount'] - $item['notintiated'];
      $TahReportSub = $item['totalcount'] - ( $item['notintiated'] + $item['tahsildarpending']);
      $Approved=$item['pendingatdt'] + $item['approve'];
      $Reject =$item['reject'];
      $Total = $Approved + $Reject;
      $Incorporation =$item['approve'];
      $PercentageData=100 * ($RDoinitiated-$TahReportSub)/$RDoinitiated;
      $PercentageofRdo = 100 * ($TahReportSub-$Total)/$TahReportSub
      @endphp
      <tr>
        @if ($item['dist_name']=='Total')
        <td colspan="4" align="center">Total</td>
        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$Incorporation}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @else
        <td>{{$loop->iteration}}</td>
        <td>{{$item['dist_name']}}</td>
        <td>{{$item['div_name_tel']}}</td>
        <td>{{$item['mand_name']}}</td>
        <td align="center">{{$RDoinitiated}}</td>
        <td align="center">{{$TahReportSub}}</td>
        <td align="center">{{$Approved}}</td>
        <td align="center">{{$Reject}}</td>
        <td align="center">{{$Total}}</td>
        <td align="center">{{$Incorporation}}</td>
        <td align="center">{{number_format($PercentageData,2)}}</td>
        <td align="center">{{number_format($PercentageofRdo,2)}}</td>
        @endif

      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{-- ./division otc --}}
{{-- ./OTC --}}
@endsection