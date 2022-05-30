<!DOCTYPE html>
<html>
<head>
	<title>
		APPARD | Login
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="/bootstrap431/css/bootstrap.min.css">
	<script defer src="/fontawesome5.8.2/js/all.js"></script>
	<!-- table data biat keren -->
	<link rel="stylesheet" type="text/css" href="/datatable/datatables.min.css">

</head>
<body>
	<div class="bg-dark text-white text-center border-bottom">
		<br>
		<div class="row">
			<div class="text-center col-md-6 ">
				<img src="logodrd.svg" width="150px" height="150px">				
			</div>
			<div class="border-left container col-md-6 col-sm-3 text-left">
				<h3 class="display-4"> DRD</h3>
				<h5 class="lead"> Aplikasi Pengelolaan Administrasi Rapat <br> Dewan Riset Daerah<br>  Pada Kabupaten Pesawaran</h5>
				
			</div>
		</div>
		<br>
	</div>
	<div class="row bg-light" id="wrapper" >		
		<div class="col-md-6 border-right ">
			<img src="loginilustrasi.svg" class="img-circle" alt="Ilustrasi Login" width="500px" height="500px">
			<img src="">
			
		</div>
		<div class="col-md-6 bg-white container" >

			<br>
			<form method="post" action="" class="needs-validation">
				{{ csrf_field() }}
			  	<div class="col-md-8  container">
			  		<br>
			  		<h4 class="lead">Login ke aplikasi !</h4>
			  		<hr>
			  		@if(session('danger'))
					<div class="alert alert-danger" role="alert">
						{{session('danger')}}
					</div>
					@endif
			  		<br>
			  		<div class="input-group mb-3">
			  			<input type="email" name="email" maxlength="100" required="required" class="form-control" placeholder="Email*">
			  			<div class="input-group-append">
			  				<button class="btn btn-primary" type="button" >
			  					<i class="far fa-envelope"></i>
			  				</button>
			  				
			  			</div>
			  		</div>
			  		<div class="input-group mb-3">
			  			<input type="password" name="password" maxlength="255" required="required" class="form-control" placeholder="Password*">
			  			<div class="input-group-append">
			  				<button class="btn btn-primary" type="button" >
			  					<i class="fas fa-lock"></i>
			  				</button>			  				
			  			</div>
			  		</div>
			  		<div class="input-group">
			  			<input type="submit" name="login" value="Login" class="btn btn-primary btn-block" >
			  		</div>
			  		<br>
			  	</div>

			</form>
		</div>
	</div>

	<!-- Footer -->
    <div class="bg-dark text-white col-md-12" style="bottom: 0;">
    	<!-- copyright -->
    	<div class="text-center py-5">
    		© 2019 Copyright : <a href="https://igedearya.web.id">Igedearya.web.id</a>
    	</div>
    	<!-- /copyright -->
    </div> 
    <!-- /Footer -->

</body>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/datatable/datatables.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>