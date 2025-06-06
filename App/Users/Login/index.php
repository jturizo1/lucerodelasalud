<!DOCTYPE html>
<html lang="en">
<head>
	<title>Inicio de Sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php
session_start();
include '../../BD_Con/str_conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM users WHERE username='$username' AND passwordkey='$password'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 1) 
			{
				$_SESSION['user'] = $username;
				header("Location: Dashboard.php");
			} 
		else 
			{
				$error = "¡Nombre de Usuario o Password Incorrectos!";
			}
	}
?>	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="$_POST">
					<span class="login100-form-logo">
						<!--i class="zmdi zmdi-landscape"></i-->
						<img class="img-logo" src="images/Logo.png">						
					</span>
					<span class="login100-form-title p-b-34 p-t-27">Inicio de Sesión</span>
					<div class="wrap-input100 validate-input" data-validate = "Ingrese Nombre de Usuario">
						<input class="input100" type="text" name="username" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Ingrese Contraseña">
						<input class="input100" type="password" name="password" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">Recordar Datos</label>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Inicio
						</button>
					</div>
					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							¿Olvidaste tu Contraseña?
						</a>
					</div>
				</form>
				<?php if (!empty($error)) echo $error; ?>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>