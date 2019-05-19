<?php //Connexion à la BDD
require_once __DIR__ . '/../config.php';
try  {        
    $host       = $bddhost;
    $username   = $bddusername;
    $password   = $bddpassword;
    $dbname     = $bddname;
    $dsn        = "mysql:host=$host;dbname=$dbname";
    $options    = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                  );
    function escape($html) {
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

        $connection = new PDO($dsn, $username, $password, $options);

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
?>