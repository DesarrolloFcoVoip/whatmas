<?php

/**
 * La clase ApiWhatmas es responsable de enviar mensajes de WhatsApp a través de la API de Whatmas.
 */
class ApiWhatmasClient
{
    // La URL para enviar mensajes.
    private $url_send_message = "https://app.whatmas.com/api/v1/send_message/index.php";
    private $url_var = "https://app.whatmas.com/api/v1/var/index.php";
    private $url_tag = "https://app.whatmas.com/api/v1/tag/index.php";
    private $api_key;

    private $num_client;
    public $text;
    private $num_company;
    private $variables;

    private $hash_priority = "PRIORITY";
    private $hash_priority_next = "PRIORITY_NEXT";
    private $hash_label = "LABEL";

    public $priority;
    public $priority_next;
    public $label;


    function __construct($data)
    {
        // Get the API key from the environment variables
        $this->api_key = getenv('API_KEY_WHATMAS');

        // Get the Authorization header from the request
        $headers = apache_request_headers();
        $authorization = $headers['Authorization'];

        // Parse the input data
        $data_general = json_decode($data, TRUE);

        // Extract relevant fields from the data
        $number_client = $data_general["num_client"];
        $text = $data_general["text"];
        $num_company = $data_general["num_company"];
        $variables = $data_general["apc"];

        // Set the extracted values to class properties
        $this->num_client = $number_client;
        $this->text = $text;
        $this->num_company = $num_company;
        $this->variables = $variables;
        $this->setVarFromArray();
        $label = $this->getLabel();

        // Get the priority information
        $prioridad = $this->getPriorityGeneral();

        // Set the priority, next priority, and label
        $this->priority = $prioridad["priority"];
        $this->priority_next = $prioridad["priority_next"];
        $this->label = $label;
    }

    public function setVarFromArray()
    {
        foreach ($this->variables as $key => $value) {
            $this->varEdit($key, $value);
        }
    }

    /**
     * sendMessageList(): This function sends a list-type message.
     * $array_example: An example array with the message data to send. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to send the message. The specific implementation of this function is not provided in the given code.
     */

    public function sendMessageList($text = "Hello, world!", $title_list = "Title list", $items = NULL)
    {

        $array_example = [
            "company_channel_number" => $this->num_company,
            "message_text" =>  $this->replaceText($text),
            "recipient_number" => $this->num_client,
            "message_type" => "interactive",
            "message_subtype" => "list",
            "items" => [
                [
                    "title_list" => $title_list,
                    "items" => $items
                ]
            ]
        ];
        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     * sendMessageButton(): This function sends a button-type message.
     * $array_example: An example array with the message data to send. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to send the message. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
     */
    public function sendMessageButton($text = "Hello, world!", $items = NULL)
    {
        // Ejemplo de array con los datos del mensaje a enviar
        $array_example = [
            "company_channel_number" => $this->num_company,
            "message_text" =>  $this->replaceText($text),
            "recipient_number" => $this->num_client,
            "message_type" => "interactive",
            "message_subtype" => "button",
            "items" => $items
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     * sendMessage(): This function sends a text message.
     * $array_example: An example array with the message data to send. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to send the message. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
     */
    public function sendMessage($text = "Hello, world!")
    {
        // Ejemplo de array con los datos del mensaje a enviar
        $array_example = [
            "company_channel_number" => $this->num_company,
            "message_text" => $this->replaceText($text),
            "recipient_number" => $this->num_client,
            "message_type" => "text",
            "message_subtype" => NULL,
            "items" => NULL
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);
        return $return;
    }

    /**
     * varEdit(): This function edits a variable.
     * $array_example: An example array with the data of the variable to edit. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to perform the variable editing. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
     */

    public function varEdit(
        $key,
        $value,
        $time = 60 //minutes,
    )
    {
        // Ejemplo de array con los datos de la variable a editar
        $hash_key=$this->num_client . "_" . $key;
        $array_example = [
            "type" => 'edit',
            "key" => $hash_key,
            "value" => $value,
            "time" => $time
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     * varAdd(): This function adds a new variable.
     * $array_example: An example array with the data of the new variable to add. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to add the new variable. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
     */

    public function varAdd(
        $key,
        $value,
        $time = 60 //minutes,
    )
    {
        $hash_key=$this->num_client . "_" . $key;
        // Ejemplo de array con los datos de la nueva variable a agregar
        $array_example = [
            "type" => "add",
            "key" => $hash_key,
            "value" => $value,
            "time" => $time
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     * varRead(): This function reads the value of a variable.
     * $array_example: An example array with the data of the variable to read. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to read the value of the variable. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
     */

    public function varRead(
        $key
    )
    {
        $hash_key=$this->num_client . "_" . $key;
        // Ejemplo de array con los datos de la variable a leer
        $array_example = [
            "type" => "read",
            "key" => $hash_key
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     * varDelete(): This function deletes a variable.
     * $array_example: An example array with the data of the variable to delete. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to delete the variable. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
     */

    public function varDelete($key)
    {
        $hash_key=$this->num_client . "_" . $key;
        // Ejemplo de array con los datos de la variable a eliminar
        $array_example = [
            "type" => "delete",
            "key" => $hash_key
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }

    /**
     * varDeleteAll(): This function deletes all variables.
     * $array_example: An example array with the deletion type "delete_all". You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to delete all variables. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
     */

    public function varDeleteAll()
    {
        // Ejemplo de array con el tipo de eliminación "delete_all"
        $array_example = [
            "type" => "delete_all"
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }


    public function addTag()
    {
        // Ejemplo de array con el tipo de eliminación "delete_all"
        $array_example = [
            "tag_name" => "tag_name",
            "recipient_number" =>$this->num_client,
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_tag, "POST", $this->api_key, $array_example);

        return $return;
    }


//    PRIORIDADES
    public function getPriorityGeneral()
    {
        $read = $this->varRead($this->hash_priority_next);

        if ($read["code"] === 200) {
            $priority_number = $read["return"];
        } else
            $priority_number = 1;

        $priority_number_next = $priority_number + 1;
        $this->varEdit($this->hash_priority, $priority_number);
        $this->varEdit($this->hash_priority_next, $priority_number_next);

        return [
            "priority" => $priority_number,
            "priority_next" => $priority_number_next,
        ];
    }

    public function getPriorityNext()
    {
        return $this->varRead($this->hash_priority_next);
    }

    public function getPriority()
    {
        return $this->varRead($this->hash_priority);
    }

    public function getLabel()
    {
        $read = $this->varRead($this->hash_label);

        if ($read["code"] === 200) {
            return $read["return"];
        }
        return false;
    }

    public function setLabel($value)
    {
        $this->varEdit($this->hash_label, $value);
        $this->reloadPriority();
    }

    public function setPriority($priority)
    {
        $priority_number_next = $priority + 1;
        $this->varEdit($this->hash_priority_next, $priority);
        return [
            "priority" => $priority,
            "priority_next" => $priority_number_next,
        ];
    }

    public function reloadPriority()
    {
        $this->varEdit($this->hash_priority, 1);
        $this->varEdit($this->hash_priority_next, 2);
    }

    public function returnMessage($response)
    {
        http_response_code($response["code"]);
        // Detiene la ejecución del script y envía la respuesta HTTP con el mensaje de error en formato JSON.
        exit(json_encode($response));
    }


    /**
     * Consume a web service using cURL.
     *
     * @param string $url URL of the web service.
     * @param string $type Request type ('GET' or 'POST').
     * @param string $token Authorization token.
     * @param array $data Request data in array format.
     *
     * @return mixed Web service response.
     */
    private function programConsumeWebService($url, $type, $token, $data)
    {
        // Initialize cURL
        $curl = curl_init();

        // Validate request type (GET or POST)
        if ($type == 'GET') {
            $parameters = http_build_query($data);
            if ($parameters == false) {
                $url_api = $url;
            } else {
                $url_api = $url . '?' . $parameters;
            }
            // Build and get the final URL for GET request
        } else {
            // Get the final URL for POST request
            $url_api = $url;

            // Convert data to JSON format
            $data = json_encode($data);

            // Enable POST method for cURL
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        // cURL configuration options
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return cURL response as a string
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); // true to verify the peer's certificate
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url_api); // Specify the URL to consume the web service

        // Configure the required headers for the request
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $token
        ));

        // Execute the cURL request
        $curlResponse = curl_exec($curl);
        $return = json_decode($curlResponse, true);

        // Close the cURL connection
        curl_close($curl);

        // Return the request response
        if (!$curlResponse)
            return false;
        else {
            if ($return["code"] !== 200 && $return["code"] !== 3003)
                $this->returnMessage($return);
            else
                return $return;
        }
    }


    /**
     * Replaces variables in the text with their corresponding values.
     *
     * @param string $text The input text.
     *
     * @return string The text with replaced variables.
     */
    private function replaceText($text)
    {
        // Get the 'text' to search for and retrieve possible variables to add to the sentence. Example: "Hello [NAME], how are you?"
        $replaceVariables = $this->getVars($text);

        foreach ($replaceVariables as $variable) {
            // Get the APC corresponding to the action variables
            $apcVariable = $this::varRead(strtoupper($variable));
            // Replace the variables in the 'text' with the value of the APC variables
            $text=str_replace('[' . $variable . ']', $apcVariable["return"], $text);
        }
        return $text;
    }

    /**
     * Extracts variables enclosed in square brackets from a string.
     *
     * @param string $string The input string.
     * @param string $start  The starting delimiter (default: '[').
     * @param string $end    The ending delimiter (default: ']').
     *
     * @return array An array of extracted variables.
     */
    static function getVars($string, $start = '[', $end = ']')
    {
        $result = '';
        $isActive = 0;
        $totalCount = 0;

        for ($i = 0; $i < strlen($string); $i++) {
            // Check if the current character is the start delimiter
            if ($string[$i - 1] == $start) {
                $isActive = 1;
            }

            // Check if the current character is the end delimiter
            if ($string[$i] == $end) {
                $isActive = 0;
                $result .= ',';
                $totalCount++;
            }

            // Add the character to the result if it is within the variable section
            if ($isActive == 1) {
                $result .= $string[$i];
            }
        }

        // Process the extracted variables
        if ($totalCount == 1) {
            $result = substr($result, 0, strlen($result) - 1);
            $result = [$result];
            return $result;
        }

        return explode(',', $result);
    }



}

