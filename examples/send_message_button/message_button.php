<?php

require_once "../../ApiWhatmasClient.php";

$apiClient = new ApiWhatmasClient(file_get_contents("php://input"));

$clientText = $apiClient->text;

switch ($apiClient->priority) {
    case "1":
        $apiClient->sendMessageButton("Hello, please select the desired option", ["Button 1","Button 2","Button3"] );
        break;
    case "2":
        $return = $apiClient->varEdit("BUTTON", $clientText);
        $apiClient->sendMessage("The selected option is [BUTTON]");
        break;
    default:
        $apiClient->varDeleteAll();
        break;
}
