@extends('layouts.admin')
@section('title')
FishNet | Change Password
@endsection
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Change Password</h1>

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
                    {{ Form::open(array('url'=>'admin/update/password','method'=>'POST')) }}
                      @csrf
                    <div class="form-group">
                        <label class="form-label">Old Password</label>
                        {{Form::password('password',array('class'=>$errors->has('password') ?'form-control is-invalid' : 'form-control','placeholder'=>'Enter Current Password','required'))}}
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        {{Form::password('newPassword',array('class'=>$errors->has('newPassword') ?'form-control is-invalid' : 'form-control','Placeholder'=>'Enter New Password','required'))}}                        
                    </div> 
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        {{Form::password('newPassword_confirmation',array('class'=>$errors->has('newPassword_confirmation') ?'form-control is-invalid' : 'form-control','placeholder'=>'Enter Confirm Password','required'))}}
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>                    
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
