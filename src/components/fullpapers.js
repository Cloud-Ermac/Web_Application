/**
 * Full paper.html page component
 *
 * This page will display information about the full papers
 *
 * @author Olayinka Hassan
 *
 */
import React, {useState, useEffect} from "react";
import AwardFilter from "./subcomponents/awardfilter";
import Search from "./subcomponents/search";
import ResultsperPage from "./subcomponents/resultsperPage";
import {fetchPapers, getFilteredPapers} from "./subcomponents/paperFunctions";



function FullPapers() {
    // Initialize the papers state variable with an empty array
    // and the loading state variable with the value "true"
    const [papers, setPapers] = useState([]);
    const [loading, setLoading] = useState(true);
    // Initialize the "searchTerm" state variable with an empty string
    const [searchTerm, setSearchTerm] = useState("");
    // Initialize the "filter" state variable with the value "all"
    const [filter, setFilter] = useState("all");
    // Initialize the "resultsPerPage" state variable with the value 10
    const [resultsPerPage, setResultsPerPage] = useState(10);
    // Initialize the "showModal" state variable with the value "false"
    const [showModal, setShowModal] = useState(false);
    // Initialize the "selectedPaper" state variable with an empty object
    const [selectedPaper, setSelectedPaper] = useState({});
// Fetch papers when results per page changes
    useEffect(() => {
        fetchPapers("short_name=fullpapers", resultsPerPage)
            .then((data) => {
                setPapers(data);
                setLoading(false)
            })
            .catch((e) => {
                console.log(e.message)
                alert("Something went wrong Please try again!")
            })
    }, [resultsPerPage]);

// Get filtered papers using the papers, search term, modal visibility, selected paper.html, and filter state variables
    const filteredPapers = getFilteredPapers(papers, searchTerm, showModal, setShowModal, selectedPaper, setSelectedPaper, filter);


    return (
       <div>{loading ? (
                <p>Loading papers...</p>
       ) : (
              <div><Search searchTerm={searchTerm} setSearchTerm={setSearchTerm} />
                   <h1>Full Papers</h1>
                     <AwardFilter filter={filter} setFilter={setFilter} />
                   <ResultsperPage resultsPerPage={resultsPerPage} setResultsPerPage={setResultsPerPage} />
                  {filteredPapers}
              </div>
           )}
        </div>
    );


}

export default FullPapers;
