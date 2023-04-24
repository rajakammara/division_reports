@extends('layouts.bsreportlayout')
@section('title')
Apseva Pending Reasons Abstract
@endsection

@section('content')
<table class="table table-bordered table-sm text-center" id="reasonstable">
		<thead>
			<tr>
				<th colspan="8">
					Apseva Pending Reasons Abstract
				</th>
			</tr>
			<tr>
				<th>Sno</th>
				<th>Mandal</th>
				<th>Pending With in Mandal</th>
				<th>Pending in Other Mandal</th>
				<th>Pending in Other District</th>
				<th>Pending in Others Login</th>
				<th>Technical Issue</th>				
				<th>Total</th>
				
			</tr>
		</thead>
		<tbody>

			@foreach($apseva_reasons as $row)
			
			<tr>
				@if($row->new_mandal_name=="Total")
				<td colspan="2">Total</td>
				@else
				<td>{{$loop->iteration}}</td>
				<td class="text-capitalize">{{strtolower($row->new_mandal_name)}}</td>
				@endif			
				
				<td>{{$row->Pending_within_Mandal}}</td>
				<td>{{$row->Pending_in_Other_Mandal}}</td>
				<td>{{$row->Pending_in_Other_District}}</td>
				<td>{{$row->Pending_in_Others_Login}}</td>
				<td>{{$row->Technical_Issue}}</td>
				<td>{{$row->Total}}</td>
			</tr>
			@endforeach
			
		</tbody>
		
	</table>
@endsection

@push('scripts')
<script type="text/javascript">
	var reasonstable=document.getElementById("reasonstable");
	var lastRow = reasonstable.rows[ reasonstable.rows.length - 1 ];
	lastRow.classList.add("fw-bold");
	//console.log(lastRow)
</script>
@endpush


