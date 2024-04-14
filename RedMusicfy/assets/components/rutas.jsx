import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import ListadoCanciones from './listaCanciones';
import NavigationBar from './navbar';
import ListadoUsuarios from './listaUsuarios';

function Rutas() {
    return (
        <Router>
            <div>
                <NavigationBar />
                <div className="container mt-3">
                    <Routes>
                        <Route path="/verCanciones" element={<ListadoCanciones />} />
                        <Route path="/verUsuarios" element={<ListadoUsuarios />} />
                    </Routes>
                </div>
            </div>
        </Router>
    );
}

export default Rutas;
