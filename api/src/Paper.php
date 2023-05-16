<?php
/**
 * Class for the paper.html endpoint
 * Retrieves the information about all papers at the conference.
 * @author Olayinka Hassan
 *
 */
namespace src;

class Paper extends endpoint
{
    /**
     * set the SQL for paper.html endpoint
     * override version in parent class to only output paper.html info.
     * @author
     */
protected function initialiseSQL()
{
    try {
        $sql =" SELECT DISTINCT p.paper_id, p.title, ifnull(p.award,'false') AS award, p.abstract, t.name, t.short_name
        ,p.doi,p.video
FROM paper p
JOIN track t  on  p.track_id = t.track_id
 ";
        $sqlParams = [];

        $whereAdded = false; // flag to track whether the WHERE clause has been added
        // accepts the search and name parameters


        if ((filter_has_var(INPUT_GET, 'short_name')) && (filter_has_var(INPUT_GET, 'search'))) {
            http_response_code(400); // Bad Request
            throw new ClientErrorException("Invalid combination of short name and search parameters" );
        }

        foreach ($_GET as $key => $value) if (!in_array($key, ['short_name', 'search'])) {
            http_response_code(400); // Bad Request
            throw new ClientErrorException("Invalid parameter " . $key);
        }
        //accepts the parameter that searches for the short name of the paper.html
        if (filter_has_var(INPUT_GET, 'short_name')) {
                $sql .= " WHERE t.short_name = :short_name ";

            $sqlParams['short_name'] = $_GET['short_name'];
        }

        if (filter_has_var(INPUT_GET, 'search')) {
                $sql .= " WHERE t.name LIKE :search";

            $sqlParams[':search'] = '%'.$_GET['search'].'%';
        }


        $this->setSQL($sql);
        $this->setSQLParams($sqlParams);
    } catch(ClientErrorException $e) {
        // Set the data to be returned as an error message if a BadRequest exception is caught
        $data =  ["Bad Request! Please try again." => $e->getMessage()];
        $this->setData($data);
    }
}
    protected function endpointParams()
    {
        return ['short_name','search'];
    }

}
