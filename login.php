<?php
// Configuración de la conexión a la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "test";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("No hay conexión: " . mysqli_connect_error());
}

// Obtención de los datos del formulario
$nombre = $_POST["txtusuario"];
$pass = $_POST["txtpassword"];

// Consulta a la base de datos para verificar las credenciales
$query = mysqli_query($conn, "SELECT * FROM login WHERE usuario = '" . $nombre . "' and password = '" . $pass . "'");
$nr = mysqli_num_rows($query);

// Verificación del resultado de la consulta
if ($nr == 1) {
    // Si las credenciales son correctas
    // Redireccionar a la página de bienvenida y mostrar el nombre del usuario en un marco rojo
    $usuario = mysqli_fetch_assoc($query);
    $nombreUsuario = ucfirst($usuario["usuario"]); // Convertir la primera letra en mayúscula

    echo '<html>
    <style>
        .marco-rojo {
            border: 4px solid red;
            border-radius: 10px;
            padding: 10px;
            width: 33%;
            margin: 0 auto;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: skyblue;
        }

        .marco-rojo img {
            max-width: 100%;
            height: auto;
        }

        .bienvenido {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
    <center>
        <span class="bienvenido">Bienvenido:</span>
        <div class="marco-rojo">
            <h1>' . $nombreUsuario . '</h1>
            <img src="ctm.png"/>
        </div>
    </center>
    </html>';
} else if ($nr == 0) {
    // Si las credenciales son incorrectas
    // Redireccionar de nuevo a la página de inicio de sesión o mostrar un mensaje de error
    echo "<script> alert('Error');window.location= 'login.html' </script>";
}
?>
