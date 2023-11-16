<?php 
include("./conexion.php");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Aquí puedes realizar validaciones y comprobar si los datos son válidos.

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO pendientes (nombre, correo, titulo, mensaje) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "Los datos se han registrado correctamente.";
    } else {
        echo "Error al registrar los datos: " . $conexion->error;
    }

    $stmt->close();
}

$conexion->close();
?>
