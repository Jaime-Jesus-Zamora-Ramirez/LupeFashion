<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link nav-color" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-color" href="../views/VerProductos.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-color" href="../views/Contactos.php">Contacto</a>
          </li>
          <?php if (!isset($_SESSION['usuario'])): ?>
            <li class="nav-item">
                <a class="nav-link nav-color" href="/LupeFashion/views/login/login.php">Log In</a>
            </li>
        <?php else: ?>
          <li class="nav-item">
                <a class="nav-link nav-color" href="/LupeFashion/views/MostrarProducto.php">Mostrar Producto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-color" href="/LupeFashion/views/login/logout.php">Log Out</a>
            </li>
        <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>