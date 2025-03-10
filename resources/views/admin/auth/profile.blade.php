@extends('layouts.admin')
@section('title')
FishNet | Profile
@endsection
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Edit Profile</h1>

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    @if(!empty($errors->all()))                
                        @foreach($errors->all() as $error)                        
                            <div class="alert alert-card alert-danger" role="alert">
                                {{ $error }}                                    
                            </div>
                        @endforeach                
                    @endif
                </div>                
                <div class="card-body">
                    {{ Form::open(array('url'=>'admin/update/profile','method'=>'POST','name'=>'update-user','files'=>'true')) }}
                      @csrf
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{$data->name}}" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact</label>
                        <input type="text" name="contact" value="{{$data->contact}}" class="form-control" id="contact" minlength="10" maxlength="10" placeholder="Contact">
                        &nbsp;<span id="errmsg"></span>
                    </div>
                    <div class="card-body text-center">
                        @if(!empty($data->profile))
                        <img src="{{ asset('storage/app/public/user/'.$data->profile) }}"
                            alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        @else
                        <img src="{{ asset('storage/app/public/user/avatar.jpg') }}"
                            alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        @endif                        
                        <div class="text-muted mb-2"><small class="text-muted">Current Profile Photo</small></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label w-100">Change Profile Photo</label>
                        <input type="file" name="profile">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-danger" href="{{URL::to('admin/edit/password')}}">Change Password</a>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

    // allow only numbers in contact START
	$("#contact").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
	// allow only numbers in contact END

</script>    
@endsection
