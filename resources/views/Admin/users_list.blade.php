
@extends('Admin.layout.main')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/cs/style2.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>

<div class="container ">
    <h4>Users List</h4>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th class="action_heads" width="100px">Action</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
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
                <form method="POST" action="{{url('/delete/users')}}">
                    @csrf
              <p>Are you Sure you want Delete this Catgory?.</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info " id="category_delete">Confirm</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
          </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</div>
<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('users.index') }}",

          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'mobile_number', name: 'mobile_number'},
              {data: 'action', name: 'action', orderable: false,
                        searchable: false},



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

    $(document).on("click", "#category_delete", function(e) {
        var category_id = $('#category_id').val();
        $.ajax({
            type: 'POST',
            url: '{{ url('/delete/users') }}',
            data: {
                id: category_id
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
    $(document).on("click", ".close_category", function(e) {
        $('#editCategory').modal('hide');

    });

</script>
  @endsection

