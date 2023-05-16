<?php
/**
 * @author Olayinka Hassan
 * The index page for the api which handles all requests
 */

include "config/config.php";

//set the header
$header = new \src\responseJson();
 // error handler
 set_exception_handler('exceptionHandler');
 
if( !in_array($_SERVER['REQUEST_METHOD'],array("GET","POST"))){
    // updated to use the client error Handler endpoint
    $endpoint =  new \src\clientError(" Invalid method:". $_SERVER['REQUEST_METHOD'],405);

}else{
    // work out the request from the path
    $request = new \src\Request();

    //Route the request api
    try {


        switch ($request->getPath()) {
            case'/':
                $endpoint = new \src\Base($request);
                break;
            case '/Paper':
            case '/paper':
            case '/Papers':
            case '/papers':
            case '/PAPER':
            case '/PAPERS':
                $endpoint = new \src\Paper($request);
                break;
            case '/author':
            case'/Authors':
            case'/authors':
            case '/AUTHOR':
            case '/AUTHORS':
                $endpoint = new \src\author($request);
                break;
            case'/auth/':
            case '/auth':
                $endpoint = new \src\ Authenticate($request);
                break;
            case'/update/':
            case'/update':
                case'/Update/':
                case'/Update':
                $endpoint = new \src\Update();
                break;
            default:
                $endpoint = new \src\clientError("Path not found" . $request->getPath(), 404);

        }
    }catch(\src\ClientErrorException $e){
        $endpoint = new \src\clientError($e->getMessage(), $e->getCode());
    }
}
$response = $endpoint->getData();
echo json_encode($response);
