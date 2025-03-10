@extends('layouts.admin')
@section('title')
FishNet | ContactUs
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
                <h5 class="card-title">ContactUs List</h5>                
            </div>

            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr id="contact-{{ $row->id }}">
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->contact }}</td>
                                <td>{!! htmlspecialchars_decode($row->message) !!}</td>                                
                                <td id="contact-status-{{ $row->id }}" style="cursor: pointer;">
                                    @if($row->status == 'pending')
                                    <span class="badge badge-warning contact-status" data-status="done" data-contact="{{ $row->id }}">Pending</span>
                                    @else
                                    <span class="badge badge-success">Done</span>
                                    @endif
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

    $('body').on('click', '.contact-status', function (e) {

    e.preventDefault();       

        swal({
            title: "Are you sure?",
            text: "You are about to change status change.Type 'change' to confirm",
            content: "input",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ["Cancel", "change"],
        })
        .then((value) => {
            if (value == 'change') {

                // STRAT AJAX DELETE 
                let contact = $(this).data('contact');
                let status = $(this).data('status');

                $.ajax({
                    type: 'POST',
                    async: true,
                    dataType: "json",
                    url: "{{ URL::to('admin/contactus/change-status') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        contact: contact,
                        status: status
                    },
                    success: function (response) {
                        let lable = '';

                        if(response == 'done') {
                            $('#contact-status-'+contact).html('');
                            lable += '<span class="badge badge-success">Done</span>';
                            $('#contact-status-'+contact).html(lable);
                        } 

                    }   
                });
                // END AJAX DELETE 

            } else {
                swal("Please write 'change' same as above.");
            }
    });
    });  

// delete Confirmation END


</script>


@endsection
