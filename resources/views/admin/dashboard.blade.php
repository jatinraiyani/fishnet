@extends('layouts.admin')
@section('title')
FishNet | Dashboard
@endsection
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('message'))
                {!! Session::get('message') !!}
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-xl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <span class="badge badge-primary float-right">Today</span>
                    <h5 class="card-title mb-0">Income</h5>
                </div>
                <div class="card-body my-2">
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                $37.500
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span class="text-muted">57%</span>
                        </div>
                    </div>

                    <div class="progress progress-sm shadow-sm mb-1">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 57%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <span class="badge badge-warning float-right">Annual</span>
                    <h5 class="card-title mb-0">Orders</h5>
                </div>
                <div class="card-body my-2">
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                3.282
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span class="text-muted">82%</span>
                        </div>
                    </div>

                    <div class="progress progress-sm shadow-sm mb-1">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 82%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <span class="badge badge-info float-right">Monthly</span>
                    <h5 class="card-title mb-0">Activity</h5>
                </div>
                <div class="card-body my-2">
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                19.312
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span class="text-muted">64%</span>
                        </div>
                    </div>

                    <div class="progress progress-sm shadow-sm mb-1">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 64%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <span class="badge badge-success float-right">Yearly</span>
                    <h5 class="card-title mb-0">Revenue</h5>
                </div>
                <div class="card-body my-2">
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 font-weight-light">
                                $82.400
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span class="text-muted">32%</span>
                        </div>
                    </div>

                    <div class="progress progress-sm shadow-sm mb-1">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 32%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
