# whatmas
Whatmas API
# Whatmas API

API de consumo web utilizando el lenguaje de programación PHP. El programa proporciona diferentes métodos para realizar operaciones como enviar mensajes interactivos, administrar variables y consumir servicios web.

Los métodos disponibles en la aplicación son los siguientes:

    sendMessageList(): Este método permite enviar un mensaje interactivo de tipo lista. Se puede proporcionar un conjunto de elementos con títulos, descripciones y botones interactivos para que el   usuario interactúe con ellos.

    sendMessageButton(): Este método envía un mensaje interactivo con botones. Se puede proporcionar un conjunto de botones para que el usuario seleccione una opción específica.

    sendMessage(): Este método envía un mensaje de texto simple sin opciones interactivas adicionales.

    varEdit(): Este método permite editar una variable existente en el servicio web. Se proporciona una clave de variable, un nuevo valor y un tiempo de duración.

    varAdd(): Este método permite agregar una nueva variable al servicio web. Se proporciona una clave de variable, un valor y un tiempo de duración.

    varRead(): Este método permite leer el valor de una variable existente en el servicio web. Se proporciona la clave de la variable y devuelve el valor correspondiente.

    varDelete(): Este método permite eliminar una variable específica del servicio web. Se proporciona la clave de la variable a eliminar.

    varDeleteAll(): Este método permite eliminar todas las variables almacenadas en el servicio web.

Estos métodos utilizan una función auxiliar programConsumeWebService() para realizar la llamada al servicio web utilizando la biblioteca cURL de PHP.

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
  - [addTag()](#addTag)


## Instalación

Para utilizar esta aplicación, sigue los siguientes pasos:
- Clona el repositorio en tu máquina local
- Importa la clase en tu proyecto
- Exporta la variable API_KEY de manera global
- instanciar la clase : 
```php 
    $object=new ApiWhatmasClient();
```
- Ahora puedes utilizar los diferentes métodos disponibles en la clase ApiWhatmasClient para interactuar con el servicio web. Por ejemplo:
  ```php
  
  // Enviar un mensaje interactivo de tipo lista
  $object->sendMessageList();

  // Enviar un mensaje interactivo con botones
  $object->sendMessageButton();

  // Enviar un mensaje de texto simple
  $object->sendMessage();

  // Editar una variable en el servicio web
  $object->varEdit();

  // Agregar una nueva variable al servicio web
  $object->varAdd();

  // Leer el valor de una variable del servicio web
  $object->varRead();

  // Eliminar una variable del servicio web
  $object->varDelete();

  // Eliminar todas las variables del servicio web
  $object->varDeleteAll();
  ```
    
## Uso

Explicación de cómo utilizar el proyecto. Incluye ejemplos de código, comandos o configuraciones.

## Métodos

### sendMessageList()

El método send_message_list es una función de la API de WhatsApp Business que permite enviar mensajes de lista interactivos a los destinatarios de WhatsApp. Estos mensajes de lista pueden ser utilizados para mostrar una lista de opciones interactivas a los usuarios de WhatsApp, lo que les permite interactuar con el mensaje y seleccionar una opción. Los mensajes de lista son muy útiles para enviar información en formato fácil de leer y permitir a los usuarios interactuar con el contenido.

Para utilizar el método send_message_list, debe proporcionar varios parámetros, como el número de canal de la empresa, el número de teléfono del destinatario, el tipo de mensaje y el subtipo de mensaje. También debe proporcionar una lista de elementos que se mostrarán en el mensaje de lista interactiva. Cada elemento debe tener un título y una descripción.

El método send_message_list es una forma efectiva de enviar mensajes interactivos a los usuarios de WhatsApp. Al utilizar mensajes de lista, puede proporcionar a los usuarios una experiencia más atractiva y atractiva que simplemente enviar un mensaje de texto plano. Además, los mensajes de lista también pueden ser utilizados para recopilar información de los usuarios mediante la selección de opciones interactivas.

- company_channel_number (int): el número de canal de la empresa desde el cual se enviará el mensaje. Este número es proporcionado por la plataforma de WhatsApp Business API.
- message_text (str): el texto principal del mensaje que se enviará. La longitud máxima del mensaje es de 4096 caracteres.
- recipient_number (str): el número de teléfono del destinatario al que se enviará el mensaje en el formato internacional. Por ejemplo, si el número de teléfono es de Colombia, el número debería comenzar con "57" seguido del número de teléfono sin el "0" inicial.
- message_type (str): el tipo de mensaje que se enviará. En este caso, el valor debe ser "interactive".
- message_subtype (str): el subtipo de mensaje que se enviará. En este caso, el valor debe ser "list".
- items (list): una lista de diccionarios que contiene los elementos que se mostrarán en la lista interactiva. Cada elemento debe tener dos claves: title y description, que representan el título y la descripción del elemento, respectivamente. El número máximo de elementos que se pueden mostrar en una lista es de 10.

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
```

### sendMessageButton()

El método send_message_button es una función de la API de WhatsApp Business que permite enviar mensajes interactivos con botones a los destinatarios de WhatsApp. Los botones pueden ser utilizados para proporcionar opciones interactivas a los usuarios, como responder con un simple clic en lugar de tener que escribir una respuesta completa.

Para utilizar el método send_message_button, debe proporcionar varios parámetros, como el número de canal de la empresa, el número de teléfono del destinatario, el tipo de mensaje y el subtipo de mensaje. También debe proporcionar una lista de strings que representan los botones que se mostrarán en el mensaje.

El método send_message_button es una forma efectiva de enviar mensajes interactivos a los usuarios de WhatsApp. Al utilizar botones, puede proporcionar a los usuarios una experiencia más atractiva y atractiva que simplemente enviar un mensaje de texto plano. Además, los mensajes de botones también pueden ser utilizados para recopilar información de los usuarios mediante la selección de opciones interactivas.

- company_channel_number (int): el número de canal de la empresa desde el cual se enviará el mensaje. Este número es proporcionado por la plataforma de WhatsApp Business API.
- message_text (str): el texto principal del mensaje que se enviará. La longitud máxima del mensaje es de 4096 caracteres.
- recipient_number (str): el número de teléfono del destinatario al que se enviará el mensaje en el formato internacional. Por ejemplo, si el número de teléfono es de Colombia, el número debería comenzar con "57" seguido del número de teléfono sin el "0" inicial.
- message_type (str): el tipo de mensaje que se enviará. En este caso, el valor debe ser "interactive".
- message_subtype (str): el subtipo de mensaje que se enviará. En este caso, el valor debe ser "button".
- items (list): una lista de strings que representan los botones que se mostrarán en el mensaje. El número máximo de botones que se pueden mostrar en un mensaje es de 3.

```php
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
}
```

### sendMessage()

El método send_message_text es una función de la API de WhatsApp Business que permite enviar mensajes de texto simples a los destinatarios de WhatsApp. Estos mensajes pueden ser utilizados para enviar información en formato de texto plano a los usuarios de WhatsApp.

Para utilizar el método send_message_text, debe proporcionar varios parámetros, como el número de canal de la empresa, el número de teléfono del destinatario, el tipo de mensaje y el texto que se enviará.

El método send_message_text es una forma efectiva de enviar mensajes de texto simples a los usuarios de WhatsApp. Aunque puede parecer básico, los mensajes de texto simples son útiles para enviar información breve y concisa a los usuarios de WhatsApp. Además, los mensajes de texto simples pueden ser utilizados para establecer contacto inicial con los usuarios o para enviar información que no requiere opciones interactivas.

- company_channel_number (int): el número de canal de la empresa desde el cual se enviará el mensaje. Este número es proporcionado por la plataforma de WhatsApp Business API.
- message_text (str): el texto principal del mensaje que se enviará. La longitud máxima del mensaje es de 4096 caracteres.
- recipient_number (str): el número de teléfono del destinatario al que se enviará el mensaje en el formato internacional. Por ejemplo, si el número de teléfono es de Colombia, el número debería comenzar con "57" seguido del número de teléfono sin el "0" inicial.
- message_type (str): el tipo de mensaje que se enviará. En este caso, el valor debe ser "text".

```php
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
 ```
 ### varEdit()
 
 El método "edit" se utiliza para actualizar un valor existente en la base de datos de caché.

A continuación se describen los parámetros del JSON enviado al API:

- "type": indica el tipo de operación que se va a realizar, en este caso "edit" para actualizar un valor existente en la caché.
- "key": es la clave única que se utilizará para acceder al valor de la caché que se desea actualizar. La clave debe existir en la base de datos de caché.
- "value": es el nuevo valor que se va a almacenar en la caché. El valor puede ser cualquier objeto serializable en formato JSON.
- "time": es el tiempo en minutos que se va a mantener el valor actualizado en la caché antes de que sea eliminado automáticamente. Después de este tiempo, el valor se considera "caducado" y se elimina de la caché. Si no se especifica ningún tiempo, el valor se mantiene en la caché indefinidamente.

```php
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
 ```
 
  ### varAdd()
  
El método "add" se utiliza para crear una nueva entrada en una base de datos de caché con una clave y un valor especificados en formato JSON. El objetivo de la caché es almacenar temporalmente información que se ha accedido recientemente, con el fin de acelerar el acceso a dicha información en futuras solicitudes.

A continuación se describen los parámetros del JSON enviado al API:

- "type": indica el tipo de operación que se va a realizar, en este caso "add" para agregar un nuevo valor a la caché.
- "key": es la clave única que se utilizará para acceder al valor de la caché en el futuro. La clave debe ser única dentro de la base de datos de caché.
- "value": es el valor que se va a almacenar en la caché. El valor puede ser cualquier objeto serializable en formato JSON.
- "time": es el tiempo en minutos que se va a mantener el valor en la caché antes de que sea eliminado automáticamente. Después de este tiempo, el valor se considera "caducado" y se elimina de la caché. Si no se especifica ningún tiempo, el valor se mantiene en la caché indefinidamente.

```php
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
 ```

## varRead()

El método "read" se utiliza para recuperar un valor específico de la base de datos de caché.

A continuación se describen los parámetros del JSON enviado al API:

- "type": indica el tipo de operación que se va a realizar, en este caso "read" para recuperar un valor de la caché.
- "key": es la clave única que se utilizará para acceder al valor de la caché que se desea recuperar. La clave debe existir en la base de datos de caché.
Es importante tener en cuenta que el valor devuelto por el método "read" puede estar caducado si ha pasado el tiempo de vida especificado al agregar o actualizar el valor en la caché. Por lo tanto, es posible que debas comprobar si el valor devuelto sigue siendo válido antes de usarlo.

```php
    public function varRead(){
        // Ejemplo de array con los datos de la variable a leer
        $array_example = [
            "type" => "read",
            "key" => "valor key"
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }
 ```
 
 ### varDelete()
 El método "delete" se utiliza para eliminar un valor específico de la base de datos de caché.

A continuación se describen los parámetros del JSON enviado al API:

- "type": indica el tipo de operación que se va a realizar, en este caso "delete" para eliminar un valor de la caché.
- "key": es la clave única que se utilizará para acceder al valor de la caché que se desea eliminar. La clave debe existir en la base de datos de caché.
Es importante tener en cuenta que una vez que un valor ha sido eliminado de la caché, ya no estará disponible para su recuperación. Por lo tanto, asegúrate de que realmente deseas eliminar el valor antes de llamar al método "delete".


```php
    public function varDelete(){
        // Ejemplo de array con los datos de la variable a eliminar
        $array_example = [
            "type" => "delete",
            "key" => "valor key"
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }
 ```
 
  ### varDeleteAll()
  
El método "delete_all" se utiliza para eliminar todos los valores almacenados en la base de datos de caché de la empresa.

A continuación se describe el único parámetro del JSON enviado al API:

- "type": indica el tipo de operación que se va a realizar, en este caso "delete_all" para eliminar todos los valores de la caché de la empresa.
Es importante tener en cuenta que una vez que todos los valores han sido eliminados de la caché, ya no estarán disponibles para su recuperación. Por lo tanto, asegúrate de que realmente deseas eliminar todos los valores antes de llamar al método "delete_all".
  
  ```php
    public function varDeleteAll(){
        // Ejemplo de array con el tipo de eliminación "delete_all"
        $array_example = [
            "type" => "delete_all"
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_var, "POST", $this->api_key, $array_example);
    }
  ```

###  addTag()

Este endpoint permite agregar una etiqueta a un contacto en la API. La etiqueta se asigna a través del tag_name y se aplica al contacto identificado por el recipient_number.

  ```php
    public function addTag(){
        // Ejemplo de array con el tipo de eliminación "delete_all"
        $array_example = [
            "tag_name" => "tag_name",
            "recipient_number" => "recipient_number",
        ];

        // Llamada a la función para consumir el servicio web
        $return = $this::programConsumeWebService($this->url_tag, "POST", $this->api_key, $array_example);
    }
 ```
 
