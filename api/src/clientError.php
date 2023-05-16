<?php

namespace src;



/**
 * endpoint for handling client errors(400 responses)
 *
 * @author Olayinka Hassan
 */
class clientError extends endpoint
{
/**
 * @param String $message  - message explaining the error
 * @param Int $code - the relevant http status code
 */
public function __construct( $message = "", $code = 400)
{
    // set the relevant response code
    http_response_code($code);

    $this->setData(["length"=>0, "message"=>$message, "data"=> null ]);
}
}