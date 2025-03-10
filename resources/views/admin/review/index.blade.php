@extends('layouts.admin')
@section('title')
FishNet | Review
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Review List</h5>                
            </div>

            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Review</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr id="review-{{ $row->id }}">
                                <td>{{ $row->review->name }}</td>
                                <td>{!! htmlspecialchars_decode($row->message) !!}</td>                                
                                <td>
                                <button data-id="{{$row->id}}" class="btn btn-danger btn-sm delete">DELETE</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(function () {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });

    // delete confirmation START

    $('body').on('click', '.delete', function (e) {

        e.preventDefault();

        swal({
                title: "Are you sure?",
                text: "You are about to permanently delete all it's contents.Type 'delete' to confirm",
                content: "input",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["Cancel", "Delete"],
            })
            .then((value) => {
                if (value == 'delete') {

                    // STRAT AJAX DELETE 
                    var reviewId = $(this).data('id');

                    $.ajax({
                        type: 'POST',
                        async: true,
                        dataType: "json",
                        url: "{{ URL::to('admin/review/delete') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            reviewId: reviewId
                        },
                        success: function (response) {
                            if (response == 'success') {

                                swal("Review is Deleted...!", {
                                    icon: "success",
                                });
                                $('#review-' + reviewId).hide();
                            } else {

                                swal("Something went wrong...!", {
                                    icon: "warning",
                                });

                            }
                        }
                    });
                    // END AJAX DELETE 

                } else {
                    swal("Please write 'delete' same as above.");
                }
            });
    });

    // delete Confirmation END

</script>


@endsection
