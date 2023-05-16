<?php




/**
 * update Award
 *
 * update the award for a specified paper.html. A valid JWT is required
 * @author Olayinka Hassan
 */
namespace src;

use src\FirebaseJWT\JWT;
use src\FirebaseJWT\Key;

class Update extends endpoint
{


    /**
     * @throws ClientErrorException
     */
    public function __construct()
    { // validate the request method
        $this->validateRequestMethod("POST");

        //validate the token
        $this->validateToken();

        // Validate the update parameters
        $this->validateUpdateParams();
// connect to the database
        $db = new Database("db/chiplay.sqlite");
        $this->initialiseSQL();
        $query = $db->executeSQL($this->getSQL(), $this->getSQLParams());

// return the result
        $this->setData(array(
            "length=>0",
            "message" => "success",
            "data" => null
        ));
    }

    private function validateRequestMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            throw new ClientErrorException("Invalid Request Method", 405);
        }

    }

    private function validateToken()
    {
        //  Use the secret key
        $key = SECRET;

        // Get all headers from the http request
        $allHeaders = getallheaders();
        $authorizationHeader = "";

        //  Look for an Authorization header.
        // this might not exist. It might start with a capital A (requests
        // from Postman do), or a lowercase a (requests from browsers might)
        if (array_key_exists('Authorization', $allHeaders)) {
            $authorizationHeader = $allHeaders['Authorization'];
        } elseif (array_key_exists('authorization', $allHeaders)) {
            $authorizationHeader = $allHeaders['authorization'];
        }

        // 4. Check if there is a Bearer token in the header
        if (substr($authorizationHeader, 0, 7) != 'Bearer ') {
            throw new ClientErrorException("Bearer token required", 401);
        }

        //  Extract the JWT from the header (by cutting the text 'Bearer ')
        $jwt = trim(substr($authorizationHeader, 7));

        //  Use the JWT class to decode the token
        try {
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            throw new ClientErrorException($e->getMessage(), 401);
        }
// check to see if the server issued the token
        if ($decoded->iss != $_SERVER['HTTP_HOST']) {
            throw new ClientErrorException("invalid token issuer", 401);
        }
    }

    private function validateUpdateParams()
    {
        // check if the required parameters are present
        if (!filter_has_var(INPUT_POST,'award') ) {
            throw new ClientErrorException("Missing required parameters", 400);
        }

        // check for the paper_id parameter
        if (!filter_has_var(INPUT_POST,'paper_id') ) {
            throw new ClientErrorException("Missing required parameters", 400);
        }
        // check to see if the award value supplied is valid
        $award =["true","false" ];
        if (!in_array(strtolower($_POST['award']), $award)) {
            throw new ClientErrorException("Invalid award value", 400);
        }
    }

// initialise and execute the update
    protected function initialiseSQL()
    {
        // Call the initialiseSQL() method of the endpoint class
        parent::initialiseSQL();

        if ($_POST['award'] == "false") {
            // Define SQL to update the award to null for a specific paper_id
            $this->sql = "UPDATE paper SET award = NULL WHERE paper_id = :paper_id";
            $this->sqlParams = array(
                ":paper_id" => $_POST['paper_id'],
            );
        } else {
            // Define SQL to update the award for a specific paper_id
            $this->sql = "UPDATE paper SET award = :true WHERE paper_id = :paper_id";
            $this->sqlParams = array(
                ":paper_id" => $_POST['paper_id'],
                ":true" => $_POST['award']
            );
        }

        // Set the SQL and SQL parameters for the endpoint
        $this->setSQL($this->sql);
        $this->setSQLParams($this->sqlParams);
    }

}