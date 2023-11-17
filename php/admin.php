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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #03C4EB; /* Nuevo color */
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #03C4EB; /* Nuevo color */
        }

        a:hover {
            color: #0184A9; /* Cambio de color al pasar el mouse */
        }
    </style>
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
