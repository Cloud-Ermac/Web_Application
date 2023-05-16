<?php
/**
 * @author Olayinka Hassan
 *
 *  Class Request
 *
 * This class represents a Request object, which is used to process the HTTP request made to the server.
 * It contains information about the request method and the path of the request.
 */

namespace src;

class Request
{
    /**
     * The request method (e.g. GET, POST, PUT, DELETE)
     *
     * @var string
     */

    private $method;

    /**
     * The request path (e.g. '/api/author')
     *
     * @var string
     */
    private $path;

    /**
     * Request constructor.
     *
     * Initializes the Request object by calling the setMethod and setPath methods.
     */
    public function __construct(){
        $this->setMethod();
        $this->setPath();

    }
    /**
     * Set the request method.
     *
     * Retrieves the request method from the $_SERVER superglobal and sets it to the $method property.
     */
private function setMethod(){
        $this->method = $_SERVER['REQUEST_METHOD'];

}
    /**
     * Validate the request method.
     *
     * If the request method is not in the array of valid methods passed as an argument,
     * an error message is output and the script is terminated.
     *
     * @param array $validMethods An array of valid request methods
     */


public function validateRequestMethod($validMethods){
        if (!in_array($this->method, $validMethods)){
            $output['message']="Invalid request method:" .$this->method;
            die(json_encode($output));
        }
}
    /**
     * Set the request path.
     *
     * Retrieves the request path from the $_SERVER superglobal, removes the base path,
     * and sets it to the $path property.
     */
private function setPath(){
        $this->path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->path = str_replace("/WebApp/coursework/api","",$this->path);

}
    /**
     * Get the request path.
     *
     * @return string The request path
     */
public function getPath(){
        return $this->path;
}
}