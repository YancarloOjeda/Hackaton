<?php
  session_start();
  
  // Obtengo los datos cargados en el formulario de login.
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Datos para conectar a la base de datos.
  $nombreServidor = "ae-gec.com";
  $nombreUsuario = "aegeccom";
  $passwordBaseDeDatos = "9z48hQ7sSy";
  $nombreBaseDeDatos = "aegeccom_Prueba";
 
 
  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
  
  // Validar la conexión de base de datos.
  if ($conn ->connect_error) {
    die("Connection failed: " . $conn ->connect_error);
  }
  
  // Consulta segura para evitar inyecciones SQL.
  //$sql = sprintf("SELECT * FROM usuarios WHERE email='$email' AND password = '$password'", mysql_real_escape_string($email), mysql_real_escape_string($password));
  //$resultado = $conn->query($sql);
  $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE email = '".$email."' and password = '".$password."'");
  $nr = mysqli_num_rows($query);
  
  // Verificando si el usuario existe en la base de datos.
  if($nr == 1)
  {
	// Guardo en la sesión el email del usuario.
	$_SESSION['email'] = $email;
	
	// Redirecciono al usuario a la página principal del sitio.
	header("HTTP/1.1 302 Moved Temporarily"); 
    header("Location: principal.php"); 
  }else{
	echo 'El email o password es incorrecto, <a href="index.html">vuelva a intenarlo</a>.<br/>';
  }

?>