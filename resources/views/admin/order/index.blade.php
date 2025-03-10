@extends('layouts.admin')
@section('title')
FishNet | Order
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/admin/css/ekko-lightbox.css')}}"/>
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
                <h5 class="card-title">Order List</h5>                
            </div>

            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Order Number</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>PaymentBy</th>
                            <th>Payment Status</th> 
                            <th>Contact</th>                           
                            <th>Address</th>                           
                            <th>Payment Slip</th>
                            <th>View Order</th>
                            <th>Order Status</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr id="order-{{$row->id}}">
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->ordernumber }}</td>
                                <td>{{ date('d F, Y', strtotime($row->created_at)) }}</td>
                                <td>{{ number_format($row->grand_total,2) }}</td>                                
                                <td>{{ $row->payment_method }}</td>                                
                                <td>{{ $row->payment_status }}</td>                                
                                <td>{{ @$row->delivery_address->contact }}</td>                                
                                <td>{{ @$row->delivery_address->address }}</td>                                
                                <td>
                                    @if($row->payment_method == 'banktransfe r' || $row->payment_method == 'angadia')
                                       @if(!empty($row->slip) && file_exists(storage_path('app/public/slip/'.$row['slip'])))
                                       <a href="{{ asset('storage/app/public/slip/'.$row->slip) }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                                       <img src="{{ asset('storage/app/public/slip/'.$row->slip) }}" width="50px" height="50px" alt="">
                                       </a>
                                       @else
                                       <img src="{{ asset('storage/app/public/slip/not-available.png') }}" width="50px" height="50px" alt="product">
                                       @endif 
                                    @else
                                    No Need    
                                    @endif
                                </td>
                                <td id="order-status-{{ $row->id }}" style="cursor: pointer;">
                                    @if($row->order_status == 'pending_for_call')
                                        <span class="badge badge-success order-status" data-status="ready_for_pay" data-order="{{ $row->id }}">ACCEPT</span>
                                        <span class="badge badge-danger order-status" data-status="cancel" data-order="{{ $row->id }}">CANCEL</span>
                                    @elseif($row->order_status == 'ready_for_pay')
                                        <span class="badge badge-info">READY FOR PAY</span>                                                                          
                                    @elseif($row->order_status == 'pending')
                                        <span class="badge badge-success order-status" data-status="confirm" data-order="{{ $row->id }}">CONFIRM</span>
                                        <span class="badge badge-danger order-status" data-status="slip_refuse" data-order="{{ $row->id }}">CANCEL</span>
                                    @elseif($row->order_status == 'confirm')
                                        <span class="badge badge-success">CONFIRMED</span>
                                    @elseif($row->order_status == 'slip_refuse')
                                        <span class="badge badge-danger">CANCELD</span>
                                        <span class="badge badge-success order-status" data-status="confirm" data-order="{{ $row->id }}">CONFIRM</span>
                                    @elseif($row->order_status == 'cancel')
                                        <span class="badge badge-danger">CANCELED</span>
                                    @else
                                        <span class="badge badge-info">{{ $row->order_status }}</span>
                                    @endif
                                </td>
                                <td><a href="{{URL::to('admin/order/view/'.$row->id)}}">VIEW</a></td>
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
<script src="{{asset('public/admin/js/ekko-lightbox.min.js')}}"></script>
<script type="text/javascript">

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });

    $(function () {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });

    // delete confirmation START

    $('body').on('click', '.order-status', function (e) {

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
                    let order = $(this).data('order');
                    let status = $(this).data('status');

                    $.ajax({
                        type: 'POST',
                        async: true,
                        dataType: "json",
                        url: "{{ URL::to('admin/order/change-status') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            order: order,
                            status: status
                        },
                        success: function (response) {
                            let lable = '';

                        if(response == 'pending') {
                            $('#order-status-'+order).html('');
                            lable += '<span class="badge badge-info">READY FOR PAY</span>';
                            $('#order-status-'+order).html(lable);
                        } 

                        if(response == 'confirmed') {
                            $('#order-status-'+order).html('');
                            lable += '<span class="badge badge-success">CONFIRMED</span>';
                            $('#order-status-'+order).html(lable);
                        } 

                        if(response == 'refused'){
                            $('#order-status-'+order).html('');
                            lable += '<span class="badge badge-danger">CANCELD</span>';
                            lable += '<span class="badge badge-success order-status" data-status="confirm" data-order="'+order+'">CONFIRM</span>';
                            $('#order-status-'+order).html(lable);
                        }

                        if(response == 'canceled'){
                            $('#order-status-'+order).html('');
                            lable += '<span class="badge badge-danger">CANCELD</span>';                           
                            $('#order-status-'+order).html(lable);
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
