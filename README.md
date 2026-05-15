# Spotlight Weekly — BTS

Projecte realitzat amb el framework **Slim 4** (PHP) com a exercici de la assignatura. Implementa l'**Opció B (dinàmica)** mostrant les biografies dels 7 membres de BTS amb dades extretes d'una base de dades SQLite.

---

## Vídeo de demostració

[![Video web artistes](https://img.youtube.com/vi/evDf9sMuwMs/maxresdefault.jpg)](https://youtu.be/evDf9sMuwMs)---

## Estructura del projecte

```
Slim-4.x/
├── database/
│   ├── artistes.db         # Base de dades SQLite
│   └── dbInit.php          # Script d'inicialització de la BD
├── includes/
│   ├── dbOpenConn.php      # Obertura de connexió SQLite
│   ├── dbCloseConn.php     # Tancament de connexió SQLite
│   └── header.php          # Capçalera HTML reutilitzable
├── public/
│   ├── index.php           # Punt d'entrada + definició de rutes Slim
│   ├── css/
│   │   ├── portada.css     # Estils de la pàgina principal
│   │   ├── music.css       # Estils de la pàgina de detall
│   │   └── paletaColores.css
│   ├── js/
│   │   └── vinilo.js       # Animació del vinil i control d'àudio
│   ├── img/
│   │   └── vinilo.jpg
│   └── music/              # Àlbums en solitari dels membres (MP3)
├── Slim/                   # Codi font del framework Slim 4
└── composer.json
```
---

## Base de dades

Base de dades **SQLite** (`database/artistes.db`) amb una taula `artistes`:

| Camp | Tipus | Descripció |
|---|---|---|
| `id` | INTEGER PK | Identificador autoincremental |
| `nom` | TEXT | Nom real |
| `nomArtistic` | TEXT (JSON) | Nom(s) artístic(s) |
| `biografia` | TEXT | Biografia en català |
| `foto` | TEXT | URL de la foto |
| `videoMusical` | TEXT | URL del vídeo musical (YouTube) |
| `infoAlbum` | TEXT (JSON) | Nom i any de l'àlbum en solitari |
| `portadaAlbumFamoso` | TEXT | URL de la portada de l'àlbum |
| `albumFamoso` | TEXT | URL del vídeo de l'àlbum (YouTube) |

Els camps `nomArtistic` i `infoAlbum` s'emmagatzemen com a **JSON** per suportar múltiples valors (p. ex. Min Yoon-gi té els noms artístics "Suga" i "Agust D").
