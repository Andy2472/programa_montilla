<?php
include("./conexion.php");

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores actualizados del formulario
    $estado = !empty($_POST["estado"]) ? $_POST["estado"] : null;
    $tipo_pc = !empty($_POST["tipo_pc"]) ? $_POST["tipo_pc"] : null;
    $marca = !empty($_POST["marca"]) ? $_POST["marca"] : null;
    $marca_ram = !empty($_POST["marca_ram"]) ? $_POST["marca_ram"] : null;
    $cantidad_ram = !empty($_POST["cantidad_ram"]) ? $_POST["cantidad_ram"] : null;
    $marca_cpu = !empty($_POST["marca_cpu"]) ? $_POST["marca_cpu"] : null;
    $cantidad_nucleos = !empty($_POST["cantidad_nucleos"]) ? $_POST["cantidad_nucleos"] : null;
    $marca_Motherboard = !empty($_POST["marca_Motherboard"]) ? $_POST["marca_Motherboard"] : null;
    $disco_duro = !empty($_POST["disco_duro"]) ? $_POST["disco_duro"] : null;
    $codigo = $_POST["codigo"];

    // Actualizar los datos en la tabla ficha_tecnica
    // Actualizar los datos en la tabla ficha_tecnica
    $sql = "UPDATE ficha_tecnica SET estado=?, tipo_pc=?, marca=?, marca_ram=?, cantidad_ram=?, marca_cpu=?, cantidad_nucleos=?, marca_Motherboard=?, disco_duro=? WHERE codigo=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssss", $estado, $tipo_pc, $marca, $marca_ram, $cantidad_ram, $marca_cpu, $cantidad_nucleos, $marca_Motherboard, $disco_duro, $codigo);


    if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
        
        // Redirigir a admin.php después de 2 segundos
        header("refresh:2;url=admin.php");
        exit();
    } else {
        echo "Error al actualizar los datos: " . $stmt->error;
    }

    $stmt->close();
}

// Obtener el código pasado por método GET
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;

// Consultar la base de datos para obtener los datos actuales según el código
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
    <title>Actualizar Ficha Técnica</title>
    <link rel="stylesheet" href="estilo_actualizar.css">
</head>
<body>
    <div class="container">
        <h1>Actualizar Ficha Técnica</h1>
        <?php if ($fichaTecnica) : ?>
            <form method="post" action="">
                <label for="estado">Estado:</label>
                <input type="text" name="estado" value="<?php echo $fichaTecnica['estado']; ?>">

                <label for="tipo_pc">Tipo de PC:</label>
                <input type="text" name="tipo_pc" value="<?php echo $fichaTecnica['tipo_pc']; ?>">
                
                <label for="marca">Marca:</label>
                <input type="text" name="marca" value="<?php echo $fichaTecnica['marca']; ?>">

                <label for="marca_ram">Marca de RAM:</label>
                <input type="text" name="marca_ram" value="<?php echo $fichaTecnica['marca_ram']; ?>">

                <label for="cantidad_ram">Cantidad de RAM:</label>
                <input type="text" name="cantidad_ram" value="<?php echo $fichaTecnica['cantidad_ram']; ?>">

                <label for="marca_cpu">Marca de CPU:</label>
                <input type="text" name="marca_cpu" value="<?php echo $fichaTecnica['marca_cpu']; ?>">

                <label for="cantidad_nucleos">Cantidad de Núcleos:</label>
                <input type="text" name="cantidad_nucleos" value="<?php echo $fichaTecnica['cantidad_nucleos']; ?>">

                <label for="marca_Motherboard">Marca de Motherboard:</label>
                <input type="text" name="marca_Motherboard" value="<?php echo $fichaTecnica['marca_Motherboard']; ?>">

                <label for="disco_duro">Disco Duro:</label>
                <input type="text" name="disco_duro" value="<?php echo $fichaTecnica['disco_duro']; ?>">

                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                
                <button type="submit">Actualizar</button>
            </form>
        <?php else : ?>
            <p>No se encontró información para el código proporcionado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
