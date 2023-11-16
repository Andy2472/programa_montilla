<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoIngresado = $_POST["codigo"];
    $codigoCorrecto = "1"; // Código correcto

    if ($codigoIngresado === $codigoCorrecto) {
        // Redirigir a la página de estado del mantenimiento si el código coincide
        header("Location: estado_mantenimiento.php");
        exit();
    }
}

// Si el código no coincide, mostrar una ventana de error
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
