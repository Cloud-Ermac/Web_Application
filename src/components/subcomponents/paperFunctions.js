/**
 * This component displays a list of functions  and allows users to view the details of each paper.html
 *  * in a modal window. It also includes a search bar  and award filter to filter the list of papers by title or
 *
 *@author Olayinka Hassan
 * W19014555
 *
 *
 */

import {Button, Card, ListGroup, ListGroupItem, Modal,ModalDialog} from 'react-bootstrap';
import React, {useState} from "react";
import AuthorsPage from "../Authors";


export const fetchPapers = (queryString, resultsPerPage) => {
    return fetch(`http://unn-w19014555.newnumyspace.co.uk/WebApp/coursework/api/paper?${queryString}`)
        .then((response) => response.json())
        .then((data) => {
            if (Array.isArray(data)) {
                return data.slice(0, resultsPerPage);
            } else {
                return [];
            }
        })
        .catch((e) => {
            console.log(e.message)
        })
}
/**
 * Filters the given list of papers by searchTerm. Returns a new list of papers that have a
 * title or abstract that includes searchTerm.
 * @param {array} papers - The list of papers to filter
 * @param {string} searchTerm - The term to search for in the papers
 * @param filter - The filter award  to apply to the list of papers
 * @returns {array} - The filtered list of papers
 */

//filtering the papers by the search term
const searchPapers = (papers, searchTerm) => {
    return papers.filter(paper => paper.title.toLowerCase().includes(searchTerm.toLowerCase()) || paper.abstract.toLowerCase().includes(searchTerm.toLowerCase()));
};

//filtering the papers by the award
const filterPapersByAward = (papers, filter) => {
    return papers.filter(paper => filter=== "all" || (filter === "awarded" && paper.award === "true") || (filter === "not awarded" && paper.award === "false"));
};


/**
 * Displays a list of papers as a list of buttons. When a button is clicked, a modal window
 * appears with the details of the selected paper.html.
 * @param {array} papers - The list of papers to display
 * @param {boolean} showModal - Whether the modal window should be displayed
 * @param {function} setShowModal - A function to update the showModal state
 * @param {object} selectedPaper - The selected paper.html to display in the modal window
 * @param {function} setSelectedPaper - A function to update the selectedPaper state
 * @returns {JSX} - The JSX for the paper.html list and modal window
 */

export const displayPapers = (papers, showModal, setShowModal, selectedPaper, setSelectedPaper) => {
    return (
        <>
            {papers.map((value, key) => (
                <ListGroup key={value.paper_id}>
                    <ListGroupItem>
                        <Button
                            variant="outline-success" size="lg"
                            style={{ boxShadow: "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)" }}
                            onClick={() => {
                                setSelectedPaper(value);
                                setShowModal(true);
                            }}
                        >
                            {value.title}
                        </Button>
                    </ListGroupItem>
                </ListGroup>
            ))}
            {showModal && (
                <Modal show={showModal} onHide={() => setShowModal(false)} centered>
                    <Modal.Header closeButton variant="outline-success">
                        <Modal.Title>{selectedPaper.title}</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <ListGroup variant="flush">
                            <ListGroupItem>Paper ID: {selectedPaper.paper_id}</ListGroupItem>
                            <ListGroupItem>Award: {selectedPaper.award}</ListGroupItem>
                            <ListGroupItem>Name: {selectedPaper.name}</ListGroupItem>
                            <ListGroupItem>Abstract: {selectedPaper.abstract}</ListGroupItem>
                            <ListGroupItem>
                                Author:
                                <AuthorsPage paper_id={selectedPaper.paper_id} />
                            </ListGroupItem>
                            <ListGroupItem>
                                Video:
                                <br />
                                <iframe
                                    title={selectedPaper.video}
                                    src={selectedPaper.video}
                                    frameBorder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowFullScreen
                                />
                            </ListGroupItem>
                            <ListGroupItem>Doi: {selectedPaper.doi}</ListGroupItem>
                        </ListGroup>
                    </Modal.Body>
                </Modal>
            )}
        </>
    );
};

//exporting the functions to be used by various components in the application.

export const getFilteredPapers = (papers, searchTerm, showModal, setShowModal, selectedPaper, setSelectedPaper, filter) => {
    // Declare variable for filtered papers
    let filteredPapers = papers;
    // If searchTerm exists, filter papers by searchTerm
    if (searchTerm) {
        filteredPapers = searchPapers(filteredPapers, searchTerm);
    }
    // If filter is not "all", filter papers by award
    if (filter !== "all") {
        filteredPapers = filterPapersByAward(filteredPapers, filter);
    }
    // Return the displayed papers
    return displayPapers(filteredPapers, showModal, setShowModal, selectedPaper, setSelectedPaper);
};



