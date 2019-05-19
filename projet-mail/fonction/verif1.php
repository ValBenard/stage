<?php
session_start();

//Condition permettant de savoir si la BDD à déjà été ouverte par accueil.php (fonction), évite de bloquer la page
if ($bdd != 1) {
//Connexion à la BDD
require_once __DIR__ . '/../fonction/cnxbdd.php';
}



//Création d'un code unique
$code = uniqid();
//echo "[ ".$code." ]<br>";

//vmail est le mail que l'on souhaite récupérer
//et sur lequel on fait une vérification
$vmail = $_SESSION['mail2'];

//echo $_SESSION['mail1'];
//echo $_SESSION['mail2'];
//echo $_SESSION['mdpmail2'];

//Suppression des anciens codes de verif datant de plus d'1 heure
$sql = 'DELETE FROM `verif` WHERE NOW() > ADDTIME(dateverif, "1:00:00");';
$result = $connection->query($sql);
//echo "<br>";
//var_dump($result);

//Envoie d'un mail de verif si aucun code de verif existe
$sql = "SELECT idverif FROM verif WHERE emailverif='$vmail'";
    $result = $connection->query($sql);
    //var_dump($result);
    $values = $result->fetchAll(PDO::FETCH_ASSOC);
    $test2 = $values[0]['idverif'];
    //echo "<br>bb : ".$test2."<br>";
    if (empty($test2)) {
        //echo "n'existe pas<br>";
        $sql = "INSERT INTO verif(idverif,emailverif,codeverif) values ('','$vmail','$code')";
        $result = $connection->query($sql);
        //var_dump($result);
        
        //mailconfirme($code,$_SESSION['mail2']);
        $destination = $_SESSION['mail2'];
        $subject = "Code de vérification";
        $body = "<html><head></head><body>Code : $code</body></html>";
        $altbody = "Code : $code";
        $msg = "Un code de validation a été envoyé à ".$_SESSION['mail2'].".";
        include __DIR__ . '/../fonction/sendmail.php';
    }
    else {
        //echo "Existe déjà<br>";
    }



//Donne un nouveau code de vérification à la demande de l'utilisateur.
//En respectant un interval de 30s (modifiable) par email pour eviter le spam
if ($_POST['resend'] == 1){
    $sql = 'SELECT * FROM verif WHERE emailverif=\''.$vmail.'\' AND NOW() < ADDTIME(dateverif, "0:00:30")';
    $result = $connection->query($sql);
    $values = $result->fetchAll(PDO::FETCH_ASSOC);
    if (empty($values)) {
        $sql = "DELETE FROM verif WHERE emailverif='$vmail'";
        $result = $connection->query($sql);
        //var_dump($result);

        $sql = "INSERT INTO verif(idverif,emailverif,codeverif) values ('','$vmail','$code')";
        $result = $connection->query($sql);
        //var_dump($result);
        //mailconfirme($code,$_SESSION['mail2']);
        $destination = $_SESSION['mail2'];
        $subject = "Code de vérification";
        $body = "<html><head></head><body>Code : $code</body></html>";
        $altbody = "Code : $code";
        $msg = "Un autre code de validation a été envoyé à ".$_SESSION['mail2'].".";
        include __DIR__ . '/../fonction/sendmail.php';
    } else {
        $msg = "Attendez 30 secondes avant d'envoyer un nouveau code";
    }
}

include __DIR__ . '/../pages/verif.php';

?>