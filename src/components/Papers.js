import React, {useEffect, useState} from "react";
import ResultsperPage from "./subcomponents/resultsperPage";
import Search from "./subcomponents/search";
import AwardFilter from "./subcomponents/awardfilter";
import {fetchPapers, getFilteredPapers} from "./subcomponents/paperFunctions";

/**
 * Papers page component
 * This page displays all the papers in the database.
 *
 * @author Olayinka Hassan
    */
function PapersPage(props) {
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
    const [showModal, setShowModal] = useState(false);

    // Initialize the "selectedPaper" state variable with an empty object
    const [selectedPaper, setSelectedPaper] = useState({});
// Fetch papers when results per page changes
    useEffect(() => {
        fetchPapers("", resultsPerPage)
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
        <div>
            <Search searchTerm={searchTerm} setSearchTerm={setSearchTerm} />
            <h1> 2021 CHI Play Papers</h1>

            <ResultsperPage
                resultsPerPage={resultsPerPage}
                setResultsPerPage={setResultsPerPage}
            />
            <AwardFilter filter={filter} setFilter={setFilter} />
            {loading && <p> Loading...</p>}
            {filteredPapers}
        </div>
    );

}
export default PapersPage;
