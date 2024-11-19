<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "02351236";
$dbname = "utencilios";

// Límite máximo de existencias
$max_existencias = 100;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre_producto = $_POST['producto'];
$nuevas_existencias = $_POST['existencias'];

// Obtener las existencias actuales del producto por nombre
$sql = "SELECT Existencias FROM productos WHERE nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existencias_actuales = $row['Existencias'];

    // Calcular las nuevas existencias
    $total_existencias = $existencias_actuales + $nuevas_existencias;

    // Verificar si se excede el límite máximo de existencias
    if ($total_existencias > $max_existencias) {
        echo "No se pueden agregar las existencias porque exceden el límite máximo de $max_existencias unidades.";
    } else {
        // Actualizar las existencias en la base de datos
        $sql_update = "UPDATE productos SET Existencias = ? WHERE nombre = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("is", $total_existencias, $nombre_producto);

        if ($stmt_update->execute()) {
            // Redirigir a la página que muestra todos los productos
            header("Location: mostrar_productos.php");
            exit();
        } else {
            echo "Error al actualizar las existencias: " . $stmt_update->error;
        }

        $stmt_update->close();
    }
} else {
    echo "Producto no encontrado.";
}

$stmt->close();
$conn->close();
?>





