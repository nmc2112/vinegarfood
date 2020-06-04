<?php
    session_start();
    include("XTemplate.class.php");
    include("Model.class.php");
    include("Validate.class.php");
    include("Global.class.php");
    $baseUrl = "localhost/vinegarfood/";
    $salt = 'fbc097cc498598b71bde06d998064bbdd930c53a';
    $userName   = 'root';
    $pwd        = '';
    $dbname     = 'vinegar';
    $db     = new Model('root','',$dbname);
    $valid  =  new Validate; 
    $f      = new Globals;