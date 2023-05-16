
/**
 * Main menu
 *
 * This will be the main navigation component in
 * the app, with links to all main pages
 *
 * @author Olayinka Hassan
 */
import { Link } from 'react-router-dom';
import React from 'react';
import { Navbar, Nav } from 'react-bootstrap';
import {outlet} from 'react-router-dom';

function Menu() {
    return (
        <Navbar bg="success" variant="dark">
            <Navbar.Brand as={Link} to="/">Home</Navbar.Brand>
            <Nav className="mr-auto">
                <Nav.Link as={Link} to="/Papers">Paper</Nav.Link>
                <Nav.Link as={Link} to="/admin">Admin</Nav.Link>
            </Nav>
        </Navbar>
    );
}

export default Menu;