/**
 * Results Per page components
 *  This  component adds a dropdown element to allow the user to select the number of results per page
 *@author Olayinka Hassan
 */

import React from "react";
// this function is used to render the results per page component

const ResultsPerPageDropdown = ({ resultsPerPage, setResultsPerPage }) => {
  return (
    <div>
      <label htmlFor="resultsPerPage">Results per page:</label>
      <select
        id="resultsPerPage"
        value={resultsPerPage}
        onChange={(event) => setResultsPerPage(event.target.value)}
      >
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
          <option value="50">50</option>
          <option value="100">100</option>
      </select>
    </div>
  );
};

export default ResultsPerPageDropdown;
