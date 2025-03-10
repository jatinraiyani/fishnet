<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Sign In - FishNet</title>

	<link rel="preconnect" href="http://fonts.gstatic.com/" crossorigin>
    <link href="{{asset('public/admin/css/corporate.css')}}" rel="stylesheet">

</head>

<body>
	<main class="main d-flex justify-content-center w-100">
		<div class="container d-flex flex-column">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="{{asset('public/admin/img/avatars/avatar.jpg')}}" alt="Chris Wood" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									{{Form::open(array('url'=>'admin/do-login','method'=>'post','name'=>'login'))}}
										@if(!empty($errors->all()))                
											@foreach($errors->all() as $error)                        
												<div class="alert alert-card alert-danger" role="alert">
													{{ $error }}                                    
												</div>
											@endforeach                
									    @endif
										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<small>
            
                                           </small>
										</div>
										
										<div class="text-center mt-3">											
											<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
										{{Form::close()}}
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{asset('public/admin/js/app.js')}}"></script>

</body>
</html>