<?php 
session_start();
/* Permet de gérer la récupération des formulaires
 * en fonction de la variable etat(session) et lien(post)
 */
if (isset($_POST['lien'])) {

//Formulaire de la page d'accueil
if ($_POST['lien'] == 1 && $_SESSION['etat'] == 0 && isset($_POST['mail2'])) {
	include __DIR__ . '/../fonction/accueil.php';
} //Bouton de renvoie d'email de vérification
elseif ($_POST['lien'] == 2 && $_SESSION['etat'] == 1 && isset($_POST['resend'])) {
	include __DIR__ . '/../fonction/verif1.php';
} //Formulaire de vérification
elseif ($_POST['lien'] == 3 && $_SESSION['etat'] == 1 && isset($_POST['code'])) {
	include __DIR__ . '/../fonction/verif2.php';
} //Formulaire final d'envoi
elseif ($_POST['lien'] == 4 && $_SESSION['etat'] == 2) {
	include __DIR__ . '/../fonction/traitement.php';
	//exec("php-cli  /home/project/projet-mail/fonction/envoi.php > /tmp/execoutput.txt 2>&1 &");
} else {
	$msg = "Erreur";
	include __DIR__ . '/../pages/accueil.php';
}

}
//Bouton retour
if (isset($_POST['retour'])) {
	include __DIR__ . '/../fonction/retour.php';
}
//Redirection si cette page est accéder directement
if (!isset($_POST['retour']) && !isset($_POST['lien'])) {
	header('location: /');
}
?>