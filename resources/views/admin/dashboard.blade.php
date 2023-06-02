@extends('admin.layout')

@section('thecontent')
<!--start content-->
<main class="page-content">

            
    <div class="row">
        <div class="col-12 col-lg-10 col-xl-10 d-flex mx-auto">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <h6 class="mb-0"><a href="{{ URL::to('administrator/confirm_booking')}}">Bookings</a></h6>
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
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-12 col-lg-10 col-xl-10 d-flex mx-auto">
                <div class="card radius-10 w-100">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <h6 class="mb-0">Products</h6>
                      <div class="fs-5 ms-auto dropdown">
                         <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                           
                       </div>
                     </div>
                     <div class="table-responsive mt-2">
                      <table class="table align-middle mb-0">
                        <thead class="table-light">
                          <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Total Slots</th>
                            <!-- <th>Available Slots Today</th> -->
                            <th>Price</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                          <!-- <td colspan = 6 class="text-center">No record found</td> -->
                         
                          @foreach($products as $product)
                          <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                @switch ($product->name) 
                                    @case ('coworkspace')
                                        {{"COWORKSPACE"}}
                                        @break
                                    @case ('private_offices')
                                        {{"PRIVATE OFFICE"}}
                                        @break
                                    @case ('meeting_room')
                                        {{"MEETING ROOM"}}
                                        @break
                                    @case ('virtual_office')
                                        {{"VIRTUAL OFFICE"}}
                                        @break
                                    @case ('children_playroom')
                                        {{"CHILDREN PLAYROOM"}}
                                        @break
				    @case ('coworkspace_weekly')
					{{"COWORKSPACE WEEKLY"}}
					@break
				    @case ('coworkspace_monthly')
                                        {{"COWORKSPACE MONTHLY"}}
                                        @break

                                    @default
                                        {{"EVENT SPACE"}}
                                        @break
                                @endswitch
                            </td>
                            <td>{{$product->total_slots}}</td>
                            <!-- <td></td> -->
                            <td>#{{$product->price . ".00"}}</td>
                            <td>
                              <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-dark ms-3" data-bs-toggle="modal" data-bs-target="#viewProduct{{$product->id}}" title="" data-bs-original-title="Edit info" aria-label="Edit"  data-bs-toggle="modal" data-bs-target="#viewTruck"><i class="bi bi-eye-fill"></i></a>
                                 <!-- Modal -->
                                 <div class="modal fade" id="viewProduct{{$product->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Product: {{$product->name}}</h5>
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
                                                  <td>
                                                  @switch ($product->name) 
                                                    @case ('coworkspace')
                                                        {{"COWORKSPACE"}}
                                                        @break
                                                    @case ('private_offices')
                                                        {{"PRIVATE OFFICE"}}
                                                        @break
                                                    @case ('meeting_room')
                                                        {{"MEETING ROOM"}}
                                                        @break
                                                    @case ('virtual_office')
                                                        {{"VIRTUAL OFFICE"}}
                                                        @break
                                                    @case ('children_playroom')
                                                        {{"CHILDREN PLAYROOM"}}
                                                        @break
                                                     @case ('coworkspace_weekly')
			                                   {{"COWORKSPACE WEEKLY"}}
                        			           @break
                                                     @case ('coworkspace_monthly')
                                      			    {{"COWORKSPACE MONTHLY"}}
                                                            @break

                                                    @default
                                                        {{"EVENT SPACE"}}
                                                        @break
                                                  @endswitch
                                                  </td>
                                                </tr>
                                                <tr class="text-center">
                                                  <td>Total Slots</td>
                                                  <td>{{$product->total_slots}}</td>
                                                </tr>
                                                <!-- <tr class="text-center">
                                                  <td>Available Slots Today</td>
                                                  <td>
                                                   
                                                  </td>
                                                </tr> -->
                                                <tr class="text-center">
                                                  <td>Price</td>
                                                  <td>#{{$product->price . ".00"}}</td>
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
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end row-->
        </main>
        <!--end page main-->



@endsection
