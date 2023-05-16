<?php

require_once "../../ApiWhatmasClient.php";

$apiClient = new ApiWhatmasClient(file_get_contents("php://input"));

$clientText = $apiClient->text;

switch ($apiClient->priority) {
    case "1":
        $apiClient->sendMessage("Hello, please enter your name");
        break;
    case "2":
        $return = $apiClient->varEdit("NAME", $clientText);
        $apiClient->sendMessage("Hello, [NAME], please enter your last name");
        break;
    case "3":
        $return = $apiClient->varEdit("LASTNAME", $clientText);
        $apiClient->sendMessage("Full name: [NAME] [LASTNAME]");
        break;
    default:
        $apiClient->varDeleteAll();
        break;
}
