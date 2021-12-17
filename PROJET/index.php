<?php
// Chargement de la bibliothèque Flight.
require '../../includes/flight-master/flight/Flight.php';
// Chargement de la bibliothèque Smarty.
require '../../includes/smarty-3.1.35/libs/Smarty.class.php';
//Inclusion du fichier pdo.php afin de pouvoir 
//accéder à la base de donnée.
include('../../includes/pdo.php');

// On Enregistre Smarty comme view class.
// On passe également une fonction de rappel 
//pour configurer Smarty au chargement.
Flight::register('view', 'Smarty', array(), function($smarty){
    $smarty->template_dir = './templates/';
    $smarty->compile_dir = './templates_c/';
    $smarty->config_dir = './config/';
    $smarty->cache_dir = './cache/';    
});
//Initialisation des templates et du render 
Flight::map('render', function($template, $data){
    Flight::view()->assign($data);
    Flight::view()->display($template);
});
// Chargement de la route.php
require "routes.php";
// Lancement de Flight
Flight::start();
