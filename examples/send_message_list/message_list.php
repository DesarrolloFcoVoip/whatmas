<?php

require_once "../../ApiWhatmasClient.php";

$apiClient = new ApiWhatmasClient(file_get_contents("php://input"));

$clientText = $apiClient->text;

switch ($apiClient->priority) {
    case "1":
        $apiClient->sendMessageList("Hello, please select the desired option", "Main menu",
            [
                [
                    "title" => "Sales",
                    "description" => "Request real estate"
                ],
                [
                    "title" => "Support",
                    "description" => "I'm having issues with my system."
                ],
                [
                    "title" => "Consulting",
                    "description" => "I have a query or complaint"
                ],
                [
                    "title" => "Cashier",
                    "description" => "I need to withdraw"
                ]
            ]);
        break;
    case "2":
        $return = $apiClient->varEdit("MENU", $clientText);
        $apiClient->sendMessage("The selected option is [MENU]");
        break;
    default:
        $apiClient->varDeleteAll();
        break;
}
