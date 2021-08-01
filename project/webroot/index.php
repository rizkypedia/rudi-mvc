<?php
require '../app/config/paths.php';
require VENDOR . DS . "autoload.php";

try {
    RudiMVC\Core\RudiApp::boot();
    RudiMVC\Core\RudiApp::route();
} catch (Exception $exception){
    $statuscode = $exception->getCode();
    echo $exception->getMessage();
    echo "<br />Exit app with code " . $statuscode;
}
