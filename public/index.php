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

    $musica;
    switch ($id){
        case 1: 
            $musica = 'music/RM_Indigo.mp3';
            break;
        case 2: 
            $musica = 'music/Jin_Happy.mp3';
            break;
        case 3: 
            $musica = 'music/AgustD_D-DAY';
            break;
        case 4: 
            $musica = 'music/J-Hope_Hope.mp3';
            break;
        case 5: 
            $musica = 'music/Jimin_Face.mp3';
            break;
        case 6: 
            $musica = 'music/V_Lay-Over.mp3';
            break;
        case 7: 
            $musica = 'music/Jungkook_Golden.mp3';
            break;

    }

    // HTML
    $html = "<!DOCTYPE html>
    <html lang='ca'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='/css/music.css'>
        <script src='/js/vinilo.js'></script>
        <title>{$fila['nom']}</title>
    </head>
    <body>
        
    <div class='contenedor'>
    <a href='/'>&larr; Inici</a>
        <div class='vinilo'>
            <img src='{$fila['portadaAlbumFamoso']}' alt='Portada del album {$fila['portadaAlbumFamoso']}'>
            <audio class='audio'>
                <source src=$musica type='audio/mpeg'>
            </audio>
        </div>
        
        <div class='principal'>
            <seccion class='tarjeta'>
                <div class='img'>
                    <img src='{$fila['foto']}' alt='Foto de {$fila['nom']}'>
                </div>

                <div class='tarjeta-contenido'>
                    <h3>$nomArtistic</h3>
                    <h1>{$fila['nom']}</h1>
                    <p>{$fila['biografia']}</p>
                </div>
            </seccion>
        
            <iframe width='560' height='315'
                src='{$videoMusical}'
                frameborder='0'
                allowfullscreen>
            </iframe>
        </div>
        

        <seccion class='album'>
            <h1>ALBUM</h1>
            <div id='info-album'>
                <div class='info'>
                    <h2>{$infoAlbum['nom']}</h2>

                    <h3>{$infoAlbum['any']}</h3>
                </div>
                <div class='img'>
                    <img src='{$fila['portadaAlbumFamoso']}' alt='Portada álbum'>
                </div>
            </div>
            <iframe width='560' height='315'
                src='{$album}'
                frameborder='0'
                allowfullscreen>
            </iframe>
        </seccion>

    </div>

    </body>
    </html>";

    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});


$app->run();

?>