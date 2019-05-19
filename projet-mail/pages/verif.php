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

//Effectu un clic sur l'élément indiqué (id)
function trig(element) {
    document.getElementById(element).click();
}
function disab() {
    document.getElementById('resendmail2').disabled = true;
}

//Affiche un chargement après avoir validé le code
function attendre() {
   // document.getElementById('uuuu').style.display = "none";
   document.getElementById('msg').innerHTML = "";
   document.getElementById('valid').disabled = true;
   document.getElementById('valid2').disabled = true;
   document.getElementById('resendmail').disabled = true;
   document.getElementById('resendmail2').disabled = true;
   $('#preloader').fadeIn();
   document.getElementById('formverif').style = "filter: blur(1px)";
   document.getElementById('preloader').style.display = "";
}
</script>

<div>
    <h3 class="mb-2">Vérification</h3>
    <p class="mb-4">Nous devons vérifier si cette adresse vous appartient.</p>
</div>

<!-- Formulaire pour le code vérification -->
<div id="formverif">
    <form class="form" action="controller.php" method="post" onsubmit="attendre()">
        <label for="POST-code">Code : </label>
        <input type="text" name="code" class="form-control">
        <input type="hidden" name="lien" value=3>
        <br>
        <input id="valid" type="submit" value="Valider" name="confcode" style="display: none">
        
    </form>
    <!-- Boutons reliés aux formulaires-->
    <div style="padding-left: 2%">
        <button id="resendmail2" class="btn mt-4 btn-block btn-outline-dark p-2" style="display: inline ; width: 31%" onclick="trig('resendmail')">Renvoyer</button>
        <button id="valid2" class="btn mt-4 btn-block btn-outline-dark p-2" style="display: inline ; width: 66%" onclick="trig('valid')">Valider</button>
    </div>
</div>
<form class="form" action="controller.php" method="post">
    <input type="hidden" name="resend" value="1">
    <input type="hidden" name="lien" value=2>
    <input id="resendmail" type="submit" value="Renvoyer un nouveau code" name="newcode" onclick="disab()" style="display: none">
</form>
<div id="msg"><?php echo $msg; //Affiche un message si nécessaire ?></div>

<!-- Chargement -->
<div id="preloader" style="display: none">
  <div id="loader"></div>
  <span class="loading" data-name="Loading">Veuillez patientez un instant ...</span>
</div>

</div>


<!--<form class="form" action="controller.php" method="post">
    <input type="hidden" name="retour" value="1">
    <input type="submit" value="Retour" name="back">
</form>-->