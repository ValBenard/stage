<?php
session_start();
/* La variable de session "etat" permet d'indiquer à l'index
 * où il doit rediriger l'utilisateur.
 * Il indique à quel étape de la récupération l'utilisateur se situe.
 * Sert principalement de sécurité
 * 0 : Accueil
 * 1 : Vérification
 * 2 : Lecture et choix des boîtes mail à récupérer
 * 3 : Envoi du mail
 */
//session_unset();session_destroy();

/*if ($_SESSION['etat'] == 1) {
	include __DIR__ . '/../fonction/verif1.php';
}*/
if ($_SESSION['etat'] == 2) {
	include __DIR__ . '/../pages/lire1.php';
} 
/*elseif ($_SESSION['etat'] == 3) {
	include __DIR__ . '/../pages/envoi.php';
}*/
else {
	$_SESSION['etat'] = 0;
	session_unset();
	session_destroy();
	include __DIR__ . '/../pages/accueil.php';
}

//include __DIR__ . '/../pages/index.php';

?>