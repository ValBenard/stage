<?php
session_start();
//Connexion à la BDD
require_once __DIR__ . '/../fonction/cnxbdd.php';

//include __DIR__ . '/../pages/verif.php';



        //Test du code de vérification
        $vmail = $_SESSION['mail2'];
        $sql = "SELECT codeverif FROM verif WHERE emailverif='$vmail'";
        $result = $connection->query($sql);
        //echo "<br>";
        //var_dump($result);  
        $values = $result->fetchAll(PDO::FETCH_ASSOC);
        $test = $values[0]['codeverif'];
        
        if ($test == trim($_POST['code'])){
            $sql = "DELETE FROM verif WHERE emailverif='$vmail'";
            $result = $connection->query($sql);
            //var_dump($result);
            $_SESSION['etat'] = 2;
            include __DIR__ . '/../pages/lire.php';
        } else {
            $msg = 'Le code est incorrecte.';
            include __DIR__ . '/../pages/verif.php';
        }
?>

