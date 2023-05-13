# whatmas
Whatmas API
# Nombre del Proyecto

Breve descripción del proyecto.

## Tabla de Contenidos

- [Instalación](#instalación)
- [Uso](#uso)
- [Métodos](#métodos)
  - [sendMessageList()](#sendmessagelist)
  - [sendMessageButton()](#sendmessagebutton)
  - [sendMessage()](#sendmessage)
  - [varEdit()](#varedit)
  - [varAdd()](#varadd)
  - [varRead()](#varread)
  - [varDelete()](#vardelete)
  - [varDeleteAll()](#vardeleteall)
- [Contribución](#contribución)
- [Licencia](#licencia)

## Instalación

Instrucciones para instalar y configurar el proyecto.

## Uso

Explicación de cómo utilizar el proyecto. Incluye ejemplos de código, comandos o configuraciones.

## Métodos

### sendMessageList()

Envía un mensaje interactivo de tipo lista. Este método permite enviar un mensaje con una lista de elementos interactivos.

```php
public function sendMessageList() {
    // Ejemplo de array con los datos del mensaje
    $array_example = [
        "company_channel_number" => 573244557697,
        "message_text" => "Hello, world!",
        "recipient_number" => "573219048473",
        "message_type" => "text",
        "message_subtype" => NULL,
        "items" => [
            // Ejemplo de elementos de la lista
            [
                "title" => "Elemento 1",
                "subtitle" => "Descripción del elemento 1",
                "image_url" => "https://example.com/image1.jpg",
                "buttons" => [
                    // Ejemplo de botones para el elemento 1
                    [
                        "title" => "Botón 1",
                        "payload" => "button1"
                    ],
                    [
                        "title" => "Botón 2",
                        "payload" => "button2"
                    ]
                ]
            ],
            // Ejemplo de más elementos de la lista...
        ]
    ];

    // Llamada a la función para consumir el servicio web
    $return = $this::programConsumeWebService($this->url_send_message, "POST", $this->api_key, $array_example);
}

