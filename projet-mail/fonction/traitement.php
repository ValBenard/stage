<script>
$(document).ready(function() {

$('.form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            $('#content').html(data); 
        }
    });
});

});
</script>

<?php 
session_start();
//Vérifie si au moins 1 dossier est selectionné
if (empty($_POST['select'])) {
	$msg = "Veuillez selectionner au moins un dossier.";
	include __DIR__ . '/../pages/lire1.php';
} else {
//echo date('Y-m-d H:i:s')."<br>";
echo "<br><p class=\"mb-4 lead\" style=\"font-size: 1.2rem;\">Votre demande à bien été prise en compte. Nous allons vous envoyer un mail dès que le traitement est terminé.</p>";

//boîtes à récupérer
/*foreach($_POST['select'] as $vlist)
{
echo $vlist,'<br />';
}*/

/* On associe chaque variable pour les envoyer dans une commande linux,
 * qui permettera de ne pas bloquer l'utilisateur sur la page
 * On sérialise la selection de dossier car on ne peut envoyer un Array dans une ligne de commande, 
 * on utilisera unserialize pour traiter cette info.
 */
$select = serialize($_POST['select']);
$mail1 = $_SESSION['mail1'];
$mail2 = $_SESSION['mail2'];
$mdp2 = $_SESSION['mdpmail2'];
$imap = $_SESSION['imap'];

//execution de la commande, écrire les logs dans un fichier permet de laisser executer la tâche même si l'on quitte le site
exec("php ".__DIR__."/../fonction/envoi.php '".$select."' $mail1 $mail2 $mdp2 $imap > ".__DIR__."/../log/log$mail2.txt &");
//On supprime toutes les variables de session pour permettre une nouvelle récupération
session_unset();
session_destroy();
//Bouton menu
echo "<img class=\"img-fluid d-block\" src=\"assets/img/icons.png\">
    <form class=\"form\" action=\"controller.php\" method=\"post\">
        <input type=\"hidden\" name=\"retour\" value=\"1\">
        <input type=\"submit\" value=\"Faire une nouvelle récupération\" name=\"back\" class=\"btn mt-4 btn-block btn-outline-dark rounded\">
    </form>";
}


?>
