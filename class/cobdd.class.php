<?php
class cobdd
{
    private const HOST = "localhost";
    private const NAME = "vtc";
    private const USERNAME = "root";
    private const PASSWORD = "";

    public function connect()
    {
        try {
            $bdd = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::NAME . ";charset=utf8", self::USERNAME, self::PASSWORD);
            //On définit le mode d'erreur de PDO sur Exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        }
        /*On capture les exceptions si une exception est lancée et on affiche
        *les informations relatives à celle-ci*/ catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
