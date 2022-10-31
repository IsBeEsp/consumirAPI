<?php
namespace Src\Service;

use Src\Modelos\Imagen;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__."/../../");
$dotenv->load();

define("URL", "https://pixabay.com/api/?key=".$_ENV['API_KEY']);

class ApiService {

    public function getDatos(string $búsqueda) : array{
        $imagenes = [];
        $datos = file_get_contents(URL."&q=".$búsqueda);
        $datosJson = json_decode($datos);
        $datosImagenes = $datosJson->hits;
        foreach($datosImagenes as $imagen){
            $imagenes[] = (new Imagen)
                ->setUrl($imagen->webformatURL)
                ->setAutor($imagen->user)
                ->setLikes($imagen->likes);
        }
        return $imagenes;
    }
}