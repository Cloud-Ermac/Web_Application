<?php
/**
 * Base endpoint
 * returns author's detail
 * @author Olayinka Hassan
 */

namespace src;

class Base extends endpoint
{
    public function __construct()
    {
        // connect to the database
        $db = new Database("db/chiplay.sqlite");

        // initialise and execute the SQL
        $this->initialiseSQL();
        $query = $db->executeSQL($this->getSQL());

        // retrieve the conference name
        $conferenceName = $query;

        $name = [
            "first_name" => "Olayinka",
            "last_name" => "Hassan",

        ];
        $module = [
            "code" => "KF6012",
            "name" => "Web Application Integration",
            "level" => 6,
            "Assessment" => "Coursework",
            "API documentation" => " http://unn-w19014555.newnumyspace.co.uk/WebApp/coursework/documentation/"
        ];
        $data = [
            "name" => $name,
            "id" => "w19014555",
            "module" => $module,
            "conference_name" => $conferenceName
        ];

        $this->setData($data);
    }

    protected function initialiseSQL()
    {
        parent::initialiseSQL();
        $this->sql = "SELECT name FROM conference_information";
        $this->setSQL($this->sql);
    }
}