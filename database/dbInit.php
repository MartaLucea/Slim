<?php

require_once __DIR__ . '/../includes/dbOpenConn.php';

$db->exec("CREATE TABLE IF NOT EXISTS artistes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    nomArtistic TEXT NOT NULL,
    biografia TEXT NOT NULL,  
    foto TEXT NOT NULL,
    videoMusical TEXT NOT NULL,
    infoAlbum TEXT NOT NULL,
    portadaAlbumFamoso TEXT NOT NULL,
    albumFamoso TEXT NOT NULL
)");


$members = [
    [
        "nom" => "Kim Nam-joon",
        "nomArtistic" => json_encode(["RM", "Rap Monster", "Runch Randa"]),
        "biografia" => "Kim Namjoon, també conegut com a RM, és un raper, compositor i productor sud-coreà nascut el 12 de setembre de 1994 a Ilsan, Corea del Sud. És el líder de BTS, un dels grups de K-pop més populars del món, i també ha publicat música en solitari.
                    Abans de debutar amb BTS el 2013, Namjoon ja treballava en l’escena del hip-hop underground amb el nom de Runch Randa. A més de la música, destaca per les seves lletres reflexives i pel seu interès per la poesia i l’art",
        "foto" => "https://cdn.milenio.com/uploads/media/2021/09/11/kim-namjoon-integrante-bts-celebra_0_0_1200_747.jpg",
        "videoMusical" => "https://youtu.be/u18be_kRmC0?list=RDu18be_kRmC0",
        "infoAlbum" => json_encode(["nom" => "Indigo", "any" => "2022"]),
        "portadaAlbumFamoso" => "https://www.culturajoven.es/wp-content/uploads/2022/12/portada_indigo_rm-1024x1024.jpg",
        "albumFamoso" => "https://youtu.be/yMwBqbrUx_E?list=RDyMwBqbrUx_E"
    ],
    [
        "nom" => "Kim Seok-jin",
        "nomArtistic" => json_encode(["Jin"]),
        "biografia" => "Kim Seok-jin, conegut com a Jin, és un cantant, compositor i ballarí sud-coreà nascut el 4 de desembre de 1992 a Gwacheon, Corea del Sud. És membre de BTS des del 2013, on actua principalment com a vocalista, i també ha desenvolupat activitats en solitari.
                    Abans de debutar, va estudiar interpretació a la Universitat Konkuk, i el seu debut amb BTS va arribar amb la cançó «No More Dream». Des de llavors s’ha fet molt conegut per la seva veu, la seva presència escènica i temes propis com «Awake» i «Super Tuna».",
        "foto" => "https://www.actitudfem.com/media/files/quien-es-jin-bts-red.jpg",
        "videoMusical" => "https://youtu.be/ArHGiOxYwHM",
        "infoAlbum" => json_encode(["nom" => "Happy", "any" => "2024"]),
        "portadaAlbumFamoso" => "https://i.scdn.co/image/ab67616d0000b2731dcf069284321bef1306d6ec",
        "albumFamoso" => "https://youtu.be/U4yNYavTnhE?list=RDU4yNYavTnhE"
    ],
    [
        "nom" => "Min Yoon-gi",
        "nomArtistic" => json_encode(["Suga", "Agust D"]),
        "biografia" => "Suga, també conegut com a Agust D, és el nom artístic de Min Yoon-gi, un raper, compositor i productor sud-coreà nascut el 9 de març de 1993 a Daegu. Forma part de BTS des del 2013 i és conegut pel seu estil directe, les seves lletres introspectives i la seva feina en solitari.
                    Abans de debutar, va començar en l’escena underground del rap i va entrar a Big Hit després de superar una audició el 2010. En la seva carrera en solitari ha publicat projectes com Agust D, D-2 i D-Day.",
        "foto" => "https://imagenes.excelsior.com.mx/files/main_image_375_249/uploads/2025/06/22/69205e7d67dcf.jpeg",
        "videoMusical" => "https://youtu.be/qGjAWJ2zWWI?list=RDqGjAWJ2zWWI",
        "infoAlbum" => json_encode(["nom" => "D-DAY", "any" => "2023"]),
        "portadaAlbumFamoso" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHuXgGud70N0KXSwn9134f2TQNMeTo5pUCFw&s",
        "albumFamoso" => "https://youtu.be/hwYLKaNXriU?list=RDhwYLKaNXriU"
    ],
    [
        "nom" => "Jung Ho-seok",
        "nomArtistic" => json_encode(["J-Hope", "Smile Hoya"]),
        "biografia" => "J-Hope, també conegut com a Jung Ho-seok o Jung Hoseok, és un raper, ballarí, cantant i productor sud-coreà nascut el 18 de febrer de 1994 a Gwangju. És membre de BTS des del 2013 i destaca com a ballarí principal i per la seva energia positiva.
                    Abans de debutar, era ballarí underground i feia servir el nom de Smile Hoya. En solitari, ha publicat treballs com Hope World i Jack In The Box.",
        "foto" => "https://akamai.sscdn.co/tb/letras-blog/wp-content/uploads/2025/10/1546874-BTS-J-Hope-1024x614.jpg",
        "videoMusical" => "https://youtu.be/HK3LjI2InOg?list=RDHK3LjI2InOg",
        "infoAlbum" => json_encode(["nom" => "HOPE ON THE STREET VOL.1", "any" => "2024"]),
        "portadaAlbumFamoso" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6zXZ_mH57XoDpCeZjWT-SRJdNFZhbPcAI6g&s",
        "albumFamoso" => "https://youtu.be/a-WUhIGE-Jg?list=RDa-WUhIGE-Jg"
    ],
    [
        "nom" => "Park Ji-min",
        "nomArtistic" => json_encode(["Jimin"]),
        "biografia" => "Jimin, de nom complet Park Ji‑min, és un cantant, compositor, ballarí i model sud‑coreà nascut el 13 d’octubre de 1995 a Busan. És membre de BTS des del seu debut el 13 de juny de 2013, on ocupa la posició de lead vocalista i principal ballarí.
                    A més de treballar dins el grup, ha publicat temes en solitari com «Lie», «Serendipity» i «Filter» sota el nom de BTS, i el 2023 va editar el seu primer àlbum en solitari, FACE.",
        "foto" => "https://nolae.es/cdn/shop/articles/jimin-bts-profil-924297.jpg?v=1748868235&width=1920",
        "videoMusical" => "https://youtu.be/Av9DvtlJ9_M?list=RDAv9DvtlJ9_M",
        "infoAlbum" => json_encode(["nom" => "FACE", "any" => "2023"]),
        "portadaAlbumFamoso" => "https://i.redd.it/p6xw3vn3xrma1.jpg",
        "albumFamoso" => "https://youtu.be/CiN0SXFnnwg?list=RDCiN0SXFnnwg"
    ],
    [
        "nom" => "Kim Tae-hyung",
        "nomArtistic" => json_encode(["V"]),
        "biografia" => "V, de nom complet Kim Taehyung, és un cantant, compositor, ballarí, model i actor sud‑coreà nascut el 30 de desembre de 1995 a Daegu. És membre de BTS des del seu debut el 13 de juny de 2013, on ocupa les posicions de vocalista i «visual» (imatge del grup).
                    Dins BTS, ha cantat solos com «Stigma», «Singularity» i «Inner Child», i ha participat en bandes sonores com «Sweet Night» per la sèrie Itaewon Class. El 2023 va publicar el seu primer àlbum en solitari, Layover, amb el qual va consolidar la seva carrera fora del grup.",
        "foto" => "https://radiostar.harianjogja.com/assets/2023/02/V-BTS--800x400.jpg",
        "videoMusical" => "https://youtu.be/62peQdQv4uo?list=RD62peQdQv4uo",
        "infoAlbum" => json_encode(["nom" => "Lay Over", "any" => "2023"]),
        "portadaAlbumFamoso" => "https://cdn-images.dzcdn.net/images/cover/d46aa3a3b70786cb2137c878f1a76946/0x1900-000000-80-0-0.jpg",
        "albumFamoso" => "https://youtu.be/Ppte0Pa7WJA?list=RDPpte0Pa7WJA"
    ],
    [
        "nom" => "Jeon Jung-kook",
        "nomArtistic" => json_encode(["Jungkook"]),
        "biografia" => "Jeon Jung-kook, conegut artísticament com a Jungkook, és un cantant sud-coreà nascut a Busan l’1 de setembre de 1997. És el vocalista principal de BTS, grup amb què va debutar el 2013, i també ha destacat com a solista amb cançons com “Begin”, “Euphoria” i “My Time”.   
                    A més de la seva veu, Jungkook és conegut per la seva versatilitat com a ballarí i per la seva gran popularitat dins del K-pop.",
        "foto" => "https://nolae.es/cdn/shop/articles/jungkook-bts-profil-658768.jpg?v=1724161518&width=1200",
        "videoMusical" => "https://youtu.be/QU9c0053UAU?list=RDQU9c0053UAU",
        "infoAlbum" => json_encode(["nom" => "Golden ", "any" => "2023"]),
        "portadaAlbumFamoso" => "https://cdn-images.dzcdn.net/images/cover/5d316d47d96b7c8f5a029dffe1f38981/1900x1900-000000-80-0-0.jpg",
        "albumFamoso" => "https://youtu.be/cyAkEgxZZgk?list=RDcyAkEgxZZgk"
    ]
];

$stmt = $db->prepare("
INSERT INTO artistes (nom, nomArtistic, biografia, foto, videoMusical, infoAlbum, portadaAlbumFamoso, albumFamoso)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
foreach ($members as $m) {

    $stmt->bindValue(1, $m["nom"]);
    $stmt->bindValue(2, $m["nomArtistic"]);
    $stmt->bindValue(3, $m["biografia"]);
    $stmt->bindValue(4, $m["foto"]);
    $stmt->bindValue(5, $m["videoMusical"]);
    $stmt->bindValue(6, $m["infoAlbum"]);
    $stmt->bindValue(7, $m["portadaAlbumFamoso"]);
    $stmt->bindValue(8, $m["albumFamoso"]);

    $stmt->execute();
}

echo "fet";