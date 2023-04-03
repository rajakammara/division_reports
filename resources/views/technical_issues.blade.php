@extends('layouts.bsreportlayout')
@section('title')
Technical Issues
@endsection
@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> {{ session('status') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container">
  <h5 class="text-center"> APSEVA Technical issues - Anantapur Division - {{date('d-m-Y')}} </h5>
  <table class="table table-bordered table-sm">
    <thead>
      <tr>
        <th>Sno</th>
        <th>Portal</th>
        <th>Mandal</th>
        <th>Request Id</th>
        <th>Service</th>
        <th>Remarks</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($technicalIssues as $item)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$item->portal}}</td>
        <td>{{$item->mandal_name}}</td>
        <td>{{$item->request_id}}</td>
        <td>{{$item->service_name}}</td>
        <td>{{$item->remarks}}</td>
        <td>

          <form action="{{route('issue.destroy',$item->id)}}" method="POST">
            @csrf
            @method("DELETE")
            <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash"></i></button>
          </form>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>

</div>
@endsection
@push('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endpush