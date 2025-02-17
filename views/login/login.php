<?php 
session_start();
include '../../database/conexion.php';

if ($_POST) {
    $usuario = $_POST['txtUsuario'];
    $contrasena = $_POST['txtContrasena'];

    $objconexion = new conexion();
    $sql = "SELECT * FROM `login` WHERE username = :usuario AND password = :contrasena";
    $sentencia = $objconexion->conexion->prepare($sql);
    $sentencia->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $sentencia->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['id_usuario'] = $resultado['id_login']; 
        
        header('Location: ../MostrarProducto.php');
        exit();
    } else {
        $error = true; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentista Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <br />
    <div class="container mt-5">
        <div class="container-fluid bg-gray-50 rounded-md shadow-md">
            <div class="row">
                <div class="col-lg-5 d-flex align-items-center justify-content-end">
                    <img src="../../images/imagen1.jpg" alt="Imagen de Inicio de Sesión" class="img-fluid mx-auto d-block img-lg" style="max-height: 500px; max-width: 100%;">
                </div>
                <div class="col-lg-6">
                    <div class="p-4">
                        <div class="text-center mt-5 mx-auto">
                            <h2 class="text-4xl md-text-6xl font-bold mb-4 font-beau-rivage text-green-800">
                                Bienvenidos!
                            </h2>
                            <!-- Validación y mostrar la alerta -->
                            <?php if (isset($error) && $error): ?>
                                <div class="alert alert-danger" role="alert">
                                    Usuario o contraseña incorrectos.
                                </div>
                            <?php endif; ?>
                            <form action="login.php" method="post">
                                <div class="mb-4">
                                    <label for="" class="form-label text-gray-700 text-sm font-bold mb-2">
                                        Correo electrónico:
                                    </label>
                                    <input required type="text" id="" name="txtUsuario" class="form-control mt-2" placeholder="Ingrese su nombre de usuario">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-gray-700 text-sm font-bold mb-2">
                                        Contraseña:
                                    </label>
                                    <input type="password" id="" name="txtContrasena" class="form-control mt-2" placeholder="Ingrese su contraseña">
                                </div>
                                <button type="submit" class="btn btn-success py-2 px-4">
                                    Iniciar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php include '../partials/footer.php'; ?>
