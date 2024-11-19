<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #E0E0E0; /* Gris pastel */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fafafa; /* Gris pastel más claro */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px; /* Espacio entre el título y el formulario */
        }
        div {
            margin-bottom: 15px;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px); /* Se resta el ancho del borde para que se ajuste correctamente */
            padding: 10px;
            border: 1px solid #ccc; /* Gris pastel */
            border-radius: 5px;
            background-color: #f5f5f5; /* Gris pastel más claro */
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #ccc; /* Gris pastel */
            color: #333; /* Gris oscuro */
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #b3b3b3; /* Gris pastel más oscuro */
        }
    </style>
</head>
<body>
<h1>Bienvenido | Iniciar Sesión</h1>
    <form action="actualizar.php" method="post">
        <div>
            Email <input type="text" placeholder="Email" name="txtEmail">
        </div>
        <div>
            Contraseña <input type="password" placeholder="Contraseña" name="txtContra">
        </div>
        <div>
            <button type="submit">Ingresar</button>
        </div>
    </form>
    <?php
    if(isset($_POST['txtEmail'])){
        $user = $_POST['txtEmail'];
        $passw = $_POST['txtContra'];
        include('Conexion/conectar.php');
        $sql="SELECT * FROM usuario WHERE email ='$user' AND contrasenia=MD5('$passw')";
        $ejecSql= mysqli_query($cn,$sql);
        $regUsuario=mysqli_fetch_assoc($ejecSql);
        if(mysqli_affected_rows($cn)==1){
            // Si existe usuario entonces creamos la sesión
            session_start();
            // Una vez iniciada la sesión creamos las variables de sesión
            $_SESSION['user']= $regUsuario['nombreU'];
            $_SESSION['correo']= $regUsuario['email'];
            $_SESSION['foto'] = $regUsuario['foto'];
            $_SESSION['rol']=$regUsuario['idRol'];
            header("Location: actualizar.php");
            exit();
        } else {
            echo "<p>Usuario o contraseña incorrectos</p>";
        }
    }
    ?>
</body>
</html>
