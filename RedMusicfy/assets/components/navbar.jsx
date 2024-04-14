import React from 'react';
import Navbar from 'react-bootstrap/Navbar';
import Nav from 'react-bootstrap/Nav';
import { Link } from 'react-router-dom'; 

function NavigationBar() {
    return (
        <Navbar bg="dark" variant="dark">
            <Navbar.Brand as={Link} to="/">
                Red Musicfy <img src="img/logo.png" height="30" alt="Red Musicfy Logo" />
            </Navbar.Brand>
            <Nav>
                <Nav.Link as={Link} to="/verCanciones">Lista de Canciones</Nav.Link>
                <Nav.Link as={Link} to="/verUsuarios">Lista de Usuarios</Nav.Link>
                <Nav.Link as={Link} to="/register">Registrarme</Nav.Link>
                <Nav.Link as={Link} to="/verUsuarios">Login</Nav.Link>
            </Nav>
        </Navbar>
    );
}

export default NavigationBar;