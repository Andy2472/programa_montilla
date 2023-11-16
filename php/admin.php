<?php
include("./conexion.php");

// Consultar la base de datos para obtener todos los datos de la tabla ficha_tecnica
$consulta = "SELECT id, codigo FROM ficha_tecnica";
$resultado = $conexion->query($consulta);

// Cierre la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Códigos</title>
    <link rel="stylesheet" href="estilo_listado.css">
</head>
<body>
    <div class="container">
        <h1>Listado de Códigos</h1>
        <?php if ($resultado->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($fila = $resultado->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['codigo']; ?></td>
                        <td><a href="actualizar_ficha.php?codigo=<?php echo $fila['codigo']; ?>">Actualizar</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No hay códigos disponibles.</p>
        <?php endif; ?>
    </div>
</body>
</html>