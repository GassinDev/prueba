import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Card from 'react-bootstrap/Card';
import { motion } from 'framer-motion';

function Reproductor({ cancion }) {
    const [reproduciendo] = useState(true);

    return (
        <div>
            <audio className="w-100" id="mireproductor" src={"uploads/music/" + cancion.fileAudio} controls autoPlay={reproduciendo} />
        </div>
    );
}

function ListaCanciones() {
    const [canciones, setCanciones] = useState([]);
    const [cancionSeleccionada, setCancionSeleccionada] = useState(null);

    useEffect(() => {
        const fetchCanciones = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/ListadoCanciones');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                setCanciones(data);
            } catch (error) {
                console.error(error);
            }
        };

        fetchCanciones();
    }, []);

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 2 }}
            className="row row-cols-2 row-cols-md-4 g-4"
        >
            {canciones.map((cancion, index) => (
                <motion.div className="col" key={index} whileHover={{ scale: 1.1 }}>
                    <Card onClick={() => setCancionSeleccionada(cancion)}>
                        <Card.Img
                            variant="top"
                            src={"uploads/images/" + cancion.fotoPortada}
                            alt="portada"
                            style={{ 
                                height: "250px", 
                                objectFit: "cover", 
                                filter: cancionSeleccionada === cancion ? "brightness(20%)" : "none" }}
                        />
                        <Card.Body>
                            <Card.Title>{cancion.title}</Card.Title>
                            {cancionSeleccionada === cancion && <Reproductor cancion={cancionSeleccionada} />}
                            {cancionSeleccionada === cancion && (
                                <img src="img/audio.gif" alt="gif" style={{ position: 'absolute', top: '50%', left: '50%', transform: 'translate(-50%, -50%)', maxWidth: '50%', maxHeight: '50%' }} />
                            )}
                        </Card.Body>
                    </Card>
                </motion.div>
            ))}
        </motion.div>
    );
}

export default ListaCanciones;
