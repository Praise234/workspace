<script>
document.getElementById("private_office").addEventListener('click', function (event) {
        event.preventDefault();
        $('#booking_date_modal').val($('#booking_date').val());
        $('#plan_modal').val($('#plan').val());
        $('#no_of_seats_modal').val($('#no_of_seats').val());
        $('#errorcoworkspace_modal').hide();
        $("#book_now_modal").css('display', "grid");
    });

    function availabilityCheck(){
        $.ajax({
            type: 'GET',
            url: '{{Route("check_coworkspace_availability")}}',
            data: {
                "_token": "{{ csrf_token() }}",
                'booking_date': $('#booking_date_modal').val(),
                'plan': $('#plan_modal').val(),
                'no_of_seats': $('#no_of_seats_modal').val(),
            },
            beforeSend: function() {
                $('#errorcoworkspace_modal').hide();
                $("#book_now_modal").hide();
                $("#loadingcoworkspace_modal").show();
            },

            success: function(response) {
                $("#loadingcoworkspace").hide();
                if (response.status == 1) {
                    $("#book_now_modal").css('display', "grid");
                    $("#loadingcoworkspace_modal").hide();
                } else {
                    $("#error_modal").html(response.error);
                    $('#errorcoworkspace_modal').show();
                    $("#loadingcoworkspace_modal").hide();
                }

            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
                // stopLoader('body');
            }
        });
    }
</script>
<!-- Modal -->
<div class="modal fade" id="co" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Book a space</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-8 col-lg-5 mx-auto">
                <div class="mt-5"></div>
                <div style="display:none; text-align:center; font-weight:bold;" id="errorcoworkspace_modal">
                    <p class="text-danger" id="error_modal"></p>
                </div>
                                
                <form class="row g-3" method="post" action="">
                    @csrf
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label fs-6">Name <span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <input type="text" class="form-control" name="cus_name" id="cus_name_modal" placeholder="Your Name" required="">
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-12">
                        <div class="mb-3">                                               
                            <label class="form-label fs-6">Date <span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <input type="date" onchange="availabilityCheck()" min = "{{date('Y-m-d', strtotime('now'))}}" class="form-control" name="booking_date" id="booking_date_modal" required="">
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label fs-6">Plan <span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <select name="plan" onchange="availabilityCheck()" id="plan_modal" class="form-control" required="">
                                    <option value="daily">Daily (#5000)</option>
                                    <option value="weekly">Weekly (#25000)</option>
                                    <option value="monthly">Monthly (#100000)</option>
                                </select>
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label fs-6">No of seats <span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <input type="number" onchange="availabilityCheck()" class="form-control" name="no_of_seats" id="no_of_seats_modal" placeholder="No of seats" value="1" required="">
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="modal-footer">
                    
                        <div class="spinner-border mt-2" style="display:none;" role="status" id="loadingcoworkspace_modal">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <button type="submit" class="btn btn-primary" id="book_now_modal">Book Now</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div>                
    </div>
</div>
</div>