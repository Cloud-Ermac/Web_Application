/**
 * This is the award filter component that renders award filter options.
 * @author Olayinka Hassan
 *

 */
import Dropdown from "react-bootstrap/Dropdown";

function AwardFilter({filter, setFilter}) {
    // Initialize a state variable for the selected filter option

    // Function to update the filter state variable when the filter option changes
    const handleFilterChange = (eventKey) => {
     setFilter(eventKey);
    };

    return (
        <Dropdown onSelect={handleFilterChange}>
            <Dropdown.Toggle variant="success" id="dropdown-basic">
                Award
            </Dropdown.Toggle>
            <Dropdown.Menu>
                <Dropdown.Item eventKey="all">All</Dropdown.Item>
                <Dropdown.Item eventKey="awarded">Awarded</Dropdown.Item>
                <Dropdown.Item eventKey="not awarded">Not Awarded</Dropdown.Item>
            </Dropdown.Menu>
        </Dropdown>
    );
}

export default AwardFilter;
