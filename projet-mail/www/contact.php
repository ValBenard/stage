<?php
require_once __DIR__ . '/../config.php';
use PHPMailer\PHPMailer\PHPMailer;
$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
    
    
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

            if (!empty($_POST['email']) && !empty($_POST['message']) && !empty($_POST['name'])) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $destination = $contactmail;
            $subject = "Contact robomail";
            $body = "<html><head></head><body>
            Email: {$_POST['email']} <br>
            Nom: {$_POST['name']} <br>
            Message: {$_POST['message']}</body></html>";

            $altbody = "Email: {$_POST['email']} 
            Nom: {$_POST['name']}
            Message: {$_POST['message']}";
            include __DIR__ . '/../fonction/sendmail.php';
                } else {
                    $msgc = "Veuillez saisir une adresse mail valide.";
                }
            } else {
                $msgc = "Veuillez remplir tout les champs";
            }

        } else {$msgc = "Nous ne pouvons pas procéder à cette action. Veuillez réessayer";}
    } else {$msgc = "Nous ne pouvons pas procéder à cette action. Veuillez réessayer";}
    //echo "<script>$(\"#myModal\").fadeOut(150);</script>";
}
//include __DIR__ . '/../www/contact1.php';
?>

<script>



$(document).ready(function() {
	$('#contactform').on('submit', function(e) {
		e.preventDefault();
        sendcontact();
	});
});


		function sendcontact() {
            attendrec();
        var xname = $("#name").val();
        var xemail = $("#email").val();
        var xmessage = $("#message").val();
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo $clientkey; ?>', {action: 'homepage'}) //← Clé client du captcha v3 à modifier
            .then(function(token) {
                // Verify the token on the server.
                var token1 = token;
                console.log(token)
                // Returns successful data submission message when the entered information is stored in database.
                $.post("contact.php", {
                    name: xname,
                    email: xemail,
                    message: xmessage,
                    token: token1
                }, function(data) {
                    $('#contentcontact').html(data); 
                    //$('#contactform')[0].reset(); // To reset form fields
                });
            });
        });    
		}


        function attendrec() {
    document.getElementById('msgc').innerHTML = "<i class=\"fa fa-fw fa-check-circle fa-2x\"></i>";
   document.getElementById('submitcontact').disabled = true;
   document.getElementById('button-contact').disabled = true;
   setTimeout(function(){ $("#myModal").fadeOut(200); },500);
   //$('#preloaderc').fadeIn();
   //document.getElementById('contactform').style = "filter: blur(1px)";
   //document.getElementById('preloaderc').style.display = "";
}
/*
    $(document).ready(function() {
$('#contactform').on('submit', function(e) {
    
    e.preventDefault();
    
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            $('#contentcontact').html(data); 
        }
    });
});
});*/
    </script>


    <!-- Formulaire qui récupère les données de l'utilisateur-->
    
    <h2 style="margin: 0px;text-align: center;">Contactez nous</h2>
    <form id="contactform" action="contact.php" method="POST">
        <label onclick="attendrec()" for="name">Nom: </label><input type="text" name="name" id="name" class="form-control" style="padding: 0.25rem 0.5rem;margin-bottom: 5px;" required>
        <label for="email">Adresse Email: </label><input type="email" name="email" id="email" class="form-control" style="padding: 0.25rem 0.5rem;margin-bottom: 5px;" required>
        <label for="message">Message: </label><textarea name="message" id="message" rows="8" cols="20" class="form-control" style="border-radius: 1rem;resize: none;margin-bottom: 5px;" required></textarea>
        <input id="button-contact" type="button" value="Envoyer" class="btn btn-primary rounded" style="display: inline; width: 30%" onclick="trigg('submitcontact')">

        <div id="msgc" style="display: inline"><?php if (!empty($msgc)) {echo "<b>$msg</b>";} ?></div>
        <input id="submitcontact" type="submit" value="Send" class="btn btn-outline-dark rounded" style="display: none">
        
                    
    </form>
  
    
    