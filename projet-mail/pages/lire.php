<?php
session_start();

//On attribue l'url imap à utiliser (défini dans fonction/accueil.php)
$imap = $_SESSION['imap'];


//echo $imap."<br>";



$count = 0;
//Lecture et affichage de la boîte mail
$Login = $_SESSION['mail2'];
$MotPasse = $_SESSION['mdpmail2'];
//$mbox = imap_open("{ex.mail.ovh.net:993/imap/ssl/novalidate-cert}", $Login, $MotPasse);
$mbox = imap_open("{".$imap.":993/imap/ssl/novalidate-cert}", $Login, $MotPasse);

//On stock le formulaire dans cette variable, pour pouvoir la réafficher rapidement si l'utilisateur quitte le site.
$_SESSION['formulaire'] = "<form class=\"form\" action=\"controller.php\" method=\"post\">"; // id=\"form1\"
if($mbox != false) {
    //Checkbox qui permet de cocher toutes les checkboxes
    $_SESSION['formulaire'] .= "<div class=\"custom-control custom-checkbox pl-0\"><input id=\"checkall\" class=\"custom-control-input\" type=\"checkbox\" onClick=\"toggle(this)\"><label class=\"custom-control-label\" for=\"checkall\">Tout cocher</label></div><br>";
    $_SESSION['formulaire'] .= $_SESSION['mail2']." :";
	$folders = imap_listmailbox($mbox, "{".$imap.":993}", "*");
	if ($folders == false) {
		echo "Appel échoué\n";
	} else {
		foreach ($folders as $val) {
            $MonDossier = trim(str_replace("{".$imap.":993}", "", $val));	
			//$mbox2 = imap_open("{".$imap.":993/imap/ssl/novalidate-cert}".$MonDossier, $Login, $MotPasse);
			//if($mbox2 != false) {
                //$MC=imap_check($mbox2);

                //Construction d'un formulaire en fonction des dossiers de la boîte mail récupéré
                //Avec pour valeur le nom du dossier au quel il correspond
                //+ Filtre qui ne coche pas automatiquement les dossiers comportements le mots "spam" (modifiable)
                if (strpos(strtolower($MonDossier),"spam") == false) {
                    $_SESSION['formulaire'] .=  '<div class="custom-control custom-checkbox pl-0"><input id="cb'.$count.'" class="custom-control-input" type="checkbox" name="select[]" value="'.$MonDossier.'" checked><label class="custom-control-label" for="cb'.$count.'"><b>'.substr($MonDossier,strpos($MonDossier, "/"))./*" : ".$MC->Nmsgs." mail(s)*/"\n</b></label></div>";
                } else {
                    $_SESSION['formulaire'] .=  '<div class="custom-control custom-checkbox pl-0"><input id="cb'.$count.'" class="custom-control-input" type="checkbox" name="select[]" value="'.$MonDossier.'"><label class="custom-control-label" for="cb'.$count.'"><b>'.substr($MonDossier,strpos($MonDossier, "/"))./*" : ".$MC->Nmsgs." mail(s)*/"\n</b></label></div>";
                }
                $count += 1;
                //echo $MonDossier."<br>";
              //  imap_close($mbox2);
            //}else{
			//	echo "Echec ".$MonDossier."\n";
			//}
        }
    }
    imap_close($mbox);
    $_SESSION['formulaire'] .=  "<input type=\"hidden\" name=\"lien\" value=4>";
    $_SESSION['formulaire'] .=  "<input id=\"envoi1\" type=\"submit\" value=\"Envoyer\" name=\"envoyer\" onclick=\"test()\" style=\"display: none\"></form>";
}else{
    echo "Echec connexion IMAP\n";
    //session_unset();
    //session_destroy();
    //echo "<form action=\"\" method=\"post\"><input type=\"submit\" value=\"Retour\" name=\"retour\"></form>";
}

//Supression de tout les retours à la ligne et tabulations
$_SESSION['formulaire'] = str_replace("\n","",$_SESSION['formulaire']);
$_SESSION['formulaire'] = str_replace("\r","",$_SESSION['formulaire']);
$_SESSION['formulaire'] = str_replace("\t","",$_SESSION['formulaire']);
include __DIR__ . '/../pages/lire1.php';
?>

<!--
<form class="form" action="fonction/retour.php" method="post">
    <input type="hidden" name="retour" value="1">
    <input type="submit" value="Annuler" name="back">
</form>
-->
