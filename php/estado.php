<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Código</title>
    <link rel="stylesheet" href="estado.css">
</head>
<body>
    <div class="container">
        <h1>Ingrese el código de verificación</h1>
        <form action="estadoVerificar.php" method="post">
            <input type="text" name="codigo" placeholder="Código" required>
            <button type="submit">Verificar</button>
        </form>
    </div>
</body>
</html>
