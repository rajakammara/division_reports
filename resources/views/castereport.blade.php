@extends('layouts.bsreportlayout')
@section('title')
Integrated Caste & Income Certificate
@endsection

@section('content')
<table class="table table-bordered table-sm text-center">
		<thead>
			<tr>
				<th colspan="8">
					Application for Integrated Caste & Income Certificate ANANTHAPURAMU Division Mandal Wise Abstract
				</th>
			</tr>
			<tr>
				<th>Sno</th>
				<th>Mandal</th>
				<th>Total Students</th>
				<th>Updated Students</th>
				<th>Having Old Certificates</th>
				<th>Applied for New Certificates</th>
				<th>Balance to be Completed</th>
				<th>% of Completion</th>
			</tr>
		</thead>
		<tbody>

			@foreach($data as $row)
			@php
			$percentage = number_format(100*($row['updated_students']/$row['total_students']),2);
			@endphp
			<tr>
				<td>{{$loop->iteration}}</td>
				<td class="text-capitalize">{{strtolower($row['mandal'])}}</td>
				<td>{{$row['total_students']}}</td>
				<td>{{$row['updated_students']}}</td>
				<td>{{$row['having_old_cert']}}</td>
				<td>{{$row['applied_new']}}</td>
				<td>{{$row['balance']}}</td>
				<td>{{$row['percentage']}}</td>
			</tr>
			@endforeach
			
		</tbody>
		<tfoot>		
			<tr class="fw-bold">
				@php
				$total_students=0;
				$updated_students=0;
				$having_old_cert=0;
				$applied_new=0;
				
				foreach ($data as $item) {
    				$total_students += $item['total_students'];
    				$updated_students += $item['updated_students'];
    				$having_old_cert += $item['having_old_cert'];
    				$applied_new += $item['applied_new'];
				}
				$balance=$total_students-$updated_students;
				$total_percentage=number_format(100*($updated_students/$total_students),2);

				@endphp
				<td colspan="2">Total</td>
				<td>{{$total_students}}</td>
				<td>{{$updated_students}}</td>
				<td>{{$having_old_cert}}</td>
				<td>{{$applied_new}}</td>
				<td>{{$balance}}</td>
				<td>{{$total_percentage}}</td>
			</tr>
			</tfoot>
	</table>
@endsection




