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

// Obtener todos los productos
$sql = "SELECT nombre, Existencias FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    
    <link rel="stylesheet" href="styles.css"> <!-- Si estás utilizando estilos externos -->
    <head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Lista de Productos</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Existencias</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['Existencias']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='text-center'>No se encontraron productos</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
