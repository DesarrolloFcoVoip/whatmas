<?php

require_once "../../ApiWhatmasClient.php";


$object = new ApiWhatmasClient(file_get_contents("php://input"));

$text_client=$object->text;

switch ($object->priority){
    case "1":
        $object->sendMessage("Hola, por favor escriba su nombre");
        break;
    case "2":
        $return=$object->varEdit("NAME",$text_client);
        $object->sendMessage("Hola, [NAME] escriba su apellido");
        break;
    case "3":
        $return=$object->varEdit("LASTNAME",$text_client);
        $object->sendMessage("Nombre completo: [NAME] [LASTNAME]");
        break;
    default:
        $object->varDeleteAll();
        break;
}