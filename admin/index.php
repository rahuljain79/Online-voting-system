<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location:home.php');
  	}
	
?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<i class="far fa-eye" id="togglePassword"></i>
<script>
	const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script> -->
<?php include 'includes/header.php'; ?>

<body class="hold-transition login-page" style="background-color:#FFF5EE" >
<div class="login-box" style="background-color:#92a8d1 ;color:black ; font-size: 22px; font-family:Times">
  	<div class="login-logo" style="background-color: #92a8d1  ;color:black ; font-size: 22px; font-family:Times  ">
  		<b> <h3>Smart Voting System</b></h3>
  	</div>
  
  	<div class="login-box-body"style="background-color:#92a8d1 ;color:white ; font-size: 22px; font-family:Times  " >
    	<p class="login-box-msg" style="color:black ; font-size: 21px; font-family:Times  " >Sign in for Admin</p>

    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="Username" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row" style="display:inline-block">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-curve"style="background-color: #4682B4 ;color:black ; font-size: 15px; font-family:Times; width:20vh;"  name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
		</form>
			  <div class="row" style="display:inline-block">
    			<div class="col-xs-5">
          			<button type="Forgot Password?" onclick="location.href = 'forgot_password.php'" target="_blank" class="btn btn-primary btn-block btn-curve"style="background-color: #4682B4 ;color:black ; font-size: 15px; font-family:Times; width:25vh;"  name="login"><i class="fa fa-sign-in"></i> Forgot Password?</button>
        		</div>
      		</div>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>