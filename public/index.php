<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->get('/', function (Request $request, Response $response) {

    require_once __DIR__ . '/../includes/dbOpenConn.php';

    $resultats = $db->query("SELECT * FROM artistes");

    $html = "<!DOCTYPE html>
    <html lang='ca'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Página Principal</title>
    </head>
    <body>";
    

    while ($fila = $resultats->fetchArray(SQLITE3_ASSOC)) {
        
        $html .= "<img src='{$fila['foto']}' alt='Foto de {$fila['nom']}'> <br> <br> <a href='/" . $fila['id'] . "'>ID: " . $fila['id'] . " Nom: " . $fila['nom'] . "</a><br>";
    }

    $html .= "</body></html>";

    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});

$app->get('/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    require_once __DIR__ . '/../includes/dbOpenConn.php';

    $resultats = $db->query("SELECT * FROM artistes WHERE id = $id");
    $fila = $resultats->fetchArray(SQLITE3_ASSOC);

    // Procesar nombre artístico
    $nomArtistic = "";
    $nomArtisticArray = json_decode($fila['nomArtistic'], true);
    $contador=0;
    if (is_array($nomArtisticArray)) {
        foreach ($nomArtisticArray as $nom) {
            if ($contador>0) {
                $nomArtistic.=", ";
            }else {
                $nomArtistic .=" ";
            }
            $nomArtistic .= $nom;
            $contador++;
        }
    } else {
        $nomArtistic = $fila['nomArtistic'];
    }

    // Info álbum
    $infoAlbum = json_decode($fila['infoAlbum'], true);

    $url = $fila['albumFamoso'];

    preg_match('/(youtu\.be\/|v=)([^&?]+)/', $url, $matches);
    $videoId = $matches[2] ?? '';

    $album = "https://www.youtube.com/embed/" . $videoId;

    $url = $fila['videoMusical'];

    preg_match('/(youtu\.be\/|v=)([^&?]+)/', $url, $matches);
    $videoId = $matches[2] ?? '';

    $videoMusical = "https://www.youtube.com/embed/" . $videoId;

    // HTML
    $html = "<!DOCTYPE html>
    <html lang='ca'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='/css/music.css'>
        <title>{$fila['nom']}</title>
    </head>
    <body>

    <div>

        <h1>{$fila['nom']}</h1>
        
        <div>
            <img src='{$fila['foto']}' alt='Foto de {$fila['nom']}'>
        </div>

        <h3>$nomArtistic</h3>
        
        <p>{$fila['biografia']}</p>

        <div>
            <iframe width='560' height='315'
                src='{$videoMusical}'
                frameborder='0'
                allowfullscreen>
            </iframe>
        </div>

        <div>
            {$infoAlbum['nom']}
        </div>

        <div>
            {$infoAlbum['any']}
        </div>

        <div>
            <img src='{$fila['portadaAlbumFamoso']}' alt='Portada álbum'>
        </div>

        <div>
            <iframe width='560' height='315'
                src='{$album}'
                frameborder='0'
                allowfullscreen>
            </iframe>
        </div>

    </div>

    </body>
    </html>";

    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});


$app->run();

?>