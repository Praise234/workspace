@extends('admin.layout')

@section('viewInc')


<!--start content-->
<main class="page-content">
              
            @if(session('success'))
              <div class="alert alert-success alert-dismissible">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{session('success')}}
              </div>
            @endif



            <div class="col-md-8 col-lg-5 mx-auto">
              <div class="mt-5"></div>
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
              </div>
              <form class="row g-3" method="post" action="{{Route('add_unavailable')}}">
                @csrf
                <div class="col-12">
                  <label class="form-label">From Date</label>
                  <input type="date" class="form-control" min = "{{date('Y-m-d', strtotime('now'))}}" name="from_date_time" />
                </div>
                <div class="col-12">
                  <label class="form-label">To Date</label>
                  <input type="date" class="form-control" min = "{{date('Y-m-d', strtotime('now'))}}" name="to_date_time" />
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>

                </form>
              </div>
            </div>
           <div class="row">
              <div class="col-12 col-lg-12 col-xl-11 d-flex">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                     
                      <h6 class="mb-0">Unavailable Days</h6>
                      <div class="fs-5 ms-auto dropdown">
                         <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                           
                       </div>
                     </div>
                     <div class="table-responsive mx-auto mt-2">
                      <table class="table align-middle mb-0">
                        <thead class="table-light">
                          <tr>
                            <th>#ID</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                          <!-- <td colspan = 8 class="text-center">No record found</td> -->
                          @if($unavailables->count() > 0)
                            @php
                              $i = 0
                            @endphp
                            @foreach($unavailables as $unavailable)
                              @php
                                $i++
                              @endphp
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{date('Y-m-d', strtotime($unavailable->from_date_time))}}</td>
                            <td>{{date('Y-m-d', strtotime($unavailable->to_date_time))}}</td>
                            <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-warning" data-bs-toggle="modal" data-bs-target="#editUnavailable{{$unavailable->id}}" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal"><i class="bi bi-pencil-fill"></i></a>
                                <!-- Modal -->
                                <div class="modal fade" id="editUnavailable{{$unavailable->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Edit Unavailable</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <div class="col-md-8 col-lg-5 mx-auto">
                                        <div class="mt-5"></div>
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                          <ul></ul>
                                        </div>
                                        <form class="row g-3" method="post" action="{{Route('update_unavailable')}}">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$unavailable->id}}">
                                          <div class="col-12">
                                            <label class="form-label">From Date</label>
                                            <input type="date" class="form-control" min = "{{date('Y-m-d', strtotime('now'))}}" name="from_date_time" value="{{date('Y-m-d', strtotime($unavailable->from_date_time))}}">
                                          </div>
                                          <div class="col-12">
                                            <label class="form-label">To Date</label>
                                            <input type="date" class="form-control" min = "{{date('Y-m-d', strtotime('now'))}}" name="to_date_time" value="{{date('Y-m-d', strtotime($unavailable->to_date_time))}}">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          </div>
                          
                                          </form>
                                        </div>
                                      </div>
                                      
                                      
                                    </div>
                                  </div>
                                </div>
                                  <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete" onclick="deleteIncome({{$unavailable->id}})"><i class="bi bi-trash-fill"></i></a>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                         @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
           </div><!--end row-->
  
  


           <div class="card-body offset-md-4 offset-2">
                    {{ $unavailables->links() }}
                  </div>
  
            </main>
         <!--end page main-->

         <script>
           function deleteIncome(id) {
    swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover the record',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
            confirmButtonClass: 'confirm-class',
            cancelButtonClass: 'cancel-class',

        })
        .then((isConfirm) => {
            if (isConfirm.value) {
                $.ajax({
                    type: 'GET',
                    url: '{{Route("delete_unavailable")}}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id,
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Processing...',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            onOpen: () => {
                                swal.showLoading();
                            }
                        });
                    },

                    success: function(response) {

                        if (response.status == 1) {
                            swal("Success!", response.message, "success").then(function() {
                                location.reload();
                            });

                        } else {
                            swal("Error!", response.error, "error")
                        }

                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                        // stopLoader('body');
                    }
                });
            }
        });

}
         </script>

@endsection
