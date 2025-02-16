<?php include('./partials/header.php');
include('../database/conexion.php');

//--------------------obtener--------------------
$ObjConexion = new conexion();
$productos = $ObjConexion->consultar("SELECT * FROM `productos`");

//--------------------eliminamos--------------------
if (isset($_GET['eliminar'])) {
    $id_producto = $_GET['eliminar'];
    $ObjConexion = new conexion();
    $sql = "DELETE FROM `productos` WHERE `id_producto` = " . $id_producto;
    $ObjConexion->consultar($sql);

    if ($ObjConexion == true) {
        header('location: index.php');
    }
}
//--------------------obtener--------------------

?>

<div class="row justify-content-center align-items-center g-2 mt-5">
    <div class="col-lg-10">
        <a href="./AgregarProducto.php" type="button" class="btn btn-success">Agregar</a>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imagen 1</th>
                        <th scope="col">Imagen 2</th>
                        <th scope="col">Imagen 3</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $producto['id_producto'] ?></td>
                            <td><?php echo $producto['nombre'] ?></td>
                            <td><?php echo $producto['descripcion'] ?></td>
                            
                            <!-- Imagen 1 -->
                            <?php
                                // Convertir la imagen_1 (BLOB) a Base64
                                $imagenBlob1 = $producto['imagen_1'];
                                if ($imagenBlob1) {
                                    $imagenBase64_1 = base64_encode($imagenBlob1); 
                                    $src1 = 'data:image/jpeg;base64,' . $imagenBase64_1;
                                } else {
                                    $src1 = ''; 
                                }
                            ?>
                            <td>
                                <?php if ($src1) : ?>
                                    <img src="<?php echo $src1; ?>" alt="Imagen 1 del producto" width="100" height="100">
                                <?php else : ?>
                                    <span>No disponible</span>
                                <?php endif; ?>
                            </td>

                            <!-- Imagen 2 -->
                            <?php
                                // Convertir la imagen_2 (BLOB) a Base64
                                $imagenBlob2 = $producto['imagen_2'];
                                if ($imagenBlob2) {
                                    $imagenBase64_2 = base64_encode($imagenBlob2); 
                                    $src2 = 'data:image/jpeg;base64,' . $imagenBase64_2;
                                } else {
                                    $src2 = ''; 
                                }
                            ?>
                            <td>
                                <?php if ($src2) : ?>
                                    <img src="<?php echo $src2; ?>" alt="Imagen 2 del producto" width="100" height="100">
                                <?php else : ?>
                                    <span>No disponible</span>
                                <?php endif; ?>
                            </td>

                            <!-- Imagen 3 -->
                            <?php
                                // Convertir la imagen_3 (BLOB) a Base64
                                $imagenBlob3 = $producto['imagen_3'];
                                if ($imagenBlob3) {
                                    $imagenBase64_3 = base64_encode($imagenBlob3); 
                                    $src3 = 'data:image/jpeg;base64,' . $imagenBase64_3;
                                } else {
                                    $src3 = ''; 
                                }
                            ?>
                            <td>
                                <?php if ($src3) : ?>
                                    <img src="<?php echo $src3; ?>" alt="Imagen 3 del producto" width="100" height="100">
                                <?php else : ?>
                                    <span>No disponible</span>
                                <?php endif; ?>
                            </td>

                            <td><?php echo $producto['cantidad'] ?></td>
                            <td>
                                <div class="btn-group gap-2">
                                    <a href="./Editarproducto.php?editar=<?php echo $producto['id_producto'] ?>" type="button" class="btn btn-warning">Editar</a>
                                    <a href="?eliminar=<?php echo $producto['id_producto'] ?>" type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('./partials/footer.php') ?>