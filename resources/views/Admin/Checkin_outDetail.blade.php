@extends('Admin.layout.main')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/cs/style2.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}

  {{-- <p>Date: <input type="text" id="datepicker" onchange="dateFilter();"></p> --}}
  <div class="container ">
    <h4>Checkin Checkout list</h4>
      <p>Date: <input type="text" id="datepicker" onchange="dateFilter()"></p>

<table id="example" class="table table-striped" style="width:100%">



 <input type="hidden" value="{{csrf_field()}}">

        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>mobile_number</th>
                <th>checkin date</th>
                <th >Action</th>

            </tr>
        </thead>
        <tbody class="data">
            @foreach($data as $key=>$row)

            <tr>

                <td>{{$row->id}} </td>
                <td>{{$row->name}}</td>
                <td>{{$row->mobile_number}}</td>
                <td>{{date('Y-m-d',strtotime($row->getCheckinoutDetail->date))}}</td>
                <td>
                    {{-- <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    Launch demo modal
                </button> --}}
                <div  class="btn btn-sm edit-modal"  data-id=' {{$row->id}}' name='.$-> name .'> <button type="button" class="btn btn-primary" > View Details</button></div>
                <div class="delete-modal btn  btn-sm" data-id='{{$row->id}}'  id="deletecategory1" name='.$row->name.'><i class="fa fa-trash" aria-hidden="true"></i></div></td>

            </tr>

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
                <button type="submit" value class="btn btn-info " id="category_delete1">Confirm</button>
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
            @endforeach
        </tbody>

    </table>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

</body>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

<script>$(document).ready(function () {
    $('#example').DataTable();
});

function dateFilter(){
    var date=$('#datepicker').val();
    var _token = $('input[name="_token"]').val();

	$.ajax({
	url:"{{ route('datepickers') }}",
	method:"GET",
	data:{
         "date"  :date,
         "_token":_token
        },
	dataType: "json",
	success:function(data)
	{
        $(".data").html("");
		$(".data").html(data.data);

	}
	});
}
</script>
 <script>
     $(document).on("click", ".delete-modal", function(e) {
    var delete_id = $(this).data('id')
    ;


    $('#category_id').val(delete_id);
    $('#myModal').modal('show');
});

$(document).on("click", "#category_delete1", function(e) {
     var service_provider_id = $('#category_id').data('id');
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
                    var service = data.get_checkinout_detail;
                    console.log(service);

                    if (data.profile_pic) {
                        var imagee = "http://18.119.37.224/" + data.profile_pic;
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
                    var checkindetail = data.get_checkinout_detail;
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
                        '</strong></label><label for="floatingInput"><strong><services><p>Ckeckout Time&nbsp;&nbsp;: &nbsp;&nbsp' +
                            checkindetail.checkout_time +
                        '</strong></label>';
                    $('#checkin_details').html(checkin_dt);

                }
});
        })


</script>


@endsection


