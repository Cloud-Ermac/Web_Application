
/**
 *  Search functionality component
 * The search component will allow user to search for the papers
 * fetched from the api.
 *
 * @author Olayinka Hassan
 */

import React from 'react';
import { Navbar, Form, FormControl, Button } from 'react-bootstrap';

// this function is used render the  search component

function Search(props) {
    // Use the "searchTerm" and "setSearchTerm" props to control the state of the search input
    const { searchTerm, setSearchTerm } = props;

    const handleSearchInput = (event) => {
        // Update the "searchTerm" state variable using the "setSearchTerm" prop
        setSearchTerm(event.target.value);
    }

    return (
        <Navbar bg="light" variant="light">
            <Form>
                <FormControl type="text" placeholder="Search" className="mr-sm-2" value={searchTerm} onChange={handleSearchInput} />
            </Form>
        </Navbar>
    );
}

export default Search;
