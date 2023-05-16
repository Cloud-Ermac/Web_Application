import {Outlet,Link} from "react-router-dom";
import {Nav, Navbar} from "react-bootstrap";
/**
 *
 * Paper's Menu
 *  A specialist menu for the papers pages
 *  @author Olayinka Hassan
 *
 */

function PapersMenu() {
    return (
        <>
            {/* Render a navbar with a dark color scheme and a "success" background color */}
            <Navbar variant="dark"  bg="success" >
                {/* Render a nav element with the "mr-auto" class */}
                <Nav className= "mr-auto">
                    {/* Render nav links that use the Link component from react-router-dom to navigate to the corresponding pages */}
                    <Nav.Link as={Link} to="/Papers/fullpapers">Full Papers</Nav.Link>
                    <Nav.Link as={Link} to="/Papers/competition">Competition</Nav.Link>
                    <Nav.Link as={Link} to="/Papers/interactivity">Interactivity</Nav.Link>
                    <Nav.Link as={Link} to="/Papers/doctoral">Doctoral</Nav.Link>
                    <Nav.Link as={Link} to="/Papers/rapid">Rapid</Nav.Link>
                    <Nav.Link as={Link} to="/Papers/wip">Wip</Nav.Link>
                  </Nav>
            </Navbar>
            {/* Render the outlet for the pages */}
            <Outlet />
        </>
    );
}

export default PapersMenu;
