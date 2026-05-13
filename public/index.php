<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->get('/', function (Request $request, Response $response) {

    require_once __DIR__ . '/../includes/dbOpenConn.php';
    require_once __DIR__ . '/../includes/header.php';

    $resultats = $db->query("SELECT * FROM artistes");

    $html = "<!DOCTYPE html>
    <html lang='ca'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='css/portada.css'>
        <title>Página Principal</title>
    </head>
    <body>
    <p>
    La teva cita setmanal amb la cultura global. Descobreix la història i l'impacte dels 
    artistes i grups que defineixen la nostra era.
    <p>
    <h1 >BTS - 방탄소년단 - Bulletproof Boy Scouts</h1>
    <p>
        BTS, també coneguts com a Bangtan Sonyeondan, és un grup sud-coreà format per set membres 
        (RM, Jin, Suga, J-Hope, Jimin, V i Jungkook) que ha redefinit el panorama musical global.
        Van debutar l'any 2013 sota el segell Big Hit Entertainment amb un estil marcadament hip-hop
        i lletres que denunciaven les pressions socials sobre els joves. Amb el temps, la seva música
        ha evolucionat cap a una fusió de gèneres, explorant temes profunds com l'amor propi, la salut
        mental i la superació personal. Gràcies al suport incondicional del seu exèrcit de fans,
        conegut com a ARMY, BTS s'ha convertit en el primer grup de K-pop a liderar les llistes de vendes 
        mundials i a parlar davant les Nacions Unides, transformant-se en autèntics icones culturals del segle XXI.
    </p>
    <h2> Membres BTS </h2>
    <div class='container'>
    ";
    

    while ($fila = $resultats->fetchArray(SQLITE3_ASSOC)) {
        
        $html .= "
            <div class='card'>
            <a href='/" . $fila['id'].  "'>  
                <img src='{$fila['foto']}' alt='Foto de {$fila['nom']}'> <br> <br> 
                <p class='nombre'> {$fila['nom']} </p>
                </a> <br>
            </div>
        ";
    
    }

    $html .= "</div></body></html>";

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