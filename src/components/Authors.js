/**
 * This component will display the authors  and their affiliations
 * @author Olayinka Hassan
 */
import {useEffect, useState} from "react";
import {Card, ListGroup, ListGroupItem} from "react-bootstrap";

function AuthorsPage(props) {
    // Declare state variables for authors, loading, and showButton
const [authors, setAuthors] = useState([]);
const [loading, setLoading] = useState(false);
const [showButton, setShowButton] = useState(true);

// Method to fetch authors from API and set data to state

const fetchAuthors= () => {
    // Send fetch request to API
    fetch("http://unn-w19014555.newnumyspace.co.uk/WebApp/coursework/api/author?paper_id="+props.paper_id)
        .then(response => response.json())
        .then(data => {
            // Set authors state to data and set loading to false
            setAuthors(data);
            setLoading(false);
        })
        // Catch any errors and display alert
        .catch((e) => {
            console.log(e.message)
            alert("Something went wrong Please try again!")
        })
}
    // Method to set loading state to true and showButton state to false, and then call fetchAuthors method
const showAuthors = () => {
    setLoading(true);
    setShowButton(false);
    fetchAuthors();
}
// Map over authors array to create a list group item for each author
const listAuthors =  authors.map((value, key) =>

     <Card  key= {value.author_id}>
         <ListGroup variant={"flush"}>
             <ListGroupItem> {value.first_name} {value.middle_initial} {value.last_name}</ListGroupItem>
                <ListGroupItem>Author ID: {value.author_id} </ListGroupItem>
             <ListGroupItem> Institution: {value.institution}</ListGroupItem>
                <ListGroupItem> Country: {value.country}</ListGroupItem>
             </ListGroup>
             </Card>
);
    // Return div element that renders the list of authors, loading message if loading is true, and show button if showButton is tru
    return (
        <div>
            {listAuthors}
            {loading && <p>Loading...</p>}
            {showButton && <button onClick={showAuthors}>Show Authors</button> }
        </div>
    )
}
export default AuthorsPage;
