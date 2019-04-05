# PHP MediaServer for ComicGlass

MediaServer written with PHP for [ComicGlass](http://comicglass.net/en/).

*Read this in other languages: [日本語](README.ja.md)*

## How to Setup

1. Upload everything to web server using FTP.
2. Rename "config.dist.php" to "config.php".
3. Create or upload your data directories and files to the same directory.

## How to Setup Authentication

ComicGlass is supporting Basic Authentication.

1. Set up Basic authentication user on web server (".htpasswd" on Apache)
2. Rename ".htaccess.dist" to ".htaccess" and modify to add user.
3. Force HTTPS connection by hosting setting or uncomment the section in ".htaccess"

## Requirements

* PHP 7.2 =< (If you use multi-byte language in directory and file name on Windows system)

