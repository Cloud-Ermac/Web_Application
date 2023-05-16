<?php

namespace src;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Custom Exception
 *
 * This should be thrown if there is erroneous input
 * from the client (e.g. invalid method, auth errors)
 *
 *
 *
 * @author Olayinka Hassan
 */
class ClientErrorException extends \Exception
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $log = new Logger('client_error');
        $log->pushHandler(new RotatingFileHandler('logfiles', 0, Logger::ERROR));
        $log->error($this->getMessage());
    }
}