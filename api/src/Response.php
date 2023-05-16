<?php

/**
 * Class Response
 *
 * This abstract class represents a Response object, which is used to process and format the data that will be
 * returned to the client in the HTTP response. It has a protected $data property and methods to set and get this data.
 * It also has a protected headers method that can be overridden by child classes to set custom HTTP headers.
 *  * @author Olayinka Hassan
 * @package src
 */

namespace src;


abstract class Response
{
    /**
     * The data that will be returned to the response
     *
     * @var mixed
     */
    protected $data;
    /**
     * Response constructor.
     *
     * Calls the headers method to set any necessary HTTP headers.
     */

    public function __construct(){
        $this->headers();
    }
    protected function headers(){
        /**
         * Set the HTTP headers for the response.
         *
         * This method can be overridden by child classes to set custom HTTP headers.
         */

    }
    public function setData($data){
        $this->data = $data;
    }
    /**
     * Get the data for the response.
     *
     * @return mixed The data to be returned to the response
     */
    public function getData(){
        return $this->data;

    }
}