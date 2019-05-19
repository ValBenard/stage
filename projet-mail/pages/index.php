<!DOCTYPE html>
<html>

<head>


<script src="https://www.google.com/recaptcha/api.js?render=6LcKopMUAAAAAOt_WYeajyEp8qavjTgtIB2uFP7x"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
  <link rel="stylesheet" href="now-ui-kit.css" type="text/css">
  <link rel="stylesheet" href="assets/css/nucleo-icons.css" type="text/css">
  <!--<script src="assets/js/navbar-ontop.js"></script>-->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Now UI Kit by Creative Tim</title>
  <meta name="description" content="Start your development with a beautiful Bootstrap 4 UI kit. It is yours Free.">
  <meta name="keywords" content="bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, now ui, now ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit">

  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
function trigg(element) {
    //document.getElementById('contactform').style = "filter: blur(1px)";
    document.getElementById(element).click();
}
function contact(){
contactform = window.open("contact.php",null,  
    "height=450,width=560,status=yes,toolbar=no,menubar=no,location=no,scrollbars=no,resizable=no" );
}

  </script>

<link rel="stylesheet" href="preload.css" type="text/css">

</head>




<body class="">
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark fixed-top">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNowUIKitFree">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNowUIKitFree">
        <ul class="navbar-nav">
          <li class="nav-item mx-1 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="#download" contenteditable="true">
              <i class="now-ui-icons arrows-1_cloud-download-93 x2 mr-2"></i>Pourquoi c'est gratuit</a>
          </li>
          <li class="nav-item mx-1 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="#">
              <i class="now-ui-icons files_paper x2 mr-2"></i>RGPD &amp; Confidentialité</a>
          </li>
        </ul>
        <a class="btn btn-light text-primary" href="#pro">
          <i class="now-ui-icons arrows-1_share-66 mr-1"></i>Ajouter à vos favoris</a>
        <ul class="navbar-nav flex-row justify-content-center mt-2 mt-md-0">
          <li class="nav-item mx-1">
            <a class="nav-link" href="#" data-placement="bottom" data-toggle="tooltip" title="Follow us on Twitter">
              <i class="fa fa-fw fa-twitter fa-2x"></i>
            </a>
          </li>
          <li class="nav-item mx-3 mx-md-1">
            <a class="nav-link" href="#" data-placement="bottom" data-toggle="tooltip" title="Like us on Facebook">
              <i class="fa fa-fw fa-facebook-official fa-2x"></i>
            </a>
          </li>
          <li class="nav-item ml-1">
            <div id="contactbtn" class="nav-link" href="#" data-placement="bottom" title="Contact">
              <i class="fa fa-fw fa fa-envelope fa-2x"></i>
            </div>
          </li>
          
          





          <!-- The Modal -->
          <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
              <span class="close">&times;</span>
              
              
                <div id="contentcontact">
                  <!-- Formulaire qui récupère les données de l'utilisateur-->
                  <?php include __DIR__ . '/../www/contact.php'; ?>
                </div>
               


              <!-- _ -->
            </div>
          </div>




        </ul>
      </div>
    </div>
  </nav>
  <div class="py-5 text-center parallax cover gradient-overlay" style="background-image: url(&quot;./assets/img/header.jpg&quot;);position:relative;background-position:center center;background-size:cover;">
    <div class="container d-flex flex-column">
      <div class="row my-auto">
        <div class="col-md-12 text-white">
          <img class="mb-5" src="./assets/img/now-logo.png" width="100">
          <h1 class="mb-3 display-1">Gardez le contact</h1>
          <h3 class="mb-5">Récupérer vos contact email n'a jamais été aussi simple !</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12"><a class="btn btn-outline-primary" href="#" contenteditable="true">Comment ça marche ?</a></div>
      </div>
    </div>
  </div>
  <div class="section-overlapping">
    <div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto px-0">
          <img src="assets/img/device_1.png" alt="" class="d-none d-md-block img-fluid">
          <img src="assets/img/device_2.png" alt="" class="img-fluid d-block d-md-none"> </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="text-secondary">
            <b>Récupération déja commencée ? suivre son état</b></p>
          <div class="card mb-4">
            <div class="card-body">
              <div class="tab-content mt-2">
                <div class="tab-pane fade show active text-center" id="tabone" role="tabpanel">
                  <p class="">Cliquer sur le bouton ci-dessous et suivre les instructions.<br><br></p><button class="btn btn-primary rounded" type="button">Nouvelle récupération</button>
                </div>
                <div class="tab-pane fade text-center" id="tabtwo" role="tabpanel">
                  <p class="">I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
                </div>
                <div class="tab-pane fade text-center" id="tabthree" role="tabpanel">
                  <p class="">I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
                </div>
                <div class="tab-pane fade text-center" id="tabfour" role="tabpanel">
                  <p class="">"I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at."</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <p class="text-secondary">Prêt pour votre première récupération ?</p>
          <div class="mb-4 card border-0">
            <div class="card-body">
              <div class="tab-content mt-2">
                <div class="tab-pane fade show active text-center" id="tabBackgroundOne" role="tabpanel">
                  <p class="">Cliquer sur le bouton ci-dessous pour aller sur la page de suivi.<br><br></p><button class="btn btn-outline-primary rounded" type="button">Suivre ma récupération</button>
                </div>
                <div class="tab-pane fade text-center" id="tabBackgroundTwo" role="tabpanel">
                  <p class="">I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
                </div>
                <div class="tab-pane fade text-center" id="tabBackgroundThree" role="tabpanel">
                  <p class="">I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
                </div>
                <div class="tab-pane fade text-center" id="tabBackgroundFour" role="tabpanel">
                  <p class="">"I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at."</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- EMAIL -->
  <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="p-5 col-md-7 d-flex flex-column justify-content-center">
          <h3 class="display-4 mb-3">Démarer une nouvelle récupération</h3>
          <p class="mb-4 lead">OVH Mail Migrator est un service qui permet de migrer un compte mail vers un autre. Ce service migrera chaque objet de la source vers la destination. </p>
        </div>
        <div class="p-5 col-md-5">
          <div id="content">
          <?php include __DIR__ . '/../fonction/redir.php'; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- EMAIL -->
  
  <!--<a id="scroll" href="#ancre" class="scroll"></a>
  <a id="ancre"></a>-->

<div id="content2">
  <div class="pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="mb-2">Option</h3>
        </div>
      </div>
      <div class="row my-5">
        <div class="col-md-12" style="">
          <div class="row py-3">
            <div class="col-md-3 col-6">
              <p class="text-muted">
                <b>CHECKBOXES</b>
              </p>
              <form class="">
                <div class="form-group">
                  <div class="custom-control custom-checkbox pl-0">
                    <input class="custom-control-input" type="checkbox" id="customCheck1" value="on">
                    <label class="custom-control-label" for="customCheck1">Unchecked</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox pl-0">
                    <input class="custom-control-input" type="checkbox" id="customCheck2" checked="" value="on">
                    <label class="custom-control-label" for="customCheck2">Checked</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox pl-0">
                    <input class="custom-control-input" type="checkbox" id="customCheck3" disabled="" value="on">
                    <label class="custom-control-label" for="customCheck3">Disabled uchecked</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox pl-0">
                    <input class="custom-control-input" type="checkbox" id="customCheck1" disabled="" checked="" value="on">
                    <label class="custom-control-label" for="customCheck1">Disabled checked</label>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-3 col-6">
              <p class="text-muted">
                <b>RADIOS</b>
              </p>
              <form>
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="on">
                  <label class="custom-control-label" for="customRadio1">Radio is off</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="on" checked="">
                  <label class="custom-control-label" for="customRadio2">Radio is on</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadio3" name="customRadio2" value="on" disabled="" class="custom-control-input">
                  <label class="custom-control-label" for="customRadio3">Disabled radio is off</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadio4" name="customRadio2" class="custom-control-input" value="on" disabled="" checked="">
                  <label class="custom-control-label" for="customRadio4">Disabled radio is on</label>
                </div>
              </form>
            </div>
            <div class="col-md-3 col-6">
              <p class="text-muted">
                <b>TOGGLE BUTTONS</b>
              </p>
              <form class="">
                <div class="form-group mb-2">
                  <div class="custom-control custom-toggle pl-0">
                    <input class="custom-control-input" type="checkbox" id="customCheck1" value="on" checked="">
                    <label class="custom-control-label"></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-toggle pl-0">
                    <input class="custom-control-input" type="checkbox" value="on" data-off-label="OFF" id="customCheck1">
                    <label class="custom-control-label"></label>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-3 col-md-3">
              <p class="text-muted">
                <b>SLIDERS</b>
              </p>
              <form class="">
                <div class="form-group">
                  <div class="custom-control custom-slider pl-0">
                    <input type="range" min="1" max="100" value="50" class="slider" id="myRange" style="">
                    <label class="custom-control-label"></label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <blockquote class="blockquote blockquote-primary">
            <p>"I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at."</p>
            <footer class="blockquote-footer">L'équipe de nexport</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="py-5">
    <div class="container">
      <div class="row">
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3 class="mb-4">A qui s'adresse ce service ?</h3>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h5>nexport.fr est un service qui permet de récuperer un compte mail vers un autre.&nbsp;<br><br>Ce service migrera chaque objet de la source vers la destination. Ci-dessous la liste des objets compatibles:</h5>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h6>THE LIFE OF NOW UI KIT</h6>
        </div>
      </div>
      <div class="row">
        <div class="col pr-0">
          <p>I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3 class="mb-4">Quels sont les pré-requis ?</h3>
        </div>
      </div>
      <div class="row">
        <div class="col pr-0">
          <blockquote class="blockquote blockquote-primary">
            <p>"I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at."</p>
            <footer class="blockquote-footer">NOAA</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="my-3">
            <b>Decouvrez aussi</b></h2>
          <p class="lead mb-4" style="">Nexport et le fruit d'un travail collaborative mise à disposition gratuitement pour les TPE &amp; PME<br><br>Elle fait partie d'une suite d'outils pour entreprise, complet et pensez pour répondre ...<br></p>
          <a class="btn btn-primary rounded btn-lg" href="https://demos.creative-tim.com/now-ui-kit/nucleo-icons.html" target="blank" contenteditable="true">Découvrir</a>
          <a class="btn btn-outline-primary rounded mx-2 btn-lg" href="https://nucleoapp.com/?ref=1712" target="blank">Comment nous contactez ?</a>
        </div>
        <div class="col-md-6">
          <img class="img-fluid d-block" src="assets/img/icons.png"> </div>
      </div>
    </div>
  </div>
  <!--<script crossorigin="anonymous" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"></script>
  <script src="assets/js/parallax.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
  <script style="">/*
    $(document).ready(function() {
      $('[data-toggle="popover"]').popover();
      $('[data-toggle="tooltip"]').tooltip();
      $('#datepicker-example').datepicker({
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
      });
    });
  </script>
  <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("contactbtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  $("#myModal").fadeIn(200);
  modal.style.display = "block";
  
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  $("#myModal").fadeOut(150);
  //modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    $("#myModal").fadeOut(150);
    //modal.style.display = "none";
  }
}
</script>
  
</body>

</html>