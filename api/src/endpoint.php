<?php
/**
 * This is a general class for endpoints.
 * it will serve as the parent for all endpoints
 * @author Olayinka Hassan
 *
 */

namespace src;

include 'Database.php';

abstract class endpoint
{
    private $data;
    protected $sql;
    protected $sqlParams;

    /**
     * Constructor for the endpoint class. Queries the database and saves the result.
     * Initializes the SQL and SQL parameters for the endpoint. Validates the request parameters.
     */
    public function __construct()
    {
        $db = new Database("db/chiplay.sqlite");
        $this->initialiseSQL();
        $data = $db->executeSQL($this->sql, $this->sqlParams);
        $this->setData($data);
        //check if the params used are valid for endpoint
        $this->validateParams($this->endpointParams());

    }
    /**
     * Sets the SQL query for the endpoint.
     *
     * @param string $sql The SQL query for the endpoint.
     */
    protected function setSQL($sql)
    {
        $this->sql = $sql;
    }
/**
     * Sets the SQL parameters for the endpoint.
     *
     * @param array $sqlParams The SQL parameters for the endpoint.
     */
    protected function setSQLParams($params)
    {
        $this->sqlParams = $params;
    }
    /**
     * Gets the SQL query for the endpoint.
     *
     * @return string The SQL query for the endpoint.
     */

protected function getSQL()


{
    return $this->sql;

}
    /**
     * define SQL and params for the endpoint
     */

protected function getSQLParams(){
        return $this->sqlParams;
}


    /**
     * Initializes the SQL and SQL parameters for the endpoint.
     * This method should be overridden by child classes to specify the specific SQL and parameters for their endpoint.
     */
    protected function initialiseSQL()
    {
        $sql = "";
        $this->setSQL($sql);
        $this->setSQLParams([]);
    }

    protected function setData($data)
    {

        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Define valid parameters for the endpoint
     */
    protected function endpointParams(){
        return [];
    }
    /**
     * check the parameters used in request against an array of valid parameters for the endpoint
     * @param array $params an array of valid param names (e.g. [paper_id0
     */
    protected function validateParams( $params){
        foreach($_GET as $key => $value){
            if ( !in_array($key, $params)){
                http_response_code(400);
                $output['message'] = "Invalid parameter:" .$key;
                die (json_encode($output));
            }
        }
    }
}
