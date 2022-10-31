<?php

use Src\Service\ApiService;

require __DIR__ . "/../vendor/autoload.php";

$imagenes = [];
$imagenes = (isset($_POST['submit']) && $_POST['busqueda'] != "") ? (new ApiService)->getDatos($_POST['busqueda']) : $imagenes = (new ApiService)->getDatos("kitten");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <div style="margin: auto; width:50%; text-align:center;">
        <div class="container m-4">
            <form name='as' method='POST' action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="container m-1 text-primary">
                    <p>He añadido un campo de búsqueda funcional!</p>
                    <p>Si no se introduce nada, salen gatitos por defecto!</p>
                </div>
                <div class="input-group" style="margin: auto; width:50%; text-align:center;">
                    <div class="form-outline" style="margin: auto; width:50%; text-align:center;">
                        <input type="text" name="busqueda" id="buscar" class="form-control" placeholder="Buscar imágenes" />
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary" style="margin: auto; width:50%; text-align:center;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                </from>
        </div>
    </div>
    <div style="margin:auto; width:50%;">
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $cont = 1;
                foreach ($imagenes as $imagen) {
                    echo ($cont == 1) ? "<div class='carousel-item active'>\n" : "<div class='carousel-item'>\n";
                    echo <<<TXT
                    <div class="card">
                    <img src="{$imagen->getUrl()}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Autor: {$imagen->getAutor()}</h5>
                    <p class="card-text">Número de likes: {$imagen->getLikes()}</p>
                    </div>
                    </div>
                    TXT;
                    echo "</div>\n";
                    $cont++;
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</body>

</html>