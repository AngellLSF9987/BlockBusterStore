<!doctype html>
<html lang="en">

<head>
    <title>BLOCKBUSTER STORE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.2/dist/umd/popper.min.js"
        integrity="sha384-q9CRHqZndzlxGLOj+xrdLDJa9ittGte1NksRmgJKeCV9DrM7Kz868XYqsKWPpAmn" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/color/jquery.color-2.2.0.js"
        integrity="sha256-gvMJWDHjgDrVSiN6eBI9h7dRfQmsTTsGU/eTT8vpzNg=" crossorigin="anonymous"></script>
    <!-- CSS personalizado -->
    <link href="public/css/style.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-dark">
            <div class="container-fluid">
                <!-- Marca o logo -->
                <a class="navbar-brand" href="#">BlockBuster Store</a>

                <!-- Botón de colapso para pantallas pequeñas 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                -->

                <!-- Contenido del navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Contacta con
                            Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Pedidos</a>
                    </li>
                </ul>

                <!-- Formulario de búsqueda centrado -->
                <form class="d-flex mx-auto" role="search" style="width: 45%; margin-left: 3em; padding-left: 2em;">
                    <input class="form-control me-2" type="search" placeholder="Buscar Título..." aria-label="Search">
                    <button class="btn btn-secondary" type="submit" style="font-weight:bold;">Buscar</button>
                </form>

                <!-- Links de sesión -->
                <ul class="nav">
                    <?php 
                        session_start();
                        if (isset($_SESSION['usuario_id'])): 
                            if ($_SESSION['rol'] == 'admin') {
                                echo '<li class="nav-item"><a class="nav-link active" href="admin/indexAdmin.php" style="color:white;font-weight:bold">Admin Dashboard</a></li>';
                            } else {
                                echo '<li class="nav-item"><a class="nav-link active" href="client/indexClient.php" style="color:white;font-weight:bold">Client Dashboard</a></li>';
                            }
                    ?>
                    <li class="nav-item"><a class="nav-link active" href="auth/logout.php"
                            style="color:white;font-weight:bold">Cerrar Sesión</a></li>
                    <?php else: ?>
                    <li class="nav-item"><a class="nav-link active" href="auth/login.php"
                            style="color:white;font-weight:bold">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link active" href="auth/register.php"
                            style="color:white;font-weight:bold">Únete!</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="rowmain">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link">Anterior</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
        <hr>
        <tr></tr> 