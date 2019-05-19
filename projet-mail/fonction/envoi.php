<?php 
//Connexion BDD
require_once __DIR__ . '/../fonction/cnxbdd.php';
session_start();
?>


<?php
echo date('Y-m-d H:i:s')."\n";

echo "Les boîtes suivantes sont à récupérer :\n";
//boîtes à récupérer
$vlist1 = unserialize($argv[1]);
foreach($vlist1 as $vlist)
{
echo $vlist,"\n";
}
echo "----------------\n";

//echo $_SESSION['mail2'].'<br>';
//echo $_SESSION['mdpmail2'].'<br>';

$mail = $argv[2];		//Email qui reçoit le CSV
$Login = $argv[3];	//Email que l'on récupère + son MDP
$MotPasse = $argv[4];
echo "Pour $mail \n";
//On attribue l'url imap à utiliser (défini dans accueil.php)
$imap = $argv[5];

//Lecture de boîte mail et création fichier CSV.

//$mbox = imap_open("{ex.mail.ovh.net:993/imap/ssl/novalidate-cert}", $Login, $MotPasse);
$mbox = imap_open("{".$imap.":993/imap/ssl/novalidate-cert}", $Login, $MotPasse);
if($mbox != false) {
	$folders = imap_listmailbox($mbox, "{".$imap.":993}", "*");
	
	if ($folders == false) {
		echo "Appel échoué\n";
	} else {
		//On commence à écrire le fichier CSV que l'on souhait envoyer
		$fp = fopen(__DIR__ . '/../file/'.$Login.'.csv', 'w');
		fputcsv($fp, array("Destinataire","Prénom, Nom","Emetteur"));

		//On parcours chaque boîtes mail
		foreach ($folders as $val) {
			$MonDossier = trim(str_replace("{".$imap.":993}", "", $val));	
			$mbox2 = imap_open("{".$imap.":993/imap/ssl/novalidate-cert}".$MonDossier, $Login, $MotPasse);
			if($mbox2 != false) {
				$MC=imap_check($mbox2);
				//Lecture des dossiers sélectionnées uniquement
				foreach($vlist1 as $vlist) {
					//On récupère seulement les dossiers que l'ont a coché précedemment
					if ($MonDossier == $vlist) {
						if($MC->Nmsgs!=0){
							echo "- $MonDossier \n";
							$result = imap_fetch_overview($mbox2, "1:{$MC->Nmsgs}", 0);
							//Lecture de tout les messages (si il en existe) du dossier actuel
							foreach ($result as $overview) {
								//echo $overview."<br>";
								//echo "\nMail : ".$MC->Nmsgs."\n";

								//array des infos du mail, ne récupère pas les destinataires multiples mais juste le 1e
							//	$header = imap_header($mbox2, $overview->msgno);

								//array des infos du mail complete, mais plus long à traiter
								$header2 = imap_fetchheader($mbox2,$overview->msgno);
								$header = imap_rfc822_parse_headers($header2);

								//Variable qui permet de construire le CSV
								$csvto = "";
								$csvtoname = "";
								$csvfrom = "";

								//$csvdate = $header->date;
								if(isset($header->from)){
									foreach($header->from as $Donnee){
										$Adresse = $Donnee->mailbox."@".$Donnee->host;
										//echo "From : ".$Adresse." | ".$Donnee->personal."<br>";
										//if(!isset($ListeMail[$Adresse])){
											//fputcsv($fp, array($Adresse,$Donnee->personal));
											$csvfrom = $Adresse;
											//$ListeMail[$Adresse] = 1;
										//}
									}
								}
								if(isset($header->to)){
									foreach($header->to as $Donnee){
										$Adresse = $Donnee->mailbox."@".$Donnee->host;
										//echo "To : ".$Adresse." | ".$Donnee->personal."<br>";

										if(!isset($ListeMail[$Adresse])){
											//fputcsv($fp, array($Adresse,$Donnee->personal));
											$csvto = $Adresse;
											$csvtoname = $Donnee->personal;
											//Construction du CSV en fonction des destinataires
											fputcsv($fp, array($csvto,$csvtoname,$csvfrom));

											//On insère les adresses récupérées dans la BDD, sans doublons
											$sql = "SELECT * FROM archive WHERE mailP='$mail' AND mailR='$Login' AND destinataire='$csvto' AND emetteur='$csvfrom'";
											$result = $connection->query($sql);
											//var_dump($result);
											$values = $result->fetchAll(PDO::FETCH_ASSOC);
											//$test2 = $values[0]['mailP'];
											//echo "<br>mailP : ".$test2;
											//var_dump($values);
											if (empty($values)) {
												//echo "oui";
												$sql = "INSERT INTO archive(mailP,mailR,destinataire,personal,emetteur) values ('$mail','$Login','$csvto','$csvtoname','$csvfrom')";
												$result = $connection->query($sql);
												//var_dump($result);
											} //else {echo "non";}

											//Cette variable sert à marquer les destinataires déjà présent dans le CSV pour éviter les doublons
											$ListeMail[$Adresse] = 1;
										}
									}
								}

								//fputcsv($fp, array($csvto,$csvtoname,$csvdate,$csvfrom));
								/*
								if(isset($header->cc)){
									foreach($header->cc as $Donnee){
										$Adresse = $Donnee->mailbox."@".$Donnee->host;
										if(!isset($ListeMail[$Adresse])){
											//fputcsv($fp, array($Adresse,$Donnee->personal));
											echo "<b>".$Adresse."</b>";
											//$ListeMail[$Adresse] = 1;
										}
									}
								}
								if(isset($header->bcc)){
									foreach($header->bcc as $Donnee){
										$Adresse = $Donnee->mailbox."@".$Donnee->host;
										if(!isset($ListeMail[$Adresse])){
											//fputcsv($fp, array($Adresse,$Donnee->personal));
											echo "<b>".$Adresse."</b>";
											//$ListeMail[$Adresse] = 1;
										}
									}
								}*/
							}
						}
					}
				}
				imap_close($mbox2);
			}else{
				echo "Echec ".$MonDossier."\n";
			}
		}
		//Fermeture du CSV
		fclose($fp);

		//envoie du CSV par mail
		$destination = $mail;
        $subject = "Récupération d'adresse Email";
        $body = "<html><head></head><body>Voici la liste de destinataires pour l'adresse \"$Login\".</body></html>";
		$altbody = "Voici la liste de destinataires pour l'adresse \"$Login\".";
		$pj = __DIR__ . '/../file/'.$Login.'.csv';
		$nompj = "Récupération.csv";
        include __DIR__ . '/../fonction/sendmail.php';
	}
	imap_close($mbox);
}else{
	echo "Echec connexion IMAP\n";
}
echo date('Y-m-d H:i:s')."\n";
//echo "<br>$Login.csv<br>";
//echo $_SESSION['mail1'];

//On supprime les variables SESSION pour permettre une nouvelle récupération
//Et suppression du fichier CSV
unlink(__DIR__ . '/../file/'.$Login.'.csv');

echo "FIN--------------";
sleep(10);
unlink(__DIR__."/../log/log$Login.txt");
?>
