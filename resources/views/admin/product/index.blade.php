@extends('layouts.admin')
@section('title')
FishNet | Product
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
                <h5 class="card-title">Product List</h5>
                <a class="btn btn-outline-success"
                    href="{{ URL::to('admin/product/create') }}">Add Product</a>
            </div>

            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Brands</th>
                            <th>Sizes</th>                            
                            <th>Price</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr id="product-{{$row->id}}">
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->product_type->name }}</td>
                                <td>{{ @$row->product_category->name }}</td>                                
                                <td>{{ @$row->product_subcategory->name }}</td>                                
                                <td> 
                                    @if($row->brand)                                  
                                    @foreach($row->brand  as $brands)
                                    <span class="sidebar-badge badge badge-warning">{{$brands}}</span>
                                    @endforeach
                                    @endif                                     
                                </td>
                                <td>
                                    @foreach($row->product_size as $size)
                                    <span class="sidebar-badge badge badge-secondary">{{$size->size_unit}} : {{$size->size}} | weight : {{$size->weight}} |Available : {{$size->size_available}}</span>
                                    @endforeach                                
                                </td>                                
                                <td>{{ $row->price }}</td>                               
                                
                        <td>
                        <a href="{{URL::to('admin/product/edit/'.$row->id.'')}}" class="btn btn-warning btn-sm">EDIT</a>
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
                    var productId = $(this).data('id');

                    $.ajax({
                        type: 'POST',
                        async: true,
                        dataType: "json",
                        url: "{{ URL::to('admin/product/delete') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            productId: productId
                        },
                        success: function (response) {
                            if (response == 'success') {

                                swal("Your Product is Deleted...!", {
                                    icon: "success",
                                });
                                $('#product-' + productId).hide();
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
