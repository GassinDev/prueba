import React from 'react';
import { createRoot } from 'react-dom/client';
import Logo from './components/logo';
import ListaCanciones from './components/listaCanciones';
import NavigationBar from './components/navbar';
import ListadoUsuarios from './components/listaUsuarios';

const logoElement = document.getElementById('logo');
if (logoElement) {
    createRoot(logoElement).render(
        <React.StrictMode>
            <Logo />
        </React.StrictMode>
    );
}

const songElement = document.getElementById('canciones');
if (songElement) {
    createRoot(songElement).render(
        <React.StrictMode>
            <ListaCanciones />
        </React.StrictMode>
    );
}

const userElement = document.getElementById('usuarios');
if (userElement) {
    createRoot(userElement).render(
        <React.StrictMode>
            <ListadoUsuarios />
        </React.StrictMode>
    );
}



