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
          <div class="d-flex">
            <div class="col m-2">
              <button class="btn btn-primary btn-sm" 
              data-id="{{$item->id}}" 
              data-portal="{{$item->portal}}"
              data-mandal="{{$item->mandal_name}}"
              data-requestid="{{$item->request_id}}"
              data-servicename="{{$item->service_name}}"
              data-remarks="{{$item->remarks}}" 
              onclick="showModal(this)" id="modalbutton"><i class="bi-thin bi-pencil"></i></button>
            </div>
            <div class="col m-2">
              <form action="{{route('issue.destroy',$item->id)}}" method="POST">
            @csrf
            @method("DELETE")
            <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash"></i></button>
          </form>
            </div>
          
          </div>
          
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
{{-- Modal start --}}
 <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Form start -->
                <form id="myform">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Application Pending Remarks</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="mandal_name" class="form-label">Mandal</label>
                                    <input type="text" value="Anantapuramu" id="mandal_name" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="requestid" class="form-label">Application Number</label>
                                    <input type="text" readonly value="IC230328020068" id="requestid" class="form-control" placeholder="Disabled input">
                                </div>
                            </div>
                        </div>
                        <div>
                            <legend class="col-form-label fw-bold">Pending Reason</legend>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pending_reason" id="inlineRadio1" value="Pending">
                                <label class="form-check-label" for="inlineRadio1">Pending</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pending_reason" id="inlineRadio2" value="Technical Issue">
                                <label class="form-check-label" for="inlineRadio2">Technical Issue</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pending_reason" id="inlineRadio3" value="Pending in Other Mandal">
                                <label class="form-check-label" for="inlineRadio3">Pending in Other Mandal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pending_reason" id="inlineRadio3" value="Pending in Other District">
                                <label class="form-check-label" for="inlineRadio3">Pending in Other District</label>
                            </div>
                        </div>
                        <div>
                            <legend class="col-form-label fw-bold">Pending With</legend>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="tahsildar">
                                <label class="form-check-label" for="inlineRadio3">Tahsildar</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="rdo">
                                <label class="form-check-label" for="inlineRadio3">RDO</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="jc">
                                <label class="form-check-label" for="inlineRadio2">JC</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="collector">
                                <label class="form-check-label" for="inlineRadio1">Collector</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="others">
                                <label class="form-check-label" for="inlineRadio3">Others</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="portal" class="form-label fw-bold">Pending Related Portal</label>
                            <select id="portal" class="form-select" name="portal">
                                <option value="">Choose Portal</option>
                                <option value="apseva">Apseva</option>
                                <option value="webland">Webland</option>
                                <option value="meeseva">Meeseva</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pending_remarks" class="form-label">Pending Remarks</label>
                            <textarea class="form-control" id="pending_remarks" rows="3" placeholder="Enter pending description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <!-- /Form end -->
            </div>
        </div>
    </div>
{{-- ./Modal end --}}
</div>
@endsection
@push('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endpush
@push('scripts')
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script type="text/javascript">
    var remarks,requestid;
    var myModal = new bootstrap.Modal(document.getElementById("editModal"), {});
  function showModal(element){ 
    requestid = element.dataset.id;
    remarks = element.dataset.remarks;   
    document.getElementById("mandal_name").value=element.dataset.mandal;
    document.getElementById("requestid").value=element.dataset.requestid;
    document.getElementById("pending_remarks").value=element.dataset.remarks;
    //console.log(element.dataset.remarks);
    
    myModal.show();

  }
  const formelement = document.getElementById('myform');
  formelement.addEventListener('submit',event => {
  event.preventDefault();
  let updated_remarks = document.getElementById('pending_remarks').value;
  // actual logic, e.g. validate the form
  let data = {
    id: requestid,
    remarks:updated_remarks
  }
  let config = {
    headers:{
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  }
  axios.post('/update_issue', data,config)
  .then(function (response) {
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