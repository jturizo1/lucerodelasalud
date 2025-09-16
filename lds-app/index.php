<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/style/bootstrap-login.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/style/main-login.css">
	<link rel="stylesheet" type="text/css" href="assets/style/util-login.css">
<!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9GLLP82379"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-9GLLP82379');
</script>

<body>
    <div class="limiter">
		<div class="container-login100" style="background-image: url('assets/images/background.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="auth/login.php">
					<span class="login100-form-logo">
						<!--i class="zmdi zmdi-landscape"></i-->
						<img class="img-logo" src="assets/images/Logo.png">						
					</span>
					<span class="login100-form-title p-b-34 p-t-27">Inicio de Sesión</span>
                    <?php if (!empty($_SESSION['error'])): ?>
                        <script>Swal.fire('Error', <?php echo json_encode($_SESSION['error']); ?>, 'error');</script>
                    <?php unset($_SESSION['error']); endif; ?>
					<div class="wrap-input100 validate-input" data-validate = "Ingrese Nombre de Usuario" required>
						<input class="input100" type="email" name="correo" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Ingrese Contraseña">
						<input class="input100" type="password" name="password" placeholder="Contraseña" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">Recordar Datos</label>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">Inicio</button>
					</div>
					<!--div class="text-center p-t-90">
						<a class="txt1" href="#">
							¿Olvidaste tu Contraseña?
						</a>
					</div-->
				</form>
				<!--?php if (!empty($error)) echo $error; ?-->
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>
</body>
</html>