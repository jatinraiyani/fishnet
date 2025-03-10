@extends('layouts.admin')
@section('title')
FishNet | Net Type
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
                <h5 class="card-title">Net Type List</h5>
                <a class="btn btn-outline-success"
                    href="{{ URL::to('admin/type/create') }}">Add Type</a>
            </div>

            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Type Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>@if(file_exists(storage_path('app/public/type/'.$row->image)) && $row->image
                                    != '')
                                    <img src="{{ URL::to('storage/app/public/type/'.$row->image) }}"
                                        class="rounded avatar-sm" alt="banner" height="100px" weight="100px">
                                @else
                                    <img src="{{ URL::to('storage/app/public/default/default_user.jpg') }}"
                                        class="rounded avatar-sm" alt="banner">
                        @endif
                        </td>
                        <td><a href="{{URL::to('admin/type/edit/'.$row->id.'')}}" class="btn btn-warning btn-sm">EDIT</a></td>
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
<script type="text/javascript">
    $(function () {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });

</script>
@endsection
