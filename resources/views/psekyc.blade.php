@extends('layouts.bsreportlayout')
@section('title')
Housing ekyc
@endsection

@section('content')
<table class="table table-bordered table-sm text-center border-dark">
		<thead>
			<tr>
				<th colspan="8">
					Housing ekyc ANANTHAPURAMU District Mandal Wise Abstract
				</th>
			</tr>
			<tr>
				<th>Sno</th>
				<th>Mandal</th>
				<th>Total</th>
				<th>Completed</th>
				<th>eKYC Completed (%)</th>
				
			</tr>
		</thead>
		<tbody>

			@foreach($data as $row)
			
			<tr>
				<td>{{$loop->iteration}}</td>
				<td class="text-capitalize">{{strtolower($row['mandal'])}}</td>
				<td>{{$row['total']}}</td>
				<td>{{$row['completed']}}</td>
				<td>{{$row['ekyc_completed']}}</td>
				
			</tr>
			@endforeach
			
		</tbody>
		<tfoot>		
			<tr class="fw-bold">
				@php
				$total=0;
				$completed=0;
				$ekyc=0;
				
				
				foreach ($data as $item) {
    				$total += $item['total'];
    				$completed += $item['completed'];
    				$ekyc += $item['ekyc_completed'];
    				
				}
				

				@endphp
				<td colspan="2">Total</td>
				<td>{{$total}}</td>
				<td>{{$completed}}</td>
				<td>{{number_format(($ekyc/14),2)}}</td>
				
			</tr>
			</tfoot>
	</table>
@endsection




