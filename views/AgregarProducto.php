<?php 
include('./partials/header.php');
include('../database/conexion.php');
?>

<?php
if ($_POST) {
    // Recibimos los datos del formulario
    $Nombre = $_POST['txtNombre'];
    $Descripcion = $_POST['txtDescripcion'];
    $Cantidad = $_POST['txtCantidad'];

    // Manejo de las imágenes (BLOB)
    $Imagen_1 = file_get_contents($_FILES['txtImagen_1']['tmp_name']);
    $Imagen_2 = isset($_FILES['txtImagen_2']) && $_FILES['txtImagen_2']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['txtImagen_2']['tmp_name']) : null;
    $Imagen_3 = isset($_FILES['txtImagen_3']) && $_FILES['txtImagen_3']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['txtImagen_3']['tmp_name']) : null;

    // Creamos la conexión a la base de datos
    $Objconexion = new conexion();

    // Creamos la consulta SQL usando preparación
    $sql = "INSERT INTO `productos` (`nombre`, `descripcion`, `imagen_1`, `imagen_2`, `imagen_3`, `cantidad`) 
            VALUES (:nombre, :descripcion, :imagen_1, :imagen_2, :imagen_3, :cantidad)";

    // Preparamos la consulta
    $stmt = $Objconexion->conexion->prepare($sql);

    // Vinculamos los parámetros
    $stmt->bindParam(':nombre', $Nombre, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $Descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':imagen_1', $Imagen_1, PDO::PARAM_LOB);  // PDO::PARAM_LOB para BLOB
    $stmt->bindParam(':imagen_2', $Imagen_2, PDO::PARAM_LOB);
    $stmt->bindParam(':imagen_3', $Imagen_3, PDO::PARAM_LOB);
    $stmt->bindParam(':cantidad', $Cantidad, PDO::PARAM_INT);

    // Ejecutamos la consulta
    if ($stmt->execute()) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo ' <strong>Registro exitoso!</strong> El producto se registró correctamente.';
        echo ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo ' </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo ' <strong>Algo salió mal!</strong> Hubo un error al registrar el producto.';
        echo ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo ' </div>';
    }
}
?>


<form action="AgregarProducto.php" method="post" enctype="multipart/form-data">
    <label for="txtNombre">Nombre del producto:</label>
    <input type="text" name="txtNombre" required>
    
    <label for="txtDescripcion">Descripción:</label>
    <textarea name="txtDescripcion" required></textarea>
    
    <label for="txtImagen_1">Imagen 1:</label>
    <input type="file" name="txtImagen_1" required>
    
    <label for="txtImagen_2">Imagen 2:</label>
    <input type="file" name="txtImagen_2">
    
    <label for="txtImagen_3">Imagen 3:</label>
    <input type="file" name="txtImagen_3">
    
    <label for="txtCantidad">Cantidad:</label>
    <input type="number" name="txtCantidad" required>

    <input type="submit" value="Agregar Producto">
</form>


<?php include('./partials/footer.php') ?>