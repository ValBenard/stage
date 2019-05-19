
<?php require_once __DIR__ . '/../config.php'; ?>
<script>
//Rend visible ou non un champ en rapport avec le type de mail
function clicked() {
	if (document.getElementById('mailcb').checked) {
		document.getElementById('listed').style.display = "inline";
		document.getElementById('mail1').required = true;
		document.getElementById('mail1').type = "email";
	} else {
		document.getElementById('listed').style.display = "none";
		document.getElementById('mail1').required = false;
		document.getElementById('mail1').type = "text";
	}
}

//On garde un input pour conserver les restrictions HTML
//lance la fonction qui envoie les données POST au serveur
//Différent des autres script AJAX à cause du captcha, on précise chaque données envoyées
$(document).ready(function() {
	$('.form').on('submit', function(e) {
		e.preventDefault();
		send1();
	});
});


//$(document).ready(function() {
    //$("#button-accueil").click(function() {
		function send1() {
		attendre1();
        var xmail1 = $("#mail1").val();
        var xmail2 = $("#mail2").val();
        var xmdpmail2 = $("#mdpmail2").val();
		var ximapurl = $("#imapurl").val();
		var xlien = $("#lien").val();
        if (document.getElementById('mailcb').checked) { var xcustommail = 1; }
		if (document.getElementById('confirme').checked) { var xconfirme = 1; }
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo $clientkey; ?>', {action: 'homepage'}) //← Clé client du captcha v3 à modifier
            .then(function(token) {
                // Verify the token on the server.
                var token1 = token;
                console.log(token)
                // Returns successful data submission message when the entered information is stored in database.
                $.post("controller.php", {
                    mail1: xmail1,
                    mail2: xmail2,
                    mdpmail2: xmdpmail2,
                    custommail: xcustommail,
                    imapurl: ximapurl,
					lien: xlien,
					confirme: xconfirme,
                    token: token1
                }, function(data) {
                    $('#content').html(data); 
                    $('#form')[0].reset(); // To reset form fields
                });
            });
        });    
		}
//	});
//});


function attendre1() {
	document.getElementById('msg').innerHTML = "";
   document.getElementById('button-accueil').disabled = true;
   $('#preloader').fadeIn();
   document.getElementById('formaccueil').style = "filter: blur(1px)";
   document.getElementById('preloader').style.display = "";
}


function confirm() {
	if (document.getElementById('confirme').checked) {
		document.getElementById('button-accueil').disabled = false;
	} else {
		document.getElementById('button-accueil').disabled = true;
	}
}
</script>

<?php
//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
//echo $_SERVER['REMOTE_ADDR']." ".$_SERVER['REMOTE_HOST'];

$browser = get_browser(null, true);
print_r($browser);

?>
        
          <h3 class="mb-3">Connexion</h3>
					<!-- Formulaire qui récupère les données de l'utilisateur-->
					<div id="formaccueil">
					<form class="form" action="controller.php" method="post">
					

						<label for="POST-mail2">E-mail : </label>
							<input id="mail2" type="email" name="mail2" class="form-control" required><br>

						<div class="custom-control custom-checkbox pl-0">
							<input id ="mailcb" type="checkbox" name="custommail" onclick="clicked()" class="custom-control-input">
							<label for="mailcb" class="custom-control-label">Récupérer le resultat sur une adresse différente.</label>
						</div>

						<div id=listed style="display: none">
							<label for="POST-mail1">E-mail de réception : </label>
						<input id="mail1" type="email" name="mail1" class="form-control"></div>


							<br>
						<label for="POST-mdpmail2">Mot de passe : </label>
							<input id="mdpmail2" type="password" name="mdpmail2" class="form-control" required>
							<br>
						<?php
							//Champ pour l'url imap, apparait si la connexion echoue
							if (!empty($askimap)) { echo "<label for=\"\">Adresse IMAP : </label>
								<input id=\"imapurl\" type=\"text\" name=\"imapurl\" class=\"form-control\"><br>";}
						?>

						<div class="custom-control custom-checkbox pl-0">
							<input id ="confirme" type="checkbox" name="confirme" onclick="confirm()" class="custom-control-input" required>
							<label for="confirme" class="custom-control-label">Je suis bien le propriétaire de cette boîte mail, continuer.</label>
						</div>
						
							
							<input id="lien" type="hidden" name="lien" value=1>
							<input id="button-accueil" type="submit" value="Valider" name="debut" class="btn mt-4 btn-block btn-outline-dark p-2" disabled>
					</form>
					</div>
					
					<div id="preloader" style="display: none; height: 100% ; position: absolute;margin: 116% 0 0 0;width: 100%;">
						<div id="loader" style="margin: -132% 0 0 -75px"></div>
						<span class="loading" data-name="Loading" style="width: 50%; left: 25%">Veuillez patientez un instant ...</span>
					</div>
					
					<div id="msg"><?php echo $msg; //Message à afficher si besoin. ?></div>


        
