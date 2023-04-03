@extends('layouts.bsreportlayout')
@section('title')
Apseva Linelist
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
<table class="table table-bordered table-sm">
  <thead>
    <tr>
      @can('isAdmin')
      <th colspan="7" class="text-center">APSEVA PBSLA Line List</th>
      @else
      <th colspan="6" class="text-center">APSEVA PBSLA Line List</th>
      @endcan
    </tr>
    <tr>
      <th>Slno</th>
      <th>Mandal</th>
      <th>Secretariate Name</th>
      <th>Service Name</th>
      <th>Request Id</th>
      <th>Remarks</th>
      @can('isAdmin')
      <th>Issue Description</th>
      @else

      @endcan
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
      <td> {{$item->remarks}} </td>
      @can('isAdmin')
      <td>
        @if (is_null($item->remarks))
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
          data-bs-target="#issueModal{{$loop->iteration}}">
          Issue
        </button>
        <!-- Modal -->
        <div class="modal fade" id="issueModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="issueModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="issueModalLabel">Add Technical Issue</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{route('create_issue')}}" method="POST">
                  @csrf
                  <input type="hidden" name="appid" value="{{$item->id}}">
                  <input type="hidden" name="service_name" value="{{$item->service_name}}">
                  <div class="mb-3 mt-2">
                    <label for="mandal_name" class="form-label">Mandal:</label>
                    <input readonly class="form-control" id="mandal_name" name="mandal_name"
                      value="{{$item->new_mandal_name}}">
                  </div>
                  <div class="mb-3 mt-3">
                    <label for="app_number" class="form-label">Application Number:</label>
                    <input readonly class="form-control" id="app_number" name="app_number"
                      value="{{$item->app_number}}">
                  </div>
                  <div class="mb-3">
                    <label for="portal" class="form-label">Portal:</label>
                    <select class="form-select" name="portal" required>
                      <option selected value="">Choose portal related to issue</option>
                      <option value="Webland">Webland</option>
                      <option value="Apseva">Apseva</option>
                      <option value="Meeseva">Meeseva</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="floatingTextarea2">Issue</label>
                    <textarea class="form-control" placeholder="Enter Issue Description" id="floatingTextarea2"
                      style="height: 100px" name="remarks" required></textarea>

                  </div>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </td>
      @else
      @endif
      @endcan

    </tr>
    @endforeach
  </tbody>
</table>
@endsection