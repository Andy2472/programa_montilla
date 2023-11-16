<?php
include("./conexion.php");

// Obtener el código pasado como parámetro GET
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;

// Consultar la base de datos para obtener la información según el código
$consulta = "SELECT * FROM ficha_tecnica WHERE codigo = ?";
$stmtConsulta = $conexion->prepare($consulta);
$stmtConsulta->bind_param("s", $codigo);
$stmtConsulta->execute();
$resultado = $stmtConsulta->get_result();
$fichaTecnica = $resultado->fetch_assoc();
$stmtConsulta->close();

// Cierre la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Mantenimiento</title>
    <link rel="stylesheet" href="estado_mantenimiento.css">
</head>
<body>
    <div class="container">
        <h1>Estado del Mantenimiento</h1>
        <div class="status">
            <div class="status-icon">
                <!-- Puedes cambiar la clase del icono según el estado (por ejemplo, icono de verificación o advertencia) -->
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="status-text">
                <?php if ($fichaTecnica) : ?>
                    <h2>Estado: <?php echo $fichaTecnica['estado'] ?? 'Desconocido'; ?></h2>
                    <p>Tipo: <?php echo $fichaTecnica['tipo_pc'] ?? 'Desconocido'; ?></p>
                    <p>Marca: <?php echo $fichaTecnica['marca'] ?? 'Desconocido'; ?></p>
                    <p>Ram: <?php echo $fichaTecnica['marca_ram'] ?? 'Desconocido'; ?></p>
                    <p>Cantidad: <?php echo $fichaTecnica['cantidad_ram'] ?? 'Desconocido'; ?></p>
                    <p>CPU: <?php echo $fichaTecnica['marca_cpu'] ?? 'Desconocido'; ?></p>
                    <p>Nucleos: <?php echo $fichaTecnica['cantidad_nucleos'] ?? 'Desconocido'; ?></p>
                    <p>Motherboard: <?php echo $fichaTecnica['marca_Motherboard'] ?? 'Desconocido'; ?></p>
                    <p>Disco Duro: <?php echo $fichaTecnica['disco_duro'] ?? 'Desconocido'; ?></p>
                    <p><?php echo $fichaTecnica['nombre_dueño'] ?? 'Desconocido'; ?></p>
                <?php else : ?>
                    <h2>Desconocido</h2>
                    <p>No se encontró información para el código proporcionado.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="actions">
            <button class="btn-accept">Aceptar</button>
            <button class="btn-reject">Rechazar</button>
        </div>
    </div>
</body>
</html>
