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
      <th colspan="8" class="text-center">APSEVA PBSLA Line List</th>
      @else
      <th colspan="7" class="text-center">APSEVA PBSLA Line List</th>
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
      <th>Actions</th>
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
      <td> {{ $item->pending_reason . "  " . $item->remarks}} </td>
      @can('isAdmin')
      <td>
        @if (is_null($item->remarks))
        <div class="d-flex justify-content-between">
          <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
          data-bs-target="#issueModal{{$loop->iteration}}" id="add_button"
          data-id="{{$item->id}}"
          data-servicename="{{$item->service_name}}"
          >
          <i class="bi bi-plus-circle"></i>
        </button>
        

        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="issueModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="issueModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="issueModalLabel">Add Pending Remarks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{route('create_issue')}}" method="POST">
                  @csrf
                  <input type="hidden" name="appid" value="{{$item->id}}">
                  <input type="hidden" name="service_name" value="{{$item->service_name}}">
                  <div class="row">
                    
                  {{-- row --}}
                  <div class="mb-3 col-6">
                    <label for="mandal_name" class="form-label fw-semibold">Mandal:</label>
                    <input readonly class="form-control" id="mandal_name" name="mandal_name"
                      value="{{$item->new_mandal_name}}">
                  </div>
                  <div class="mb-3 col-6">
                    <label for="app_number" class="form-label fw-semibold">Application Number:</label>
                    <input readonly class="form-control" id="app_number" name="app_number"
                      value="{{$item->app_number}}">
                  </div>
                  </div>
                  {{-- row end --}}
                  {{-- row --}}
                  <div class="row">
                   
                  <div class="mb-3 col-auto">
                    <label for="pending_reason" class="form-label fw-semibold">Pending Reason:</label>
                    <select class="form-select" name="pending_reason" required>
                      <option selected value="" disabled>Choose pending reasons</option>
                      <option value="Pending Within Mandal">Pending Within Mandal</option>
                      <option value="Technical Issue">Technical Issue</option>
                      <option value="Pending in Other Mandal">Pending in Other Mandal</option>
                      <option value="Pending in Other District">Pending in Other District</option>
                      <option value="Pending in Others Login">Pending in Others Login</option>
                    </select>
                  </div>

                  <div class="mb-3 col-auto">
                    <label for="portal" class="form-label fw-semibold">Portal:</label>
                    <select class="form-select" name="portal" required>
                      <option selected value="" disabled>Choose portal related to issue</option>
                      <option value="Webland">Webland</option>
                      <option value="Apseva">Apseva</option>
                      <option value="Meeseva">Meeseva</option>
                    </select>
                  </div>
                  <div class="mb-3 col-auto">
                    <label for="pending_with" class="form-label fw-semibold">Pending with:</label>
                    <select class="form-select" name="pending_with" required>
                      <option selected value="" disabled>Pending with</option>
                      <option value="Tahsildar">Tahsildar</option>
                      <option value="RDO">RDO</option>
                      <option value="JC">JC</option>
                      <option value="Collector">Collector</option>
                      <option value="Others">Others</option>
                      <option value="Technical Issue">Technical Issue</option>
                    </select>
                  </div>
                  
                  </div> 
                  {{-- row end --}}

                  <div class="mb-1">
                    <label for="description" class="mb-1 fw-semibold">Pending Description</label>
                    <textarea class="form-control" placeholder="Enter Issue Description" id="description"
                      rows="2" name="remarks" required></textarea>
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
      <div class="d-flex">       
      
      <button type="button" class="btn btn-warning m-1"  id="edit_button" onclick="showeditmodal(this)"
              data-issueid="{{$item->issueid}}" 
              data-portal="{{$item->portal}}"
              data-mandal="{{$item->mandal_name}}"
              data-requestid="{{$item->request_id}}"
              data-pending_with="{{$item->pending_with}}"
              data-pending_reason="{{$item->pending_reason}}"
              data-remarks="{{$item->remarks}}"

      >
          <i class="bi bi-pencil-square"></i>
        </button>
        <form action="/{{$item->issueid}}/delete" method="POST">
            @csrf
            @method("DELETE")
        <button type="submit" class="btn btn-danger m-1" id="delete_button">
          <i class="bi bi-trash3"></i>
        </button>
      </form>
      </div>
      @endif
      @endcan

    </tr>
    @endforeach
  </tbody>
</table>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModal">Edit Pending Remarks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="#" method="POST" id="editform">                 
                 
                  <div class="row">
                    
                  {{-- row --}}
                  <div class="mb-3 col-6">
                    <label for="mandal_name_edit" class="form-label fw-semibold">Mandal:</label>
                    <input readonly class="form-control" id="mandal_name_edit" name="mandal_name_edit"
                      >
                  </div>
                  <div class="mb-3 col-6">
                    <label for="requestid" class="form-label fw-semibold">Application Number:</label>
                    <input readonly class="form-control" id="requestid" name="requestid"
                      value="">
                  </div>
                  </div>
                  {{-- row end --}}
                  {{-- row --}}
                  <div class="row">
                   
                  <div class="mb-3 col-auto">
                    <label for="pending_reason" class="form-label fw-semibold">Pending Reason:</label>
                    <select class="form-select" name="pending_reason" id="pending_reason" required>
                      <option selected value="" disabled>Choose pending reasons</option>
                      <option value="Pending Within Mandal">Pending Within Mandal</option>
                      <option value="Technical Issue">Technical Issue</option>
                      <option value="Pending in Other Mandal">Pending in Other Mandal</option>
                      <option value="Pending in Other District">Pending in Other District</option>
                    </select>
                  </div>

                  <div class="mb-3 col-auto">
                    <label for="portal" class="form-label fw-semibold">Portal:</label>
                    <select class="form-select" name="portal" id="portal" required>
                      <option selected value="" disabled>Choose portal related to issue</option>
                      <option value="Webland">Webland</option>
                      <option value="Apseva">Apseva</option>
                      <option value="Meeseva">Meeseva</option>
                    </select>
                  </div>
                  <div class="mb-3 col-auto">
                    <label for="pending_with" class="form-label fw-semibold">Pending with:</label>
                    <select class="form-select" name="pending_with" id="pending_with" required>
                      <option selected value="" disabled>Pending with</option>
                      <option value="Tahsildar">Tahsildar</option>
                      <option value="RDO">RDO</option>
                      <option value="JC">JC</option>
                      <option value="Collector">Collector</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                  
                  </div> 
                  {{-- row end --}}

                  <div class="mb-1">
                    <label for="description" class="mb-1 fw-semibold">Pending Description</label>
                    <textarea class="form-control" placeholder="Enter Issue Description" id="pending_remarks"
                      rows="2" name="pending_remarks" required></textarea>
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
{{-- edit modal end --}}
@endsection
@push('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endpush
@push('scripts')
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script type="text/javascript">
  var add_button = document.getElementById("add_button");
  var edit_button = document.getElementById("edit_button");
  var issueid;
  function showeditmodal(element){
    issueid = element.dataset.issueid;
    remarks = element.dataset.remarks; 
    console.log(element.dataset.mandal);  
    document.getElementById("mandal_name_edit").value=element.dataset.mandal;
    document.getElementById("requestid").value=element.dataset.requestid;
    document.getElementById("pending_remarks").value=element.dataset.remarks;
    document.getElementById("pending_reason").value=element.dataset.pending_reason;
    document.getElementById("portal").value=element.dataset.portal;
    document.getElementById("pending_with").value=element.dataset.pending_with;
    var myModal = new bootstrap.Modal(document.getElementById("editModal"), {});
    myModal.show();
    console.log();
  }
  const formelement = document.getElementById('editform');
  formelement.addEventListener('submit',event => {
  event.preventDefault();
  
  let updated_remarks = document.getElementById('pending_remarks').value;
  let pending_reason = document.getElementById("pending_reason").value;
  let portal=document.getElementById("portal").value;
  let pending_with=document.getElementById("pending_with").value;
  var myModal = new bootstrap.Modal(document.getElementById("editModal"), {});
  console.log(issueid);
  // actual logic, e.g. validate the form
  let data = {
    id: issueid,
    remarks:updated_remarks,
    pending_reason : pending_reason,
    pending_with:pending_with,
    portal:portal,
  }
  let config = {
    headers:{
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  }
  axios.post('/update_issue', data,config)
  .then(function (response) {
    var myModal = new bootstrap.Modal(document.getElementById("editModal"), {});
    myModal.hide();
    window.location.reload();
    console.log(response.data);
  })
  .catch(function (error) {
    console.log(error);
  });
  console.log('Form submission cancelled.');
});
</script>
@endpush