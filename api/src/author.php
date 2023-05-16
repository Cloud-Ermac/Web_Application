<?php
/**
 * class for the author's endpoint
 * retrieves all information about the authors at the conference.
 * @author Olayinka Hassan
 */

namespace src;

class author extends endpoint
{
    /**
     * set the SQL for author's endpoint
     * override version in parent class to only output authors info.
     */
    protected function initialiseSQL()
    {
        try {
            $sql =" SELECT  a.author_id,a.first_name, a.middle_initial, a.last_name, af.institution, af.country
FROM author a
JOIN affiliation af ON a.author_id = af.author_id
JOIN paper p ON af.paper_id = p.paper_id";
            $sqlParams = [];
            // Check if both paper_id and author_id parameters are provided
            if ((filter_has_var(INPUT_GET, 'paper_id')) && (filter_has_var(INPUT_GET, 'author_id'))) {
                throw new ClientErrorException("Invalid combination of paper_id and author_id parameters");
            }

            // Check for any other invalid parameters
            foreach ($_GET as $key => $value) if (!in_array($key, ['paper_id', 'author_id'])) {
               // Throw BadRequest exception if any other invalid parameters are found
                throw new ClientErrorException("Invalid parameter " . $key);
        }
            // Add a filter for the paper_id parameter if it is provided
            if (filter_has_var(INPUT_GET, 'paper_id')) {
                $sql .= " WHERE p.paper_id = :paper_id";
                $sqlParams['paper_id'] = $_GET['paper_id'];
            }
            // Add a filter for the author_id parameter if it is provided
            if (filter_has_var(INPUT_GET, 'author_id')) {
                $sql .= " WHERE  a.author_id = :author_id";
                $sqlParams['author_id'] = $_GET['author_id'];

            }
            // Set the SQL query and parameters
                $this->setSQL($sql);
                $this->setSQLParams($sqlParams);

    } catch(ClientErrorException $e) {
            // Set the data to be returned as an error message if a BadRequest exception is caught
          $data =  ["Bad Request! Please try again." => $e->getMessage()];
            $this->setData($data);
        }

    }
    // Method to return an array of the accepted parameters for the endpoint
protected function endpointParams()
{
    return ['paper_id','author_id'];
}


}