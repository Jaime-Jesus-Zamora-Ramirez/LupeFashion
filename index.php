<?php include('partials/header.php');
include('./database/conexion.php')
?>
<div id="carouselExampleCaptions" class="carousel slide" style="max-height: 100vh; overflow: hidden;">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <!-- Imagen con ajuste responsive -->
            <img src="./Images/imagen1.jpg" class="d-block w-100 img-fluid kenburns-bottom" 
                style="object-fit: cover; height: 100vh; border-bottom: 2px solid #ff004a;" 
                alt="..."
                id="carouselImage">
            
            <!-- Texto centrado en pantallas grandes -->
            <div class="carousel-caption d-none d-md-block text-center position-absolute top-50 start-50 translate-middle">
                <h1 class="mb-0 focus-in-contract-bck text-white" style="font-size:70px;">BIENVENIDOS!</h1>
                <div class="wrapper">
                    <svg>
                        <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                            Lupe Fashion
                        </text>
                    </svg>
                </div>
            </div>

            <!-- Texto centrado en pantallas pequeñas -->
            <div class="text-center d-md-none position-absolute top-50 start-50 translate-middle">
                <h1 class="mb-0 focus-in-contract-bck text-white" style="font-size:40px;">BIENVENIDOS!</h1>
                <div class="wrapper">
                    <svg>
                        <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                            Lupe Fashion
                        </text>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Ajuste uniforme del tamaño de la imagen */
    #carouselImage {
        height: 100vh !important;
        object-fit: cover;
    }

    /* Asegurar que el carrusel llene la pantalla */
    #carouselExampleCaptions {
        height: 100vh !important;
    }
</style>



<?php include('./partials/footer.php') ?>