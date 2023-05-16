
/**
 * Footers
 *
 * This will be the footer component for all the pages.
 * @author Olayinka Hassan
 */
import React from 'react';
import { Navbar } from 'react-bootstrap';

function Footer() {
    return (
        <Navbar bg="success" variant="dark" className="justify-content-center">
            <Navbar.Text className="text-white">
                Created by Olayinka Hassan 19014555
            </Navbar.Text>
        </Navbar>
    );
}

export default Footer;
