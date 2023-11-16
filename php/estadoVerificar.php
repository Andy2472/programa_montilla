<?php
include("./conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoIngresado = $_POST["codigo"];

    // Consultar la base de datos para verificar si el código existe en la tabla ficha_tecnica
    $consulta = "SELECT * FROM ficha_tecnica WHERE codigo = ?";
    $stmtConsulta = $conexion->prepare($consulta);
    $stmtConsulta->bind_param("s", $codigoIngresado);
    $stmtConsulta->execute();
    $stmtConsulta->store_result();

    if ($stmtConsulta->num_rows > 0) {
        // Redirigir a la página de estado del mantenimiento con el código como parámetro GET
        header("Location: estado_mantenimiento.php?codigo=" . urlencode($codigoIngresado));
        exit();
    }
    
    $stmtConsulta->close();
}

// Cierre la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Verificación</title>
    <link rel="stylesheet" href="estadoVerificar.css">
</head>
<body>
    <div class="container error">
        <h1>Error de Verificación</h1>
        <p>El código ingresado no es válido.</p>
        <a href="estado.php">Volver a intentar</a>
    </div>
</body>
</html>