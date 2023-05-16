<?php

/**
 * Authenticate username and password
 *
 * This class will check a username and password again those held in the
 * database. Where authentication is successful it will return a JWT.
 *
 * @author Olayinka Hassan W19014555
 */

namespace src;
use src\FirebaseJWT\JWT;
use src\ClientErrorException;

class Authenticate extends endpoint
{
    /** Parameters:
     username (string): The username to be authenticated
    password (string): The password to be authenticated
     Variables:
     sql (string): The SQL statement to check the username and password
     sqlParams (array): The parameters for the SQL statement
    */

    protected function initialiseSQL()

    {
        // Call the initialiseSQL() method of the endpoint class
        parent::initialiseSQL();

        // Define SQL to check username and password against those in the 'user' database
       $this->sql = "SELECT account_id,name FROM account WHERE username = :username AND password = :password";

        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            // Define SQL parameters
            $this->sqlParams = [
                ':username' => $_SERVER['PHP_AUTH_USER'],
                ':password' => $_SERVER['PHP_AUTH_PW']
            ];
        } else {
            // Return an error if the variables are not set
            http_response_code(400); // Bad Request
            $output['message'] = "Missing required parameters: 'username' and 'password'";
            die (json_encode($output));

        }

        // Set the SQL and SQL parameters for the endpoint
        $this->setSQL($this->sql);
        $this->setSQLParams($this->sqlParams);
    }

    /**
     * Validate the parameters for the endpoint
     *
     * This function checks that the required parameters for the endpoint are set.
     *
     * @return  array   An array of valid parameters for the endpoint
     *
     * @throws  ClientErrorException  If the required parameters are not set
     */

    protected function endpointParams()
    {
        // Define valid parameters for the authentication endpoint
        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
            return [$_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']];
        }else{
          throw new ClientErrorException("Missing required parameters: 'username' and 'password'");
        }
    }

    public function authenticate()
    {
        // Execute SQL and check if there are any results
        $db = new Database("db/chiplay.sqlite");
        $data = $db->executeSQL($this->sql, $this->sqlParams);
        if (count($data) === 0) {
            // Return error if username and password are invalid
            http_response_code(401); // Unauthorized
            throw new ClientErrorException("Invalid username or password");
        } else {
            // Generate a JWT
            $secretKey = SECRET;

            $tokenpayload = [
              'id' => $data[0]['account_id'],
                'iat' => time(),
                'iss'=> $_SERVER['HTTP_HOST'],
                'exp' => strtotime('+1 day', time())
            ];
            $jwt = JWT::encode($tokenpayload, $secretKey, 'HS256');

            // Add the JWT to the data in the response
            $output=[
                "length" => 0,
                "message" => "success", "jwt" => $jwt];

            // Return the response to the client
            http_response_code(200); // OK
            $this->setData($output);
        }
    }

    /**
     * Construct the Authenticate class
     *
     * This function checks that the request method is POST, and then calls the
     * parent constructor to initialize the SQL and validate the parameters. It
     * then calls the authenticate function to check the username and password.
     *
     * @return  void
     *
     * @throws  ClientErrorException  If the request method is not POST
     */

    public function __construct()
    {
        // Check if request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            throw new ClientErrorException("Invalid request method", 405);
        }

        // Call parent constructor to initialize SQL and validate parameters
        parent::__construct();

        // Authenticate username and password
        $this->authenticate();
    }
}

