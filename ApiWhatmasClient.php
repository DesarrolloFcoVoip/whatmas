<?php

/**
 * La clase ApiWhatmas es responsable de enviar mensajes de WhatsApp a través de la API de Whatmas.
 */
class ApiWhatmasClient
{
    // La URL para enviar mensajes.
    private $url_send_message = "https://app.whatmas.com/api/v1/send_message/index.php";
    private $url_var = "https://app.whatmas.com/api/v1/var/index.php";
    private $api_key = "API-KEY";

    /**
     *     sendMessageList(): Esta función envía un mensaje de tipo lista.
    $array_example: Un ejemplo de array con los datos del mensaje a enviar. Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para enviar el mensaje. La implementación específica de esta función no se proporciona en el código dado.
     */
    public function sendMessageList(){
        // Ejemplo de array con los datos del mensaje a enviar
        $array_example = [
            "company_channel_number" => 573244557697,
            "message_text" => "Hello, world!",
            "recipient_number" => "573219048473",
            "message_type" => "interactive",
            "message_subtype" => "list",
            "items" => [
                [
                    "title_list" => "Listado title",
                    "items" => [
                        [
                            "title" => "Titulo",
                            "description" => "Buenas."
                        ],
                        [
                            "title" => "Titulo",
                            "description" => "Buenas."
                        ],
                        [
                            "title" => "Titulo",
                            "description" => "Buenas."
                        ],
                        [
                            "title" => "Titulo",
                            "description" => "Buenas."
                        ],
                        [
                            "title" => "Titulo",
                            "description" => "Buenas."
                        ],
                        [
                            "title" => "Titulo",
                            "description" => "Buenas."
                        ]
                    ]
                ]
            ]
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);
    }


    /**
     *     sendMessageButton(): Esta función envía un mensaje de tipo botón.
    $array_example: Un ejemplo de array con los datos del mensaje a enviar. Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para enviar el mensaje. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function sendMessageButton(){
        // Ejemplo de array con los datos del mensaje a enviar
        $array_example = [
            "company_channel_number" => 573244557697,
            "message_text" => "Hello, world!",
            "recipient_number" => "573219048473",
            "message_type" => "interactive",
            "message_subtype" => "button",
            "items" => ["button 1", "button 2", "button 3"]
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);
    }


    /**
     *     sendMessage(): Esta función envía un mensaje de texto.
    $array_example: Un ejemplo de array con los datos del mensaje a enviar. Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para enviar el mensaje. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function sendMessage(){
        // Ejemplo de array con los datos del mensaje a enviar
        $array_example = [
            "company_channel_number" => 573244557697,
            "message_text" => "Hello, world!",
            "recipient_number" => "573219048473",
            "message_type" => "text",
            "message_subtype" => NULL,
            "items" => NULL
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);
    }

    /**
     *     varEdit(): Esta función edita una variable.
    $array_example: Un ejemplo de array con los datos de la variable a editar. Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para realizar la edición de la variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varEdit(){
        // Ejemplo de array con los datos de la variable a editar
        $array_example = [
            "type" => "edit",
            "key" => "valor key",
            "value" => "value",
            "time" => 1
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }


    /**
     *     varAdd(): Esta función agrega una nueva variable.
    $array_example: Un ejemplo de array con los datos de la nueva variable a agregar. Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para agregar la nueva variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varAdd(){
        // Ejemplo de array con los datos de la nueva variable a agregar
        $array_example = [
            "type" => "add",
            "key" => "valor key",
            "value" => "value",
            "time" => 1
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }


    /**
     *     varRead(): Esta función lee el valor de una variable.
    $array_example: Un ejemplo de array con los datos de la variable a leer. Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para leer el valor de la variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varRead(){
        // Ejemplo de array con los datos de la variable a leer
        $array_example = [
            "type" => "read",
            "key" => "valor key"
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }


    /**
     *     varDelete(): Esta función elimina una variable.
    $array_example: Un ejemplo de array con los datos de la variable a eliminar. Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para eliminar la variable. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varDelete(){
        // Ejemplo de array con los datos de la variable a eliminar
        $array_example = [
            "type" => "delete",
            "key" => "valor key"
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }

    /**
     *     varDeleteAll(): Esta función elimina todas las variables.
    $array_example: Un ejemplo de array con el tipo de eliminación "delete_all". Puedes personalizar este array según tus necesidades.
    $return: La variable donde se almacenará el resultado de la llamada a la función programConsumeWebService(), que se asume que está definida en otro lugar. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
    programConsumeWebService(): Esta función se encarga de consumir un servicio web para eliminar todas las variables. La implementación específica de esta función no se proporciona en el código dado. Asegúrate de definir y utilizar correctamente esta función en tu implementación.
     */
    public function varDeleteAll(){
        // Ejemplo de array con el tipo de eliminación "delete_all"
        $array_example = [
            "type" => "delete_all"
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }



    /**
     * Consumir un servicio web utilizando cURL.
     *
     * @param string $url   URL del servicio web.
     * @param string $type  Tipo de petición ('GET' o 'POST').
     * @param string $token Token de autorización.
     * @param array  $data  Datos de la petición en formato de array.
     *
     * @return mixed Respuesta del servicio web.
     *
     *
     *
     */
    static function programConsumeWebService($url, $type, $token, $data)
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
            var_dump($url_api);
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

        // Cerramos la conexión del CURL
        curl_close($curl);

        // Retornamos la respuesta de la petición
        if (!$curlResponse)
            return false;
        else
            return $curlResponse;
    }

}

