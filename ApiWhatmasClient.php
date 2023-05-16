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
        $this->api_key=getenv('API_KEY_WHATMAS');

        $headers = apache_request_headers();
        $Authorization = $headers['Authorization'];

        $data_general = json_decode($data, TRUE);


        $number_client = $data_general["num_client"];
        $text = $data_general["text"];
        $num_company = $data_general["num_company"];
        $variables = $data_general["apc"];


        $this->num_client = $number_client;
        $this->text = $text;
        $this->num_company = $num_company;
        $this->variables = $variables;
        $this->setVarFromArray();
        $label = $this->getLabel();

        $prioridad = $this->getPriorityGeneral();


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
     *     sendMessageList(): Esta función envía un mensaje de tipo lista.
     * $array_example: Un ejemplo de array con los datos del mensaje a enviar. Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para enviar el mensaje. La implementación específica de esta función no se proporciona en el código dado.
     */
    public function sendMessageList($text = "Hello, world!", $title_list = "Title list", $items = NULL)
    {
        // Ejemplo de array con los datos del mensaje a enviar
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

//        $array_items_example=[
//            [
//                "title" => "Titulo",
//                "description" => "Buenas."
//            ],
//            [
//                "title" => "Titulo",
//                "description" => "Buenas."
//            ],
//            [
//                "title" => "Titulo",
//                "description" => "Buenas."
//            ],
//            [
//                "title" => "Titulo",
//                "description" => "Buenas."
//            ],
//            [
//                "title" => "Titulo",
//                "description" => "Buenas."
//            ],
//            [
//                "title" => "Titulo",
//                "description" => "Buenas."
//            ]
//        ];


        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     *     sendMessageButton(): Esta función envía un mensaje de tipo botón.
     * $array_example: Un ejemplo de array con los datos del mensaje a enviar. Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para enviar el mensaje. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
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

        $items_example = ["button 1", "button 2", "button 3"];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     *     sendMessage(): Esta función envía un mensaje de texto.
     * $array_example: Un ejemplo de array con los datos del mensaje a enviar. Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para enviar el mensaje. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
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
     *     varEdit(): Esta función edita una variable.
     * $array_example: Un ejemplo de array con los datos de la variable a editar. Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para realizar la edición de la variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varEdit(
        $key,
        $value,
        $time = 60 //minutes,
    )
    {
        // Ejemplo de array con los datos de la variable a editar
        $array_example = [
            "type" => 'edit',
            "key" => $key,
            "value" => $value,
            "time" => $time
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     *     varAdd(): Esta función agrega una nueva variable.
     * $array_example: Un ejemplo de array con los datos de la nueva variable a agregar. Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para agregar la nueva variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varAdd(
        $key,
        $value,
        $time = 60 //minutes,
    )
    {
        // Ejemplo de array con los datos de la nueva variable a agregar
        $array_example = [
            "type" => "add",
            "key" => $key,
            "value" => $value,
            "time" => $time
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     *     varRead(): Esta función lee el valor de una variable.
     * $array_example: Un ejemplo de array con los datos de la variable a leer. Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para leer el valor de la variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varRead(
        $key
    )
    {
        // Ejemplo de array con los datos de la variable a leer
        $array_example = [
            "type" => "read",
            "key" => $key
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }


    /**
     *     varDelete(): Esta función elimina una variable.
     * $array_example: Un ejemplo de array con los datos de la variable a eliminar. Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para eliminar la variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varDelete($key)
    {
        // Ejemplo de array con los datos de la variable a eliminar
        $array_example = [
            "type" => "delete",
            "key" => $key
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this->programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);

        return $return;
    }

    /**
     *     varDeleteAll(): Esta función elimina todas las variables.
     * $array_example: Un ejemplo de array con el tipo de eliminación "delete_all". Puedes personalizar este array según tus necesidades.
     * $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     * programConsumeWebService(): Esta función se encarga de consumir un servicio web para eliminar todas las variables. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
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
            "recipient_number" => "recipient_number",
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
     * Consumir un servicio web utilizando cURL.
     *
     * @param string $url URL del servicio web.
     * @param string $type Tipo de petición ('GET' o 'POST').
     * @param string $token Token de autorización.
     * @param array $data Datos de la petición en formato de array.
     *
     * @return mixed Respuesta del servicio web.
     *
     *
     *
     */
    private function programConsumeWebService($url, $type, $token, $data)
    {
        // Inicializamos el CURL
        $curl = curl_init();

        // Validamos el tipo de la petición (GET o POST)
        if ($type == 'GET') {
            $parameters = http_build_query($data);
            if ($parameters == false) {
                $url_api = $url;
            } else {
                $url_api = $url . '?' . $parameters;
            }
            // Se arma y se obtiene la URL final para petición GET
        } else {
            // Se obtiene la URL final para petición POST
            $url_api = $url;

            // Convertimos los datos a formato JSON
            $data = json_encode($data);

            // Habilitamos método POST para el CURL
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        // Opciones de configuración para el CURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Respuesta del CURL retornada como string
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true); // true para verificar el peer del certificado
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url_api); // Especificamos la URL a la que se consumirá el servicio

        // Configuramos los headers requeridos para ejecutar la petición
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $token
        ));

        // Ejecutamos (enviamos) el CURL
        $curlResponse = curl_exec($curl);
        $return = json_decode($curlResponse, true);
        // Cerramos la conexión del CURL
        curl_close($curl);

        // Retornamos la respuesta de la petición
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

