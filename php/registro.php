<?php
include("./conexion.php");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

function generarCodigo($longitud = 8) {
    $caracteres = '0123456789';
    $codigo = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Insertar los datos en la tabla ficha_tecnica
    $sqlFicha = "INSERT INTO ficha_tecnica (nombre_dueño) VALUES (?)";
    $stmtFicha = $conexion->prepare($sqlFicha);
    $stmtFicha->bind_param("s", $name);

    if ($stmtFicha->execute()) {
        // Obtener el ID generado automáticamente
        $idFicha = $stmtFicha->insert_id;

        // Generar código único
        $codigo = generarCodigo();

        // Verificar si el código ya existe en la base de datos
        $existe = true;
        while ($existe) {
            $consulta = "SELECT codigo FROM ficha_tecnica WHERE codigo = ?";
            $stmtConsulta = $conexion->prepare($consulta);
            $stmtConsulta->bind_param("s", $codigo);
            $stmtConsulta->execute();
            $stmtConsulta->store_result();
            $existe = $stmtConsulta->num_rows > 0;
            $stmtConsulta->close();

            // Si el código ya existe, generar uno nuevo
            if ($existe) {
                $codigo = generarCodigo();
            }
        }

        // Actualizar la fila con el código generado
        $sqlUpdate = "UPDATE ficha_tecnica SET codigo = ? WHERE id = ?";
        $stmtUpdate = $conexion->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $codigo, $idFicha);
        $stmtUpdate->execute();
        $stmtUpdate->close();

        // Insertar los datos en la tabla pendientes
        $sqlPendientes = "INSERT INTO pendientes (nombre, correo, titulo, mensaje, codigo) VALUES (?, ?, ?, ?, ?)";
        $stmtPendientes = $conexion->prepare($sqlPendientes);
        $stmtPendientes->bind_param("ssssi", $name, $email, $subject, $message, $idFicha);

        if ($stmtPendientes->execute()) {
            echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Tu Título</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .centrar {
                text-align: center;
                margin-top: 20px; /* Ajusta el margen según sea necesario */
            }

            .boton-estado button {
                background-color: #03C4EB;
                color: white;
                padding: 10px 15px;
                border: none;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
            }

            .boton-estado button:hover {
                background-color: #03C4EB;
            }
        </style>
    </head>
    <body>";

echo "<h1>Solicitud enviada. Por favor, verifica el estado de tu equipo con este código: $codigo</h1> <br>";
echo '<div class="centrar"><a href="estado.php" class="boton-estado"><button>Ver estado de equipo</button></a></div>';

echo "</body></html>";
        } else {
            echo "Error al registrar los datos en pendientes: " . $conexion->error;
        }

        $stmtPendientes->close();
    } else {
        echo "Error al registrar los datos en ficha_tecnica: " . $conexion->error;
    }

    $stmtFicha->close();
}

$conexion->close();
?>
