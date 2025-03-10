@extends('layouts.admin')
@section('title')
FishNet | AdBanner
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
                <h5 class="card-title">AdBanner List</h5>
                <a class="btn btn-outline-success"
                    href="{{ URL::to('admin/promobanner/create') }}">Add AdBanner</a>
            </div>

            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr id="adbanner-{{$row->id}}">
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->title }}</td>
                                <td>@if(file_exists(storage_path('app/public/promobanner/'.$row->image)) && $row->image
                                    != '')
                                    <img src="{{ URL::to('storage/app/public/promobanner/'.$row->image) }}"
                                        class="rounded avatar-sm" alt="promobanner" height="100px" weight="100px">
                                @else
                                    <img src="{{ URL::to('storage/app/public/default/default_user.jpg') }}"
                                        class="rounded avatar-sm" alt="banner">
                        @endif
                        </td>
                        <td>
                            <a href="{{URL::to('admin/promobanner/edit/'.$row->id.'')}}" class="btn btn-warning btn-sm">EDIT</a>
                            <button class="btn btn-danger btn-sm delete" data-id="{{ $row->id }}">DELETE</button>
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
                var adbannerId = $(this).data('id');

                $.ajax({
                    type: 'POST',
                    async: true,
                    dataType: "json",
                    url: "{{ URL::to('admin/promobanner/delete') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        adbannerId: adbannerId
                    },
                    success: function (response) {
                        if (response == 'success') {

                            swal("Your Banner is Deleted...!", {
                                icon: "success",
                            });
                            $('#adbanner-' + adbannerId).hide();
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
