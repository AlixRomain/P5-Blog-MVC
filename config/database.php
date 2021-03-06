<?php

define('DB_DSN', 'mysql:host=localhost;dbname=blog;charset=UTF8');

define('DB_USER', 'root');

define('DB_PASS', '');


define('DB_OPTIONS', array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//PDO::FETCH_ASSOC: retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats
//PDO::ERRMODE_EXCEPTION: Emet une Exception
