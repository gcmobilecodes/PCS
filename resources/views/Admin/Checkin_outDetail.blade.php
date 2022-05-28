@extends('Admin.layout.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/cs/style2.css') }}">

    <div class="container">

        <h4>Checkin_out_list</h4>

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Contact number</th>
                    <th width="100px">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action
                    </th>


                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!---- delete model -------------->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title"></h4>
                </div>
                <input type="hidden" name="category_id" id="category_id" value="">
                <div class="modal-body">
                    <form method="POST" action="{{ url('/delete/service_provider') }}">
                        @csrf
                        <p>Are you Sure you want Delete this service_provider?.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info " id="category_delete1">Confirm</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Checkin checkout detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                    <div class="modal-body">
                    <p class="edit_category"></p>
                    <div id="uploads">


                    </div>
                    <div id="uploads">
                    </div>
                    <div id="checkin_details">

                    </div>
                    <div id="checkout_details">

                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="vendorview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail of the service-provider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <p class="show_detail">
                            <tbody>
                                <strong></strong>
                            </tbody>
                            </table>



                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    </body>

    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('userslists') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },



                ]
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".alert").delay(4000).slideUp(300);
            $('.message').hide();

        });
        $(document).on("click", ".delete-modal", function(e) {
            var delete_id = $(this).data('id');
            $('#category_id').val(delete_id);
            $('#myModal').modal('show');
        });

       $(document).on("click", "#category_delete1", function(e) {
             var service_provider_id = $('#category_id').val();
            $.ajax({
                type: 'POST',
                url: '{{ url('/delete/service_provider') }}',
                data: {
                    id: service_provider_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#myModal').modal('hide');
                    $('.edit_category').append('<div class="alert alert-success message">' + data +
                        '</div>');
                    $(".message").delay(4000).slideUp(300);
                    var oTable = $('.categoryTable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        });
        $(document).on("click", ".edit-modal", function(e) {
            var category_id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.serviceProvider') }}',
                data: {
                    id: category_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    console.log(data);
                    var service = data.getCheckoutDetail;
                    console.log(service);

                    if (data.profile_pic) {
                        var imagee = "http://127.0.0.1:8000" + data.profile_pic;
                        console.log(imagee);

                    } else {
                        var imagee = "";



                    }
                    $('#editCategory').modal('show');
                    $('.edit_category').html(

                        '<label for="floatingInput"><strong><img src="' + imagee +
                        '" style="height:100px; width:100px;"></label><br><label for="floatingInput"><strong><p>id&nbsp;&nbsp;:&nbsp;&nbsp' +
                        data.id +
                        '</p></strong></label><br><label for="floatingInput"><p>Name&nbsp;&nbsp;:&nbsp;&nbsp ' +
                        data.name +
                        '</p></strong></label><br><label for="floatingInput"><strong><p>Contact No&nbsp;&nbsp;:&nbsp;&nbsp' +
                        data.mobile_number +
                        '</p></strong></label><br><label for="floatingInput"><strong><p>Employee_id&nbsp;&nbsp;:&nbsp;&nbsp' +
                        data.employee_id +
                        '</p></strong></label></html>'
                    );
                    var checkindetail = data.get_checkin_detail;
                    // console.log(checkindetail);
                    // if(!empty(checkindetail)){
                    var checkin_dt = "";
                     // if(!empty(checkindetail)){

                    checkin_dt +=
                        '<label for="floatingInput"><strong><services><p>user_id&nbsp;&nbsp;: &nbsp;&nbsp ' +
                         checkindetail.user_id +
                        '</strong><label for="floatingInput"><strong><services><p>Restaurant Name&nbsp;&nbsp;: &nbsp;&nbsp ' +
                            checkindetail.Restaurant_name +
                        '</strong></label><label for="floatingInput"><strong><services><p>Checkin Date&nbsp;&nbsp;: &nbsp;&nbsp' +
                            checkindetail.date +
                        '</strong></label><label for="floatingInput"><strong><services><p>Ckeckin Time&nbsp;&nbsp;: &nbsp;&nbsp' +
                            checkindetail.checkin_time +
                        '</strong></label>';
                    $('#checkin_details').html(checkin_dt);
                    var checkoutdetail = data.get_checkout_detail;
                    console.log(checkoutdetail);
                    var checkout_dt = "";
                    checkout_dt +=  '<label for="floatingInput"><strong><services><p>Ckeckout Date&nbsp;&nbsp;: &nbsp;&nbsp' +
                            checkoutdetail.date +
                        '</strong><label for="floatingInput"><strong><services><p>Ckeckout Time&nbsp;&nbsp; :&nbsp;&nbsp' +
                         checkoutdetail.checkout_time +
                        '</strong></label>';
                        $('#checkout_details').html(checkout_dt);

                   // }
                    // else{
                    //     check_dt ="";
                    //     }

 }



            });
        })
    </script>
@endsection
