<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('Autoload.php');

$autoload = new Autoload;
$autoload->register();

$routeur = new Routeur;

$action = $routeur->getAction();

call_user_func($action);