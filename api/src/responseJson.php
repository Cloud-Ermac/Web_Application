<?php
/**
 * @author Olayinka Hassan
 * class for the JSON response
 */
namespace src;

class responseJson extends Response
{
    private $message;
    private $responseCode;
    protected function headers(){
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *");
        header("Access-control-Allow-Headers:*");
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            exit(0);
        }
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $responseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }


    /**
     * Returns the data for the response as a JSON encoded string.
     *
     * @return string The data for the response as a JSON encoded string.
     */
    public function getData()
    {
        if(is_null($this->message)){
            switch (count($this->data)) {
                case 0:
                    $this->message = "No content to display";
                    $this->responseCode = 204;
                    break;
                default:
                    $this->message = "OK";
                    $this->responseCode = 200;
                    break;
            }
        }
        switch ($this->responseCode) {
            case 200:
                $response = [
                    "message" => $this->message,
                    "status" => $this->responseCode,
                    "results" => $this->data
                ];

                break;
            default:
                $response = [
                    "status" => $this->responseCode,
                    "message" => $this->message,
                    "path" => strtok($_SERVER['REQUEST_URI'], '?')
                ];
                break;
        }
        return json_encode($response);
    }
}