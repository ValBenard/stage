<?php

// Config connexion BDD

$bddhost       = "localhost";   // Serveur BDD
$bddusername   = "test";        // Nom Utilisateur
$bddpassword   = "test";        // MDP utilisateur
$bddname       = "dbmail";      // Nom BDD

// Config SMTP Sendmail

$smtphost = 'smtp.gmail.com';           // SMTP serveur
$smtpusername = '';  // SMTP username, email d'envoi
$smtpname = 'Robotmail';                // Nom affiché dans "personal" de l'adresse d'envoi
$smtppassword = '';                  // SMTP password
$smtpsecure = 'tls';                    // Crytpage TLS ou SSL
$smtpport = 587;                        // Port TCP

// Email qui recoit les messages depuis le formulaire de contact
$contactmail = '';

// Config Google reCAPTCHA v3

$clientkey = '6LcKopMUAAAAAOt_WYeajyEp8qavjTgtIB2uFP7x';
$secretkey = '6LcKopMUAAAAAGbccUXUtlnvnnSPe7Sm1qa-he3s';

?>