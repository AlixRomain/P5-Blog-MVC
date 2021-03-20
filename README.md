# Projet 5 - BLOG MVC



### Mise en Place du projet 

I    Cloner le projet sur votre dépôt local ` git clone https://github.com/AlixRomain/P5-Blog-MVC/`  
II   Installer les dépendances depuis votre terminal `composer install`  
III  Installer la blog-p5.sql dans config sur Wamp ou Xamp 
IV   Accès et login


### Dossiers de paramètrages

I   Mettre à jour config/database.php  

Pour que vous puissiez vous connecter à votre base de données, veuillez modifier le fichier avec vos identifiants, hôte et nom de base de données
Ces informations sont trouvables chez votre hébergeur.

    <?php
     define('DB_DSN', 'mysql:host=localhost;dbname=(nom_de_la_bdd);charset=UTF8');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_OPTIONS', array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

II   Mettre à jour config/dataMail.php  

Fichier à modifier pour l'envoit de mail. Création de compte | Contact | réinitialiser password

    <?php
    define('MAIL_SMTP', ''); //smtp.example.com
    define('MAIL_PORT', ''); // 25 ou 457 
    define('MAIL_USERNAME', ''); //votre adresse mail ou le serveur dédié
    define('MAIL_PASSWORD', ''); // Le pass associé au service
    
    Attention penser à modifier l'accès sécurisé des applications si vous utiliser gmail via le lien
     https://myaccount.google.com/lesssecureapps?pli=1&rapt=AEjHL4NtZsgTuwbwyJeCKUZPGKHGkJFuGmJvH495eUNt-dVua9gHYFMlhmyPRf2z_yf6XzMiYrGlG3aR3Uh0IvxerqN-4Ajkeg

III   Importer le fichier blog-p5.sql dans votre PHP MyAdmin 


IV Compte & Login

ADMINISTRATEUR

log-> toto@toto.com
pass->toto

UTILISATEUR

log-> tata@tata.com
pass->toto


