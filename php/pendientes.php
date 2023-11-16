<?php
include("./conexion.php");

// Realiza una consulta para obtener los pendientes de la base de datos
$sql = "SELECT * FROM pendientes";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendientes</title>
</head>
<body>
    <h1>Lista de Pendientes</h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "Nombre: " . $row["nombre"] . "<br>";
            echo "Correo: " . $row["correo"] . "<br>";
            echo "Título: " . $row["titulo"] . "<br>";
            echo "Mensaje: " . $row["mensaje"] . "<br>";
            echo '<button type="button" onclick="aceptarPendiente(' . $row["id"] . ')">Aceptar</button>';
            echo '<button type="button" onclick="rechazarPendiente(' . $row["id"] . ')">Rechazar</button>';
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No hay pendientes registrados en la base de datos.";
    }

    $conexion->close();
    ?>

    <script>
        function aceptarPendiente(id) {
            // Aquí puedes agregar la lógica para marcar el pendiente como aceptado en la base de datos
            alert("Pendiente con ID " + id + " aceptado");
        }

        function rechazarPendiente(id) {
            // Aquí puedes agregar la lógica para marcar el pendiente como rechazado en la base de datos
            alert("Pendiente con ID " + id + " rechazado");
        }
    </script>
</body>
</html>
