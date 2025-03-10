@extends('layouts.admin')
@section('title')
FishNet | Order
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/admin/css/ekko-lightbox.css')}}"/>
@endsection
@section('content')
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Invoice</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body m-sm-3 m-md-5">
									<!-- <div class="mb-4">
										Hello <strong>Chris Wood</strong>,
										<br /> This is the receipt for a payment of <strong>$268.00</strong> (USD) you made to AppStack.
									</div> -->

									<div class="row">
										<div class="col-md-6">
											<div class="text-muted">Order No.</div>
											<strong>{{strtoupper($order_detail->ordernumber)}}</strong>
										</div>
										<div class="col-md-6 text-md-right">
											<div class="text-muted">Order Date</div>
											<strong>{{$order_detail->created_at}}</strong>
										</div>
									</div>

									<hr class="my-4" />

									<div class="row mb-4">
										<div class="col-md-6">
											<div class="text-muted">Buyer Details</div>
                                                <strong>
                                                    {{ $order_detail->delivery_address->name}}
                                                </strong>
                                                <p>
                                                 Contact : {{ $order_detail->delivery_address->contact}}<br>
                                                 Address : {{ $order_detail->delivery_address->address }},<br>
                                                 {{ $order_detail->delivery_address->city }},{{ $order_detail->delivery_address->state }},{{ @$order_detail->delivery_address->zipcode }},<br>
                                                    <a href="mailto:{{$user->email}}">
                                                    {{$user->email}}
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-md-right">
                                                <div class="text-muted">Payment Details</div>
                                                <p>
                                                    Payment Type : <strong>{{$order_detail->payment_method}}</strong><br>
                                                    Payment Status : <strong>{{$order_detail->payment_status}}</strong><br>
                                                    Order Status : <strong>{{$order_detail->order_status}}</strong>
											    </p>
										    </div>
									</div>

									<table class="table table-sm">
										<thead>
											<tr>
												<th>Item</th>
												<th>Size</th>
												<th>Quantity</th>
												<th class="text-right">Amount</th>
											</tr>
										</thead>
										<tbody>
                                        
                                            @foreach($order_detail->order_product as $product_row)
											<tr>
												<td>{{ $product_row->product_name }}</td>
												<td>{{ str_replace('-',' ',$product_row->size) }}</td>
												<td>{{ $product_row->qty }}</td>
												<td class="text-right">₹ {{ number_format($product_row->price,2) }}</td>
											</tr>											
                                            @endforeach
											<tr>
												<th>&nbsp;</th>
												<th>&nbsp;</th>
												<th>SubTotal</th>
												<th class="text-right">₹ {{ number_format($order_detail->subtotal,2) }}</th>
											</tr>
											<tr>
												<th>&nbsp;</th>
												<th>&nbsp;</th>
												<th>Total </th>
												<th class="text-right">₹ {{ number_format($order_detail->grand_total,2) }}</th>
											</tr>
                                       
										</tbody>
									</table>

									<div class="text-center">
										<!-- <p class="text-sm">
											<strong>Extra note:</strong> Please send all items at the same time to the shipping address. Thanks in advance.
										</p> -->
										<a class="btn btn-primary" onclick="javascript:window.print();">Print this receipt</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
@endsection
@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('public/admin/js/ekko-lightbox.min.js')}}"></script>
<script type="text/javascript">

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    }); 

</script>
@endsection
