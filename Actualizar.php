<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Existencias</title>
    <link rel="stylesheet" href="css/estilos.css"> <!-- Si estás utilizando estilos externos -->
</head>
<body>
    <div class="container">
        <h2>Actualizar Existencias de Producto</h2>
        <form action="actualizar_existencias.php" method="post">
            <div class="input-container">
                <label for="producto">Selecciona el Producto:</label>
                <select id="producto" name="producto" required>
                    <option value="">Selecciona un producto...</option>
                    <?php
                    // Datos de conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "02351236";
                    $dbname = "utencilios";

                    // Crear conexión
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar la conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Consultar nombres de productos desde la base de datos
                    $sql = "SELECT nombre FROM productos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="input-container">
                <label for="existencias">Nuevas Existencias:</label>
                <input type="number" id="existencias" name="existencias" required>
            </div>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>

