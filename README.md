# whatmas
Whatmas API
# Whatmas API

Web consumption API using the PHP programming language. The program provides different methods for performing operations such as sending interactive messages, managing variables, and consuming web services.

The available methods in the application are as follows:

```php
sendMessageList(): //This method allows sending an interactive message in the form of a list. It can provide a set of items with titles, descriptions, and interactive buttons for the user to interact with.

sendMessageButton(): //This method sends an interactive message with buttons. It can provide a set of buttons for the user to select a specific option.

sendMessage(): //This method sends a simple text message without additional interactive options.

varEdit(): //This method allows editing an existing variable in the web service. It takes a variable key, a new value, and a duration.

varAdd(): //This method allows adding a new variable to the web service. It takes a variable key, a value, and a duration.

varRead(): //This method allows reading the value of an existing variable in the web service. It takes the variable key and returns the corresponding value.

varDelete(): //This method allows deleting a specific variable from the web service. It takes the variable key to be deleted.

varDeleteAll(): //This method allows deleting all variables stored in the web service.
```

These methods use a helper function called programConsumeWebService() to make the API call to the web service using the cURL library in PHP.

## Tabla de Contenidos

- [Setup](#Setup)
- [Use](#Use)
- [Method](#Methods)
  - [sendMessageList()](#sendmessagelist)
  - [sendMessageButton()](#sendmessagebutton)
  - [sendMessage()](#sendmessage)
  - [varEdit()](#varedit)
  - [varAdd()](#varadd)
  - [varRead()](#varread)
  - [varDelete()](#vardelete)
  - [varDeleteAll()](#vardeleteall)
  - [addTag()](#addTag)


## Setup

To use this application, follow the steps below:
- Clone the repository to your local machine.
- Import the class into your project.
- Export the API_KEY variable globally.
- Send the information received by the POST as parameters to instantiate the class.
  ```php
        $object = new ApiWhatmasClient(file_get_contents("php://input"));
  ```

## Methods
Now you can use the different methods available in the ApiWhatmasClient class to interact with the web service. For example:  

```php
// Send an interactive message of type list
$object->sendMessageList();

// Send an interactive message with buttons
$object->sendMessageButton();

// Send a simple text message
$object->sendMessage();

// Edit a variable in the web service
$object->varEdit();

// Add a new variable to the web service
$object->varAdd();

// Read the value of a variable from the web service
$object->varRead();

// Delete a variable from the web service
$object->varDelete();

// Delete all variables from the web service
$object->varDeleteAll();
  ```
    
## Use

Explicación de cómo utilizar el proyecto. Incluye ejemplos de código, comandos o configuraciones.

## Métodos

### sendMessageList()

The `send_message_list` method is an API function of WhatsApp Business that allows sending interactive list messages to WhatsApp recipients. These list messages can be used to display a list of interactive options to WhatsApp users, enabling them to interact with the message and select an option. List messages are very useful for sending information in an easy-to-read format and allowing users to interact with the content.

To use the `send_message_list` method, you need to provide several parameters such as the company channel number, recipient's phone number, message type, and message subtype. You also need to provide a list of items that will be displayed in the interactive list message. Each item should have a title and a description.

The `send_message_list` method is an effective way to send interactive messages to WhatsApp users. By using list messages, you can provide users with a more engaging and interactive experience than simply sending a plain text message. Additionally, list messages can also be used to gather information from users by allowing them to select interactive options.

- `company_channel_number` (int): The company channel number from which the message will be sent. This number is provided by the WhatsApp Business API platform.
- `message_text` (str): The main text of the message to be sent. The maximum length of the message is 4096 characters.
- `recipient_number` (str): The phone number of the recipient to whom the message will be sent in international format. For example, if the phone number is from Colombia, the number should start with "57" followed by the phone number without the initial "0".
- `message_type` (str): The type of message to be sent. In this case, the value should be "interactive".
- `message_subtype` (str): The subtype of message to be sent. In this case, the value should be "list".
- `items` (list): A list of dictionaries containing the items to be displayed in the interactive list. Each item should have two keys: `title` and `description`, representing the title and description of the item, respectively. The maximum number of items that can be displayed in a list is 10.
```php
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
```

### sendMessageButton()

The `send_message_button` method is an API function of WhatsApp Business that allows sending interactive messages with buttons to WhatsApp recipients. Buttons can be used to provide interactive options to users, such as responding with a simple click instead of having to write a complete response.

To use the `send_message_button` method, you need to provide several parameters such as the company channel number, recipient's phone number, message type, and message subtype. You also need to provide a list of strings representing the buttons that will be displayed in the message.

The `send_message_button` method is an effective way to send interactive messages to WhatsApp users. By using buttons, you can provide users with a more engaging and interactive experience than simply sending a plain text message. Additionally, button messages can also be used to gather information from users by allowing them to select interactive options.

- `company_channel_number` (int): The company channel number from which the message will be sent. This number is provided by the WhatsApp Business API platform.
- `message_text` (str): The main text of the message to be sent. The maximum length of the message is 4096 characters.
- `recipient_number` (str): The phone number of the recipient to whom the message will be sent in international format. For example, if the phone number is from Colombia, the number should start with "57" followed by the phone number without the initial "0".
- `message_type` (str): The type of message to be sent. In this case, the value should be "interactive".
- `message_subtype` (str): The subtype of message to be sent. In this case, the value should be "button".
- `items` (list): A list of strings representing the buttons that will be displayed in the message. The maximum number of buttons that can be displayed in a message is 3.
```php
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
```

### sendMessage()

The `send_message_text` method is an API function of WhatsApp Business that allows sending simple text messages to WhatsApp recipients. These messages can be used to send plain text information to WhatsApp users.

To use the `send_message_text` method, you need to provide several parameters such as the company channel number, recipient's phone number, message type, and the text to be sent.

The `send_message_text` method is an effective way to send simple text messages to WhatsApp users. Although it may seem basic, simple text messages are useful for sending short and concise information to WhatsApp users. Additionally, simple text messages can be used to initiate initial contact with users or to send information that doesn't require interactive options.

- `company_channel_number` (int): The company channel number from which the message will be sent. This number is provided by the WhatsApp Business API platform.
- `message_text` (str): The main text of the message to be sent. The maximum length of the message is 4096 characters.
- `recipient_number` (str): The phone number of the recipient to whom the message will be sent in international format. For example, if the phone number is from Colombia, the number should start with "57" followed by the phone number without the initial "0".
- `message_type` (str): The type of message to be sent. In this case, the value should be "text".

```php
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
 ```
 ### varEdit()

The `edit` method is used to update an existing value in the cache database.

Here are the parameters described in the JSON sent to the API:

  - `type`: Indicates the type of operation to be performed, in this case, "edit" to update an existing value in the cache.
  - `key`: The unique key that will be used to access the value in the cache that you want to update. The key must exist in the cache database.
  - `value`: The new value that will be stored in the cache. The value can be any serializable object in JSON format.
  - `time`: The time in minutes that the updated value will be kept in the cache before it is automatically removed. After this time, the value is considered "expired" and is removed from the cache. If no time is specified, the value is kept in the cache indefinitely.
```php
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
 ```
 
  ### varAdd()

The "add" method is used to create a new entry in a cache database with a specified key and value in JSON format. The purpose of the cache is to temporarily store recently accessed information in order to accelerate access to that information in future requests.

Here are the parameters of the JSON sent to the API:

- `type`: indicates the type of operation to be performed, in this case "add" to add a new value to the cache.

- `key`: is the unique key that will be used to access the value in the cache in the future. The key must be unique within the cache database.

- `value`: is the value to be stored in the cache. The value can be any serializable object in JSON format.

- `time`: is the time in minutes that the value will be kept in the cache before it is automatically removed. After this time, the value is considered "expired" and is removed from the cache. If no time is specified, the value is kept in the cache indefinitely.
```php
/**
 * varAdd(): This function adds a new variable.
 * $array_example: An example array with the data of the new variable to be added. You can customize this array according to your needs.
 * $return: The variable where the result of the programConsumeWebService() function call will be stored. It is assumed that this function is defined elsewhere. Make sure to define and use this function correctly in your implementation.
 * programConsumeWebService(): This function is responsible for consuming a web service to add the new variable. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
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
 ```

## varRead()

The `read` method is used to retrieve a specific value from the cache database.

Here are the parameters of the JSON sent to the API:

- `type`: indicates the type of operation to be performed, in this case "read" to retrieve a value from the cache.
- `key`: is the unique key that will be used to access the desired value in the cache. The key must exist in the cache database.

It's important to note that the value returned by the "read" method may be expired if the specified lifetime has passed since adding or updating the value in the cache. Therefore, you may need to check if the returned value is still valid before using it.
```php
The "delete" method is used to remove a specific value from the cache database.

Here are the parameters of the JSON sent to the API:

- "type": indicates the type of operation to be performed, in this case "delete" to remove a value from the cache.
- "key": is the unique key that will be used to access the value in the cache that needs to be deleted. The key must exist in the cache database.

By using the "delete" method, you can remove unwanted or expired values from the cache, freeing up memory and ensuring that only valid and up-to-date information is stored.
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
 ```
 
 ### varDelete()
The `delete` method is used to remove a specific value from the cache database.

Here are the parameters of the JSON sent to the API:

- `type`: indicates the type of operation to be performed, in this case "delete" to remove a value from the cache.
- `key`: is the unique key that will be used to access the value in the cache that needs to be deleted. The key must exist in the cache database.

It is important to note that once a value has been deleted from the cache, it will no longer be available for retrieval. Therefore, make sure you really want to remove the value before calling the `delete` method.

```php
 /**
     * varDelete(): This function deletes a variable.
     * $array_example: An example array with the data of the variable to be deleted. You can customize this array according to your needs.
     * $return: The variable where the result of the programConsumeWebService() function call will be stored. Make sure to define and use this function correctly in your implementation.
     * programConsumeWebService(): This function is responsible for consuming a web service to delete the variable. The specific implementation of this function is not provided in the given code. Make sure to define and use this function correctly in your implementation.
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
 ```
 
  ### varDeleteAll()

The `delete_all` method is used to delete all values stored in the company's cache database.

Here is the description of the JSON parameter sent to the API:

- `type`: indicates the type of operation to be performed, in this case "delete_all" to delete all values from the company's cache.

It is important to note that once all values have been deleted from the cache, they will no longer be available for retrieval. Therefore, make sure you really want to delete all values before calling the "delete_all" method.

  ```php
/**
 *     varDeleteAll(): This function deletes all variables.
 * $array_example: An array example with the deletion type "delete_all". You can customize this array according to your needs.
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

  ```

###  addTag()

This endpoint allows adding a tag to a contact in the API. The tag is assigned through the tag_name and applied to the contact identified by the recipient_number.

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
 
