<?php 
session_start();
//if (isset($_POST['custommail'])) {echo "Oui";}
//Connexion à la BDD

require_once __DIR__ . '/../fonction/cnxbdd.php';

		$bdd = 1;
	
	//Fonction qui indique l'OS en fonction du user_agent
	function getOS() { 

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$os_platform  = "Inconnu";

		$os_array     = array(
							'/windows nt 10/i'      =>  'Windows 10',
							'/windows nt 6.3/i'     =>  'Windows 8.1',
							'/windows nt 6.2/i'     =>  'Windows 8',
							'/windows nt 6.1/i'     =>  'Windows 7',
							'/windows nt 6.0/i'     =>  'Windows Vista',
							'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
							'/windows nt 5.1/i'     =>  'Windows XP',
							'/windows xp/i'         =>  'Windows XP',
							'/windows nt 5.0/i'     =>  'Windows 2000',
							'/windows me/i'         =>  'Windows ME',
							'/win98/i'              =>  'Windows 98',
							'/win95/i'              =>  'Windows 95',
							'/win16/i'              =>  'Windows 3.11',
							'/macintosh|mac os x/i' =>  'Mac OS X',
							'/mac_powerpc/i'        =>  'Mac OS 9',
							'/linux/i'              =>  'Linux',
							'/ubuntu/i'             =>  'Ubuntu',
							'/iphone/i'             =>  'iPhone',
							'/ipod/i'               =>  'iPod',
							'/ipad/i'               =>  'iPad',
							'/android/i'            =>  'Android',
							'/blackberry/i'         =>  'BlackBerry',
							'/webos/i'              =>  'Mobile'
						);

		foreach ($os_array as $regex => $value)
				if (preg_match($regex, $user_agent))
						$os_platform = $value;

		return $os_platform;
	}
	//Fonction qui indique le navigateur web en fonction du user_agent
	function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
	}




/* Récupération des données entrées par l'utilisateur
 * dans une variable de session pour pouvoir le traiter
 * sur n'importe quelle page, et éviter les bugs
 * et envoie sur la page de vérification
 */
require_once __DIR__ . '/../config.php';
//Vérification du reCaptcha v3
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'])) {

    // Construction du lien vers l'API google
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = $secretkey; //← clé secrète du captcha v3 à modifier
    $recaptcha_response = $_POST['token'];
    //var_dump($_POST['token']);
    // Récupération du fichier JSON et conversion en Array
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

	// Vérification du score obtenu (modifiable)
	//var_dump($recaptcha);
    if ($recaptcha->score >= 0.5) {
        //echo "oui";
    //Vérification du remplissage des inputs
	if (isset($_POST['custommail']) && !empty($_POST['mail1']) || !isset($_POST['custommail'])) {
		if (!empty($_POST['mail2']) && !empty($_POST['mdpmail2'])) {
			if (filter_var($_POST['mail1'], FILTER_VALIDATE_EMAIL) && isset($_POST['custommail']) || !isset($_POST['custommail'])) {
				if (isset($_POST['confirme'])) {
				//Attribution des valeurs
				//Attribue le mail de reception du mail en fonction du formulaire
				if (isset($_POST['custommail'])) {
					$_SESSION['mail1'] = $_POST['mail1'];
					//echo "mail1";
				} else {
					$_SESSION['mail1'] = $_POST['mail2'];
					//echo "mail2";
				}
					$_SESSION['mail2'] = $_POST['mail2'];
					$_SESSION['mdpmail2'] = $_POST['mdpmail2'];
					//Récupération du domaine de l'email fourni
					$imap = substr($_SESSION['mail2'],strpos($_SESSION['mail2'], "@")+1);
					
					/* Si l'url imap n'est pas fourni (première visite), on parcours la table `imapurl`
					* Cette table contient les cas particuliers d'url imap en fonction des domaines
					* Si rien de correspond dans la table, le script essaie l'adresse imap standard (imap.domaine:993/imap/...)
					* Si l'authentification echoue, on demande à l'utilisateur d'indiquer une adresse imap. 
					* (Si il ne l'indique pas on parcours comme pour la 1ere option)
					* Si il réussi à se connecter avec celle ci, l'adresse est ajouter dans la table `imapurl`
					* Il supprime aussi l'ancien url associer au domaine si il y'en à un pour mettre à jour la base
					*/
					if (empty($_POST['imapurl'])) {
						$ok = 0;
						$sql = "SELECT * FROM imapurl";
						$result = $connection->query($sql);
						$values = $result->fetchAll(PDO::FETCH_ASSOC);

						foreach ($values as $imapurl) {
							//echo "<br> : ".$imapurl['domaine']."-".$imapurl['url'];
							if ($imapurl['domaine'] == $imap) {						
								$imap = $imapurl['url'];
								$ok = 1;
								break;
							}
						}
						if ($ok == 0) {$imap = "imap.".$imap;}

						$mbox = imap_open("{".$imap.":993/imap/ssl/novalidate-cert}", $_POST['mail2'], $_POST['mdpmail2']);
						if($mbox != false) {
							imap_close($mbox);
							$pass = 1;
						}else{
							$msg = "Echec connexion, vérifiez vos identifiants<br>Pensez aussi à autoriser la connexion IMAP";
							$askimap = 1;
						}
					} else {
						$imap = $_POST['imapurl'];
						$mbox = imap_open("{".$imap.":993/imap/ssl/novalidate-cert}", $_POST['mail2'], $_POST['mdpmail2']);
						if($mbox != false) {
							imap_close($mbox);
							$domaine = substr($_SESSION['mail1'],strpos($_SESSION['mail1'], "@")+1);
							//Mise à jour de la liste de domaine
							$sql = "DELETE FROM imapurl WHERE domaine='$domaine'";
							$result = $connection->query($sql);

							$sql = "INSERT INTO imapurl(domaine,url) values ('$domaine','$imap')";
							$result = $connection->query($sql);
							$pass = 1;
						}else{
							$msg = "Echec connexion, vérifiez vos identifiants<br>Pensez aussi à autoriser la connexion IMAP.";
							$askimap = 1;
						}
					}	
				} else {
					$msg = "Veuillez certifier que vous êtes le propriétaire de cette email.";
				}
			} else {
				$msg = "<b>".$_POST['mail1']."</b> n'est pas une adresse valide.";
			}
		} else {
		$msg = "Veuillez remplir tout les champs.";
		}
	} else {
		$msg = "Veuillez remplir tout les champs.";
	}

} else {
	$msg = "Nous ne pouvons pas procéder à cette action. Veuillez réessayer";
}
//var_dump($recaptcha);
//print_r($recaptcha->score);
} else {
	$msg = "Erreur.";
}
	
	//la variable $pass determine si on change d'étape ou non
	//la variable $msg est le message que l'on affiche si il y'a une erreur
	//la variable $askimap fait apparaitre le champ d'url imap dans l'accueil (si la connexion a échoué précedemment)
	if ($pass == 1) {
		$_SESSION['etat'] = 1;
		$_SESSION['imap'] = $imap;
		include __DIR__ . '/../fonction/verif1.php';
	} else {
	include __DIR__ . '/../pages/accueil.php';
	}

	// Requête SQL qui écrit les logs dans `logmail`

	//$mailP = $_POST['mail1'];
	if (isset($_POST['custommail'])) {
		$mailP = $_POST['mail1'];
	} else {
		$mailP = $_POST['mail2'];
	}
	$mailR = $_POST['mail2'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$os = getOS();
	$navigateur = getBrowser();

	$sql = "INSERT INTO logmail(mailP,mailR,ip,os,navigateur,scorebot) values ('$mailP','$mailR','$ip','$os','$navigateur','$recaptcha->score')";
	$result = $connection->query($sql);

	//include __DIR__ . '/../page/verif.php';
	//$imap = "imap.mail.yahoo.com";
	//$imap = "imap-mail.outlook.com";
?>