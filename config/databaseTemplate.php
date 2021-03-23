<?php

define('DB_DSN', '');

define('DB_USER', '');

define('DB_PASS', '');

define('DB_OPTIONS', array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//PDO::FETCH_ASSOC: retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats
//PDO::ERRMODE_EXCEPTION: Emet une Exception
