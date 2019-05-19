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
//Effectu un clic sur l'element indiqué
function trig(element) {
    document.getElementById(element).click();
}

//Fonction qui coche/décoche toutes les checkboxes
function toggle(source) {
  checkboxes = document.getElementsByName('select[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

</script>
<div>
  <h3 class="mb-2">Selection</h3>
  <p class="mb-4">Selectionnez les dossiers que vous souhaitez récupérer.</p>
</div>
<?php 

//Affichage du formulaire construit précedemment
echo $_SESSION['formulaire'];
?>


<div style="padding-left: 2%">
  <button id="resendmail2" class="btn mt-4 btn-block btn-outline-dark p-2" style="display: inline ; width: 31%" onclick="trig('retour1')">Annuler</button>
  <button id="valid2" class="btn mt-4 btn-block btn-outline-dark p-2" style="display: inline ; width: 66%" onclick="trig('envoi1')">Envoyer</button>
</div>
<?php echo $msg ?>


<form class="form" action="controller.php" method="post">
    <input type="hidden" name="retour" value="1">
    <input id="retour1" type="submit" value="Annuler" name="back" style="display: none">
</form>