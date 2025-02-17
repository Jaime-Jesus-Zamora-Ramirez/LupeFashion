<?php
include('./partials/header.php');
include('../database/conexion.php');

if (!isset($_SESSION['usuario'])) {

    header('Location: ../views/login/login.php');
    exit();
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Obtener el producto a editar
if ($_GET) {
    $id_producto = $_GET['editar'];
    $Objconexion = new conexion();
    $EditarProducto = $Objconexion->consultar("SELECT * FROM `productos` WHERE id_producto=" . $id_producto);
}

// Actualizar el producto
if ($_POST) {
    $id_producto = $_POST['id_Producto'];
    $Producto = $_POST['txtProducto'];
    $Descripcion = $_POST['txtDescripcion'];
    $Cantidad = $_POST['txtCantidad'];

    // Si se han subido nuevas imágenes
    $Imagen_1 = isset($_FILES['txtImagen_1']) && $_FILES['txtImagen_1']['tmp_name'] ? file_get_contents($_FILES['txtImagen_1']['tmp_name']) : null;
    $Imagen_2 = isset($_FILES['txtImagen_2']) && $_FILES['txtImagen_2']['tmp_name'] ? file_get_contents($_FILES['txtImagen_2']['tmp_name']) : null;
    $Imagen_3 = isset($_FILES['txtImagen_3']) && $_FILES['txtImagen_3']['tmp_name'] ? file_get_contents($_FILES['txtImagen_3']['tmp_name']) : null;

    // Si no se subieron imágenes nuevas, mantener las imágenes actuales
    if (!$Imagen_1) {
        $Imagen_1 = $_POST['img_1_existing']; // Mantener la imagen actual
    }
    if (!$Imagen_2) {
        $Imagen_2 = $_POST['img_2_existing']; // Mantener la imagen actual
    }
    if (!$Imagen_3) {
        $Imagen_3 = $_POST['img_3_existing']; // Mantener la imagen actual
    }

    // Actualizar en la base de datos
    $Objconexion =  new conexion();
    $sql = "UPDATE `productos` SET 
            `nombre` = :nombre, 
            `descripcion` = :descripcion, 
            `imagen_1` = :imagen_1, 
            `imagen_2` = :imagen_2, 
            `imagen_3` = :imagen_3, 
            `cantidad` = :cantidad 
            WHERE `id_producto` = :id_producto";

    $sentencia = $Objconexion->conexion->prepare($sql);
    $sentencia->bindParam(':nombre', $Producto, PDO::PARAM_STR);
    $sentencia->bindParam(':descripcion', $Descripcion, PDO::PARAM_STR);
    $sentencia->bindParam(':imagen_1', $Imagen_1, PDO::PARAM_LOB);
    $sentencia->bindParam(':imagen_2', $Imagen_2, PDO::PARAM_LOB);
    $sentencia->bindParam(':imagen_3', $Imagen_3, PDO::PARAM_LOB);
    $sentencia->bindParam(':cantidad', $Cantidad, PDO::PARAM_INT);
    $sentencia->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);

    $sentencia->execute();
    header('location:../index.php');
}
?>


<div class="container mt-5">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="EditarProducto.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_Producto" value="<?php echo $EditarProducto[0]['id_producto']; ?>">

                        <div class="mb-3">
                            <label for="txtProducto" class="form-label">Producto</label>
                            <input type="text" name="txtProducto" class="form-control" value="<?php echo $EditarProducto[0]['nombre']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="txtDescripcion" class="form-label">Descripción</label>
                            <textarea name="txtDescripcion" class="form-control" required><?php echo $EditarProducto[0]['descripcion']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="txtCantidad" class="form-label">Cantidad</label>
                            <input type="number" name="txtCantidad" class="form-control" value="<?php echo $EditarProducto[0]['cantidad']; ?>" required>
                        </div>

                        <!-- Mostrar las imágenes actuales -->
                        <div class="mb-3">
                            <label for="txtImagen_1" class="form-label">Imagen 1</label>
                            <div>
                                <?php
                                // Mostrar imagen actual si existe
                                if ($EditarProducto[0]['imagen_1']) {
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($EditarProducto[0]['imagen_1']) . '" width="100" height="100">';
                                } else {
                                    echo 'No disponible';
                                }
                                ?>
                            </div>
                            <input type="file" name="txtImagen_1" class="form-control">
                            <input type="hidden" name="img_1_existing" value="<?php echo base64_encode($EditarProducto[0]['imagen_1']); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="txtImagen_2" class="form-label">Imagen 2</label>
                            <div>
                                <?php
                                // Mostrar imagen actual si existe
                                if ($EditarProducto[0]['imagen_2']) {
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($EditarProducto[0]['imagen_2']) . '" width="100" height="100">';
                                } else {
                                    echo 'No disponible';
                                }
                                ?>
                            </div>
                            <input type="file" name="txtImagen_2" class="form-control">
                            <input type="hidden" name="img_2_existing" value="<?php echo base64_encode($EditarProducto[0]['imagen_2']); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="txtImagen_3" class="form-label">Imagen 3</label>
                            <div>
                                <?php
                                if ($EditarProducto[0]['imagen_3']) {
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($EditarProducto[0]['imagen_3']) . '" width="100" height="100">';
                                } else {
                                    echo 'No disponible';
                                }
                                ?>
                            </div>
                            <input type="file" name="txtImagen_3" class="form-control">
                            <input type="hidden" name="img_3_existing" value="<?php echo base64_encode($EditarProducto[0]['imagen_3']); ?>">
                        </div>
                        <div class="text-center gap-2 mt-2">
                            <a class="btn btn-danger" href="./MostrarProducto.php">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include('./partials/footer.php') ?>