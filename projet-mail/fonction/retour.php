<?php 
session_start();
if ($_POST['retour'] == "1"){
    session_unset();
    session_destroy();
    include __DIR__ . '/../fonction/redir.php';
} else {
    header('location: /');
}


?>