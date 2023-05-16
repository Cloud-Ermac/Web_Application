<?php
/**
 * connect and interact with a SQLite database
 * @author Olayinka Hassan  w19014555
 */
namespace src;

use PDO;
use PDOException;

class Database
{
    private $dbConn;

    public function __construct($dbName)
    {
        $this->setDbConn($dbName);
    }

    /**
     * create database connection using PDO
     */
    private function setDbConn($dbName)
    {
        try {
            $this->dbConn = new PDO('sqlite:' . $dbName);
            $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            http_response_code(500);
            $output['message'] = $e->getMessage();
            echo json_encode($output);
            exit();
        }
    }

    /**
     * Execute an SQL prepared statement
     *
     * This function executes the query and uses the PDO 'fetchAll' method with the
     * 'FETCH_ASSOC' flag set so that an associative array of results is returned.
     *
     * @param string $sql A SQL statement
     * @param array $params An associative array of parameters (default empty array)
     * @return array            An associative array of the query results
     */
    public function executeSQL($sql, $params = [])
    {
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO:: FETCH_ASSOC);
    }
}