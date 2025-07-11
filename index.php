<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "104.198.137.237"; 
$user = "root"; 
$password = "123456"; 
$database = "examen";

$conexion = mysqli_connect($host, $user, $password, $database);

if (!$conexion) {
  die("Error de conexión: " . mysqli_connect_error());
}

$consulta = "SELECT 
    p.nombre,
    p.edad,
    p.fecha_nacimiento,
    o.descripcion AS origen,
    p.telefono_movil,
    p.telefono_fijo
  FROM Persona p
  JOIN Origen o ON p.id_origen = o.id_origen
  WHERE LEFT(p.nombre, 1) NOT IN ('A', 'E', 'I', 'O', 'U')";
$resultado = mysqli_query($conexion, $consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>DATOS PERSONALES DE TRUJILLO PINEDA ELMER</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <h1 class="display-4 text-center">DATOS PERSONALES DE TRUJILLO PINEDA</h1>
    <hr>

    <?php
    if ($resultado && mysqli_num_rows($resultado) > 0) {
      echo "
      <table class='table table-bordered table-striped mt-4'>
        <thead class='thead-dark'>
          <tr>
            <th>Nombre</th>
            <th>edad</th>
            <th>Fecha de Nacimiento</th>
            <th>Origen</th>
            <th>Teléfono Movil</th>
            <th>Teléfono Fijo</th>
          </tr>
        </thead>
        <tbody>";

      while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "
          <tr>
            <td>{$fila['nombre']}</td>
            <td>{$fila['edad']}</td>
            <td>{$fila['fecha_nacimiento']}</td>
            <td>{$fila['origen']}</td>
            <td>{$fila['telefono_movil']}</td>
            <td>{$fila['telefono_fijo']}</td>
          </tr>";
      }

      echo "</tbody></table>";
    } else {
      echo "<p class='text-danger text-center'>No se encontraron registros de personas.</p>";
    }
    ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    crossorigin="anonymous"></script>
</body>
</html>
