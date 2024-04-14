import React from 'react';
import { motion } from 'framer-motion';

const Logo = () => {
    return (
        <div className="text-center mt-5">
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                transition={{ duration: 1 }}
                className="text-white fs-4"
            >
                ESTAS LISTO PARA ESTE 2024 ESCUCHAR TU MÚSICA A MÁXIMA CALIDAD
            </motion.div>
            <motion.div
                initial={{ rotate: 0 }}
                animate={{ rotate: 360 }}
                transition={{ duration: 2 }}
            >
                <img src="img/logo.png" alt="Logo" height="600px" />
            </motion.div>
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                transition={{ duration: 2 }}
                className="text-white fs-1"
            >
                RED MUSICFY
            </motion.div>
        </div>
    );
};

export default Logo;

