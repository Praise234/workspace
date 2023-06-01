@extends('admin.layout')

@section('addInc')


<!--start content-->

<main class="page-content">
              
              <div class="col-md-8 col-lg-5 mx-auto mb-5">
              <div class="mt-3"></div>
                <h6 class="mb-0 text-uppercase">Add New Income</h6>
                <hr/>
                <div class="alert alert-danger print-error-msg" style="display:none">
                  <ul></ul>
                </div>
                <form class="row g-3" method="post" action="confirm_booking_search">
                  @csrf
                  <div class="col-12">
                    <label class="form-label">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" value = "{{$old->customer_name ?? ''}}">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Products</label>
                    <select class="form-select mb-3" aria-label="Product" name="products">
                      <option selected>Products</option>
                      @foreach($products as $product)
                        @php
                        switch ($product->name) {
                              case 'coworkspace':
                                  $prod_name = "COWORKSPACE";
                                  break;
                              case 'private_offices':
                                  $prod_name = "PRIVATE OFFICE";
                                  break;
                              case 'meeting_room':
                                  $prod_name = "MEETING ROOM";
                                  break;
                              case 'virtual_office':
                                  $prod_name = "VIRTUAL OFFICE";
                                  break;
                              case 'children_playroom':
                                  $prod_name = "CHILDREN PLAYROOM";
                                  break;
                              
                              default:
                                  $prod_name = "EVENT SPACE";
                                  break;
                          }
                        @endphp
                        <option value="{{$product->name}}">{{ $prod_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Date Of Payment</label>
                    <input type="date" class="form-control" name="date_paid">
                  </div>
                  
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Check</button>
                    </div>
                  </div>
                </form>
                </div>





                <div class="row">
              <div class="col-12 col-lg-12 col-xl-11 d-flex mx-auto">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <h6 class="mb-0">Trucks</h6>
                      <div class="fs-5 ms-auto dropdown">
                         <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                           
                       </div>
                     </div>
                     <div class="table-responsive mt-2">
                     <table class="table align-middle mb-0 text-center">
                        <thead class="table-light">
                          <tr>
                            <th>#ID</th>
                            <th>Customer Name</th>
                            <th>Product</th>
                            <th>Amount Paid</th>
                            <th>Duration</th>
                            <th>Quantity</th>
                            <th>Booked Date/Time</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if($bookings->count() < 1)
                            <tr><td colspan="9">No record found</td></tr>
                          @else
               
                          <!-- <td colspan = 7 class="text-center">No record found</td> -->
                         @foreach($bookings as $booking)
                          <tr>
                            <td>{{$booking->id}}</td>
                            <td>{{$booking->customer_name}}</td>
                            <td>{{$booking->product}}</td>
                            <td>#{{$booking->amount_paid . ".00"}}</td>
                            <td>{{$booking->duration}}</td>
                            <td>{{$booking->quantity}}</td>
                            <td>{{$booking->booked_date_time}}</td>
                            <td>{{$booking->created_at}}</td>
                            <td>
                              <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-dark mx-auto" data-bs-toggle="modal" data-bs-target="#viewTruck{{$booking->id}}" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal" data-bs-target="#viewTruck"><i class="bi bi-eye-fill"></i></a>
                                <!-- Modal -->
                                <div class="modal fade" id="viewTruck{{$booking->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Product: {{$booking->product}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="col-md-8 col-lg-5 mx-auto">
                                          <div class="mt-5"></div>
                                          <div class="table-responsive mt-2">
                                            <table class="table align-middle mb-0">
                                              <thead class="table-light">
                                                <tr class="text-center">
                                                  <th></th>
                                                  <th></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr class="text-center">
                                                  <td>Product</td>
                                                  <td>{{$booking->product}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Amount Paid</td>
                                                  <td>#{{$booking->amount_paid . ".00"}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Duration</td>
                                                  <td>
                                                    @if($booking->duration == 1)
                                                      {{'hourly'}}
                                                    @elseif($booking->duration == 2)
                                                      {{'daily'}}
                                                    @elseif($booking->duration == 3)
                                                      {{'weekly'}}
                                                    @else
                                                      {{'monthly'}}
                                                    @endif
                                                  </td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Quantity</td>
                                                  <td>{{$booking->quantity}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Booked Date/Time</td>
                                                  <td>{{$booking->booked_date_time}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Payment Date</td>
                                                  <td>{{$booking->created_at}}</td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>                             
                            </div>
                            </td>
                          </tr>
                          @endforeach
                          @endif
                        </tbody>
                      </table>
                      <div class="block-content mt-3 float-end">
                        <nav aria-label="Page navigation ">
                        {{ $bookings->links() }}
                        </nav>
                      </div>
                    </div>
                    
                       
                  </div>
                </div>
              </div>
           </div><!--end row-->
  
           

      
            </main>
         <!--end page main-->


@endsection
