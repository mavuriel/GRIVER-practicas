<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Zelda items</title>
</head>

<body>
    <main class="container">

        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col card border-primary py-2 " style="max-width: 50rem;">
                <a class="d-flex justify-content-center" href="../index.php">
                    <img class="home" src="/assets/img/triforce.svg">
                </a>
                <ul class="nav nav-tabs d-flex justify-content-evenly pb-3">
                    <li class="nav-item ">
                        <a class="btn btn-primary" href="../pociones.php">
                            Pociones
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="btn btn-primary" href="../ropa.php">
                            Ropajes
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="btn btn-primary" href="../armas.php">
                            Armas
                        </a>
                    </li>
                    <form class="d-flex box" method="POST">
                        <input class="form-control me-1" type="text" placeholder="Nombre ó nivel" name="busqueda">
                        <button class="btn btn-secondary " type="submit">
                            <img class="icon" src="./assets/img/zelda.svg">
                        </button>
                    </form>
                </ul>

                <div class="card-body row">
                    <div class="col border-primary border-end">